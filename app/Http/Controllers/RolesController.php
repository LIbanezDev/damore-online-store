<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolesController
{
    public function removeRole(Request $request) {
        foreach ($request->roles as $role) {
            Role::where('name', '=', $role)->delete();
        }
        return back()->with('msg', 'Rol/es eliminado');
    }

    public function getRole($roleId) {
        return Role::with('users')->where('id', '=', $roleId)->first();
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
        $user = User::findOrFail((int)$request->userId);
        $user->roles()->detach();
        $user->assignRole($request->roles);
        $user->save();
        return back()->with('msg', 'Roles modificados');
    }

    public function createRole(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        $role->givePermissionTo($request->permissions);
        return back()->with('msg', 'Rol creado!');
    }
}
