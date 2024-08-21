<?php
namespace App\Http\Controllers;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AdminController extends Controller
{
    public function initializeRolesAndPermissions()
    {
        // Creating permissions
       // Permission::create(['name' => 'edit flight']);
      //  Permission::create(['name' => 'delete flight']);

        // Creating roles and assigning existing permissions
        $role = Role::create(['name' => 'editor']);
        $role->givePermissionTo('delete flight');

        // Assigning a role to a user
        $user = User::find(2);
        if ($user) {
            $user->assignRole('editor');

            // Assigning a permission directly to a user
            $user->givePermissionTo('delete articles');
        }

        return response()->json(['message' => 'Roles and permissions initialized']);
    }
}
