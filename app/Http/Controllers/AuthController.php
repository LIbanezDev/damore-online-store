<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function login(): array
    {
        $credentials = request()->only('email', 'password');

        if (Auth::attempt($credentials, request()->remember)) {
            request()->session()->regenerate();

            return ['ok' => true];
        }

        return ['ok' => false, 'msg' => 'Credenciales no validas'];
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->to('/');
    }

    public function registerClient(Request $request): array
    {
        try {
            $data = $request->all();
            $usuario = new User();
            $usuario->name = $data['name'];
            $usuario->email = $data['email'];
            $usuario->email_verified_at = now();
            $usuario->remember_token = Str::random(10);
            $usuario->password = Hash::make($data['password']);
            $usuario->save();
            $usuario->assignRole('client');
            return ['ok' => true];
        } catch (Exception $ex) {
            return ['ok' => false, 'msg' => 'El email ya ha sido utilizado.'];
        }
    }

    public function createRole(Request $request): RedirectResponse
    {
        $role = Role::create(['name' => $request->name]);
        return back()->with('mensaje', 'Rol creado!');
    }

    public function createPermission(Request $request): RedirectResponse
    {
        Permission::create(['name' => $request->name]);
        return back()->with('mensaje', 'Permiso creado!');
    }

    public function getCpanelView()
    {
        $permissions = Permission::all();
        return view('auth.cpanel', compact('permissions'));
    }
}
