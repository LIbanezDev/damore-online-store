<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function register(Request $request): array
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
            return ['ok' => true];
        } catch (Exception $ex) {
            return ['ok' => false, 'msg' => 'Email invalido.'];
        }
    }
}
