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
        $owner_user->name = 'Maria';
        $owner_user->email = 'owner@damore.cl';
        $owner_user->email_verified_at = now();
        $owner_user->remember_token = Str::random(10);
        $owner_user->password = Hash::make('123456');
        $owner_user->save();

        $seller_user = new User();
        $seller_user->name = 'José';
        $seller_user->email = 'seller@damore.cl';
        $seller_user->email_verified_at = now();
        $seller_user->remember_token = Str::random(10);
        $seller_user->password = Hash::make('123456');
        $seller_user->save();

        $cliente_user = new User();
        $cliente_user->name = 'Daniel';
        $cliente_user->email = 'client@damore.cl';
        $cliente_user->email_verified_at = now();
        $cliente_user->remember_token = Str::random(10);
        $cliente_user->password = Hash::make('123456');
        $cliente_user->save();

        $webmaster_user = new User();
        $webmaster_user->name = 'Martin';
        $webmaster_user->email = 'webmaster@damore.cl';
        $webmaster_user->email_verified_at = now();
        $webmaster_user->remember_token = Str::random(10);
        $webmaster_user->password = Hash::make('123456');
        $webmaster_user->save();

        $client = Role::create(['name' => 'cliente']);
        $seller = Role::create(['name' => 'vendedor']);
        $web_admin = Role::create(['name' => 'administrador web']);
        $owner = Role::create(['name' => 'dueño']);

        Permission::create(['name' => 'acceder a cpanel']);
        Permission::create(['name' => 'gestionar roles y permisos']);
        Permission::create(['name' => 'gestionar usuarios administradores']);
        Permission::create(['name' => 'gestionar ventas']);
        Permission::create(['name' => 'gestionar pedidos']);
        Permission::create(['name' => 'crear productos']);
        Permission::create(['name' => 'eliminar productos']);
        Permission::create(['name' => 'modificar productos']);

        $seller->givePermissionTo(['acceder a cpanel', 'gestionar ventas', 'gestionar pedidos']);
        $web_admin->givePermissionTo(['acceder a cpanel', 'crear productos', 'eliminar productos', 'modificar productos']);
        $owner->givePermissionTo(['acceder a cpanel', 'gestionar roles y permisos', 'gestionar usuarios administradores',
            'crear productos', 'eliminar productos', 'modificar productos']);

        $cliente_user->assignRole('cliente');
        $owner_user->assignRole('dueño');
        $seller_user->assignRole('vendedor');
        $webmaster_user->assignRole('administrador web');
    }
}
