<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController
{
    public function removeUser($id) {
        User::destroy($id);
        return response('El usuario ha sido eliminado con exito');
    }

    public function getAll() {
        return User::with(['orders'])->get();
    }

}
