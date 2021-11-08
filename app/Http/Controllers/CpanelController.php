<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CpanelController extends Controller
{

    public function getRole(Request $request, $id)
    {

    }

    public function getRoles(Request $request): Collection
    {
        $filtros = $request->all();
        if (isset($filtros['user_id'])) {
            $roles = DB::table('model_has_roles')->where('model_id', $filtros['user_id']);
            return $roles->get();
        }
        $roles = DB::table('roles');
        return $roles->get();
    }

    public function assignRoles(Request $request)
    {
        User::assignRole($request->roles);
        return back()->with('msg', 'Roles modificados');
    }

    public function createRole(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        $role->givePermissionTo($request->permissions);
        return back()->with('msg', 'Rol creado!');
    }

    public function getCpanelRolesView()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $users = User::all();
        return view('cpanel.roles', compact('roles', 'permissions', 'users'));
    }

    public function getCpanelUsersView()
    {
        $users = User::all();
        return view('cpanel.users', compact('users'));
    }

    public function getCpanelProductsView()
    {
        $products = [];
        return view('cpanel.products', compact('products'));
    }
}
