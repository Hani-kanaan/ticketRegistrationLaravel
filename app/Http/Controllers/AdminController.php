<?php

namespace App\Http\Controllers;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function initializeRolesAndPermissions()
    {

        Permission::create(['name' => 'add flight']);
        Permission::create(['name' => 'update flight']);
        Permission::create(['name' => 'delete flight']);
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('delete flight');
        $role->givePermissionTo('add flight');
        $role->givePermissionTo('update flight');
        return response()->json(['message' => 'Roles and permissions initialized']);
    }

    public function assignRole(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        if ($user) {
            $user->assignRole('admin');
            return response('role assigned');
        }
    }
}
