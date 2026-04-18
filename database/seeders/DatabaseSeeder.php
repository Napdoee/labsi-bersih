<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(DatabaseImportSeeder::class);

        // Create a Super Admin user
        $superAdmin = User::factory()->create([
            'username' => 'superadmin',
            'password' => bcrypt('password'),
        ]);
        $superAdmin->assignRole('super_admin');

        // Create a Pak Adi user
        $pakAdi = User::factory()->create([
            'username' => 'pak_adi',
            'password' => bcrypt('password'),
        ]);
        $pakAdi->assignRole('pak_adi');

        // Create an Asisten
        $asisten = User::factory()->create([
            'username' => 'asisten',
            'password' => bcrypt('password'),
        ]);
        $asisten->assignRole('asisten');

        // Create a Ketua Tingkat
        $keti = User::factory()->create([
            'username' => 'keti',
            'password' => bcrypt('password'),
        ]);
        $keti->assignRole('ketua_tingkat');
    }
}
