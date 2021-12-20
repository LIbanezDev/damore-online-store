<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController
{
    public function updateUser(Request $request){
        $data = $request->all();
        $user = User::find(auth()->user()->id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->billing_address = $data['address'];
        $user->default_shipping_address = $data['address'];
        $user->password = $data['password'] == null ? $user->password : Hash::make($data['password']);
        $user->save();
        return back();
    }

    public function getProfileView() {
        $user = User::with('orders')->where('id', auth()->user()->id)->first();
        return view('user.profile', compact('user'));
    }

    public function removeUser($id) {
        User::destroy($id);
        return response('El usuario ha sido eliminado con exito');
    }

    public function getAll() {
        return User::with(['orders'])->get();
    }

}
