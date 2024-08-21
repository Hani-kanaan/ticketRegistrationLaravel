<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Creating permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);

        // Creating roles and assigning existing permissions
        $role = Role::create(['name' => 'writer']);
        $role->givePermissionTo('edit articles');

        // Assigning a role to a user
        $user = User::find(2);
        if ($user) {
            $user->assignRole('editor');

            $user->givePermissionTo('delete articles');
        }
    }
}
