<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $owner_user = new User();
        $owner_user->name = 'Dueño';
        $owner_user->email = 'owner@damore.cl';
        $owner_user->email_verified_at = now();
        $owner_user->remember_token = Str::random(10);
        $owner_user->password = Hash::make('123456');
        $owner_user->save();
        $client = Role::create(['name' => 'client']);
        $admin = Role::create(['name' => 'admin']);
        $owner = Role::create(['name' => 'owner']);
        Permission::create(['name' => 'acceder a cpanel']);
        Permission::create(['name' => 'gestionar roles y permisos']);
        Permission::create(['name' => 'crear productos']);
        Permission::create(['name' => 'eliminar productos']);
        Permission::create(['name' => 'modificar productos']);
        $admin->givePermissionTo('acceder a cpanel');
        $owner->givePermissionTo(['acceder a cpanel', 'gestionar roles y permisos', 'crear productos',
            'eliminar productos', 'modificar productos']);
        $owner_user->assignRole('owner');
    }
}
