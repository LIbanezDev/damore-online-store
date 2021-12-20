<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Provider;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CpanelController extends Controller
{
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
        $roles = Role::all();
        return view('cpanel.users', compact('users', 'roles'));
    }

    public function getCpanelProductsView()
    {
        $products = Product::all();
        $providers = Provider::all();
        $categories = Category::all();
        return view('cpanel.products', compact('products', 'providers', 'categories'));
    }

    public function getCpanelOrdersView()
    {
        $orders = Order::with(['products', 'user'])->get();
        return view('cpanel.orders', compact('orders'));
    }

}
