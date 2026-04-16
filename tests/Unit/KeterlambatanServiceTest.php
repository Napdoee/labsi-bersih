<?php

namespace Tests\Unit;

use App\Models\Jadwal;
use App\Services\KeterlambatanService;
use PHPUnit\Framework\TestCase;

class KeterlambatanServiceTest extends TestCase
{
    protected KeterlambatanService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new KeterlambatanService();
    }

    public function test_asisten_masuk_tepat_waktu(): void
    {
        $jadwal = new Jadwal(['waktu_mulai' => '08:00:00']);
        $keterlambatan = $this->service->hitungKeterlambatan($jadwal, '08:00');
        
        $this->assertEquals(0, $keterlambatan, 'Keterlambatan harus 0 jika tepat waktu.');
    }

    public function test_asisten_masuk_terlambat_15_menit(): void
    {
        $jadwal = new Jadwal(['waktu_mulai' => '08:00:00']);
        $keterlambatan = $this->service->hitungKeterlambatan($jadwal, '08:15');
        
        $this->assertEquals(15, $keterlambatan, 'Keterlambatan harus terhitung 15 menit.');
    }

    public function test_asisten_masuk_lebih_awal_tidak_dihitung_negatif(): void
    {
        $jadwal = new Jadwal(['waktu_mulai' => '08:00:00']);
        $keterlambatan = $this->service->hitungKeterlambatan($jadwal, '07:45');
        
        $this->assertEquals(0, $keterlambatan, 'Keterlambatan harus 0 jika datang lebih awal, bukan negatif.');
    }
}
