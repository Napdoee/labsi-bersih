<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            'report_trash',
            'report_broken_item',
            'report_assistant_lateness',
            'view_broken_item_reports',
            'view_attendance',
            'view_assistant_lateness_reports',
            'manage_accounts',
            'manage_lab_sessions',
            'manage_database',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Roles and assign created permissions

        // 1. Ketua Tingkat (Keti)
        $roleKeti = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'ketua_tingkat']);
        $roleKeti->givePermissionTo([
            'report_trash',
            'report_broken_item',
            'report_assistant_lateness',
        ]);

        // 2. Asisten
        $roleAsisten = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'asisten']);
        $roleAsisten->givePermissionTo([
            'view_broken_item_reports',
            'view_attendance',
        ]);

        // 3. Pak Adi
        $rolePakAdi = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'pak_adi']);
        $rolePakAdi->givePermissionTo([
            'view_assistant_lateness_reports',
            'view_broken_item_reports',
        ]);

        // 4. Super Admin
        $roleSuperAdmin = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super_admin']);
        $roleSuperAdmin->givePermissionTo([
            'manage_accounts',
            'manage_lab_sessions',
            'manage_database',
        ]);
    }
}
