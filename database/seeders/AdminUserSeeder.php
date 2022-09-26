<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
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

        $adminRole = Role::firstOrCreate(['name' => 'super admin']);
        $adminRole->givePermissionTo(User::PERMISSIONS);

        $adminUser = User::factory()->create([
            'email' => 'airalyxd@admin.com',
            'password' => bcrypt('12345678')
        ]);
        $adminUser->assignRole(User::ROLES['super_admin']);
    }
}

 