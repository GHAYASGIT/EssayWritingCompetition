<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'permission-create',
            'permission-read',
            'permission-update',
            'permission-delete',
            'role-create',
            'role-read',
            'role-update',
            'role-delete',
            'profile-create',
            'profile-read',
            'profile-update',
            'profile-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'admin', 'name' => $permission]);
        }

        $super_admin_role = Role::create(['guard_name' => 'admin', 'name' => 'super-admin']);
        $admin_role = Role::create(['guard_name' => 'admin', 'name' => 'admin']);
        $admin_role->syncPermissions(['profile-create','profile-read','profile-update','profile-delete']);

        $super_admin_user = Admin::create([
            'name' => 'Super Admin', 
            'email' => 'superadmin@admin.com',
            'password' => bcrypt('Admin@123')
        ]);
        $super_admin_user->assignRole([$super_admin_role->id]);

        $admin_user = Admin::create([
            'name' => 'Pankaj Kumar', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Pankaj@123')
        ]);
        $admin_user->assignRole([$admin_role->id]);

    }
}
