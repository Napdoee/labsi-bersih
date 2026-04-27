<x-app-layout>
    <x-slot name="header">
        <h1 class="page-title">Dashboard Overview</h1>
        <p class="page-subtitle">Selamat datang kembali, <strong>{{ auth()->user()->displayName }}</strong>. Pantau metrik utama Anda hari ini.</p>
    </x-slot>

    <div class="grid-container">
        <!-- Summary Cards -->
        @if($isAsisten)
            <div class="card stat-card col-4">
                <div class="stat-icon" style="background-color: #E0E7FF; color: #4F46E5;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                </div>
                <div class="stat-info">
                    <span class="stat-value">{{ $jadwals->count() }}</span>
                    <span class="stat-label">Jadwal Jaga Lab</span>
                </div>
            </div>
            <div class="card stat-card col-4">
                <div class="stat-icon" style="background-color: #FEE2E2; color: #EF4444;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                </div>
                <div class="stat-info">
                    <span class="stat-value">{{ $totalPinalti }}m</span>
                    <span class="stat-label">Akumulasi Terlambat</span>
                </div>
            </div>
            <div class="card stat-card col-4">
                <div class="stat-icon" style="background-color: #FEF3C7; color: #F59E0B;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path></svg>
                </div>
                <div class="stat-info">
                    <span class="stat-value">{{ $reportsInRooms->where('id_user', auth()->id())->count() }}</span>
                    <span class="stat-label">Barang Rusak di Lab Jaga</span>
                </div>
            </div>
        @else
            <div class="card stat-card col-4">
                <div class="stat-icon" style="background-color: #E0E7FF; color: #4F46E5;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                </div>
                <div class="stat-info">
                    <span class="stat-value">{{ $jadwals->count() }}</span>
                    <span class="stat-label">Total Jadwal Praktikum</span>
                </div>
            </div>
            <div class="card stat-card col-4">
                <div class="stat-icon" style="background-color: #FEE2E2; color: #EF4444;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                </div>
                <div class="stat-info">
                    <span class="stat-value">{{ $totalPinalti }}</span>
                    <span class="stat-label">Pinalti Akumulatif</span>
                </div>
            </div>
            <div class="card stat-card col-4">
                <div class="stat-icon" style="background-color: #FEF3C7; color: #F59E0B;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path></svg>
                </div>
                <div class="stat-info">
                    <span class="stat-value">{{ $keterlambatans->count() }}</span>
                    <span class="stat-label">Laporan Keterlambatan</span>
                </div>
            </div>
        @endif

        <!-- Jadwal Detail Table -->
        <div class="card col-8">
            <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1.25rem;">{{ $isAsisten ? 'Jadwal Tugas Jaga' : 'Jadwal Praktikum Anda' }}</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Mata Kuliah</th>
                            <th>{{ $isAsisten ? 'Kelas' : 'Hari' }}</th>
                            <th>Waktu</th>
                            <th>Ruangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $jadwal)
                        <tr>
                            <td style="font-weight: 600;">{{ $jadwal->mataKuliah->nama_matkul ?? '-' }}</td>
                            <td>{{ $isAsisten ? ($jadwal->kelas->nama_kelas ?? '-') : $jadwal->hari }}</td>
                            <td>{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</td>
                            <td>{{ $jadwal->ruangan->nama_ruangan ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 2rem;">Belum ada jadwal yang terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Activity/Recent Column -->
        <div class="card col-4">
            <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1.25rem;">Info Terbaru</h3>
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @if($isAsisten)
                    @php
                        $userReport = $reportsInRooms->where('id_user', auth()->id())->first();
                    @endphp
                    @if($userReport)
                        <div style="padding: 1rem; background-color: #FFFBEB; border-radius: 12px; border: 1px solid #FEF3C7;">
                            <span style="display: block; font-size: 0.8rem; color: #92400E; margin-bottom: 0.25rem;">Laporan Barang Rusak</span>
                            <span style="font-weight: 600; display: block; color: #92400E;">{{ $userReport->nama_barang }} ({{ $userReport->ruangan->nama_ruangan }})</span>
                            <span style="font-size: 0.85rem; color: #B45309;">Status: {{ $userReport->status_laporan }}</span>
                        </div>
                    @elseif($reportsInRooms->isEmpty())
                        <div style="padding: 1rem; background-color: #FFFBEB; border-radius: 12px; border: 1px solid #FEF3C7;">
                            <span style="display: block; font-size: 0.8rem; color: #92400E; margin-bottom: 0.25rem;">Laporan Barang Rusak</span>
                            <span style="font-weight: 600; color: #B45309;">Semua barang normal.</span>
                        </div>
                    @endif
                @else
                    <div style="padding: 1rem; background-color: #F8FAFC; border-radius: 12px; border: 1px solid var(--border);">
                        <span style="display: block; font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.25rem;">Laporan Terakhir</span>
                        @if($keterlambatans->first())
                            <span style="font-weight: 600; display: block;">{{ $keterlambatans->first()->keterlambatan }} Menit Terlambat</span>
                            <span style="font-size: 0.85rem; color: var(--text-muted);">{{ $keterlambatans->first()->mataKuliah->nama_matkul }}</span>
                        @else
                            <span style="font-weight: 600; color: var(--text-muted);">Tidak ada laporan.</span>
                        @endif
                    </div>

                    @if($sampahReports->isNotEmpty())
                        <div style="padding: 1rem; background-color: #FEF2F2; border-radius: 12px; border: 1px solid #FEE2E2;">
                            <span style="display: block; font-size: 0.8rem; color: #991B1B; margin-bottom: 0.25rem;">Pinalti Sampah!</span>
                            <div style="display: flex; align-items: center; gap: 0.5rem; color: #991B1B;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                <span style="font-weight: 700; font-size: 0.9rem;">Kelas Terkena Pinalti</span>
                            </div>
                            <span style="font-size: 0.85rem; color: #B91C1C; display: block; margin-top: 0.25rem;">
                                Pelanggaran sampah ditemukan di <strong>{{ $sampahReports->first()->ruangan->nama_ruangan }}</strong>.
                            </span>
                            <a href="{{ route('kelas.sampah.show', $sampahReports->first()->id_laporan_sampah) }}" style="display: inline-block; margin-top: 0.75rem; font-size: 0.8rem; font-weight: 700; color: #991B1B; text-decoration: underline;">
                                Lihat Detail Laporan
                            </a>
                        </div>
                    @endif
                @endif
                
                <div style="margin-top: 0.5rem; display: flex; flex-direction: column; gap: 0.75rem;">
                    @role('ketua_tingkat')
                        <a href="{{ route('kelas.keterlambatan.create') }}" class="btn btn-primary" style="text-decoration: none; justify-content: center;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"></path></svg>
                            Lapor Keterlambatan
                        </a>
                    @endrole
                    @role('asisten')
                        <a href="{{ route('kelas.barang-rusak.index') }}" class="btn btn-primary" style="text-decoration: none; justify-content: center;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            Lihat Laporan Lab
                        </a>
                    @endrole
                    <a href="{{ route('profile.edit') }}" class="btn" style="border: 1px solid var(--border); text-decoration: none; justify-content: center;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        Ke Pengaturan Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
