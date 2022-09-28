<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::PERMISSIONS as $permission) {
            Permission::findOrCreate($permission);
        }

        $superAdmin = Role::findByName(User::ROLES['super_admin']);
        $superAdmin->givePermissionTo(User::PERMISSIONS);

        $employeePermissions = [
            User::PERMISSIONS['user.index'],
            User::PERMISSIONS['user.show'],
            User::PERMISSIONS['role.index'],
            User::PERMISSIONS['role.show'],
        ];
        $employee = Role::findByName(User::ROLES['employee']);
        $employee->givePermissionTo($employeePermissions);
    }
}
