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

        // Create a Super Admin user
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        $superAdmin->assignRole('super_admin');

        // Create a Pak Adi user
        $pakAdi = User::factory()->create([
            'name' => 'Pak Adi',
            'email' => 'pak_adi@admin.com',
            'password' => bcrypt('password'),
        ]);
        $pakAdi->assignRole('pak_adi');

        // Create an Asisten
        $asisten = User::factory()->create([
            'name' => 'Asisten Lab',
            'email' => 'asisten@admin.com',
            'password' => bcrypt('password'),
        ]);
        $asisten->assignRole('asisten');

        // Create a Ketua Tingkat
        $keti = User::factory()->create([
            'name' => 'Ketua Tingkat',
            'email' => 'keti@admin.com',
            'password' => bcrypt('password'),
        ]);
        $keti->assignRole('ketua_tingkat');
    }
}
