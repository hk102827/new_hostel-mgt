<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Pehle saari permissions bana lo
        $permissions = [
            'dashboard.view',

            'students.view',
            'students.manage',

            'rooms.view',
            'rooms.manage',

            'academy.view',
            'academy.manage',

            'mess.view',
            'mess.manage',

            'kitchen.manage',
            'kitchen.view',

            'fees.view',
            'fees.manage',

            'teachers.view',
            'teachers.manage',

            'reports.view',
            'reports.manage',

            'attendance.mark',
            'attendance.daily',
            'attendance.monthly',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ✅ Roles banao
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $admin      = Role::firstOrCreate(['name' => 'admin']);
        $teacher    = Role::firstOrCreate(['name' => 'teacher']);

        // ✅ Super Admin ko sab permissions
        $superAdmin->givePermissionTo(Permission::all());

        // ✅ Admin ke liye permissions
        $admin->givePermissionTo([
            'dashboard.view',
            'students.manage',
            'rooms.manage',
            'fees.manage',
            'teachers.view',
            'reports.view',
            'attendance.daily',
        ]);

        // ✅ Teacher ke liye permissions
        $teacher->givePermissionTo([
            'dashboard.view',
            'students.view',
            'rooms.view',
            'kitchen.view',
            'teachers.view',
            'reports.view',
            'academy.view',
            'attendance.mark',
            'attendance.daily',
        ]);
    }
}
