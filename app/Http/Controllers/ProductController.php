<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function deleteProduct($id)
    {
        Product::destroy($id);
        return ['ok' => true];
    }

    public function getProducts(Request $request)
    {
        $data = $request->all();
        if (isset($data['categories'])) {
            return DB::table('products')
                ->join('product_category', 'products.id', '=', 'product_category.product_id')
                ->whereIn('product_category.category_id', array_map('intval', explode(',', $data['categories'])))->get();
        } else {
            return Product::whereIn('id', array_map('intval', explode(',', $data['ids'])))->get();
        }
    }

    public function getProductsView()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('products', compact('products', 'categories'));
    }

    public function getProductView($name)
    {
        $p = Product::with(['categories', 'provider'])->where('name', '=', $name)->firstOrFail();
        $related = DB::table('products')->limit(3)->get();
        return view('product', compact('p', 'related'));
    }

    public function createCategory(Request $request)
    {
        try {
            $data = $request->all();
            $c = new Category();
            $c->name = $data['name'];
            $c->description = $data['name'];
            $c->icon = $data['icon'];
            $c->save();
            return back()->with(['ok' => 'true']);
        } catch (Exception $ex) {
            error_log($ex->getMessage());
            return ['ok' => false, 'msg' => 'Hubo un error ' . $ex->getMessage()];
        }
    }

    public function createProvider(Request $request)
    {
        try {
            $data = $request->all();
            $p = new Provider();
            $p->name = $data['name'];
            $p->landline = $data['phone'];
            $p->mobile_number = $data['phone'];
            $p->address = $data['address'];
            $p->description = $data['description'];
            $p->save();
            return back()->with(['ok' => 'true']);
        } catch (Exception $ex) {
            error_log($ex->getMessage());
            return ['ok' => false, 'msg' => 'Hubo un error ' . $ex->getMessage()];
        }
    }

    public function createProduct(Request $request)
    {
        try {
            $data = $request->all();
            $file_extension = $request->file->getClientOriginalExtension();
            $generated_new_name = time() . '.' . $file_extension;
            $upload_path = public_path('assets/products');
            $request->file->move($upload_path, $generated_new_name);
            $product = new Product();
            $product->name = $data['name'];
            $product->price = (int)$data['price'];
            $product->stock = (int)$data['stock'];
            $product->weight = (float)$data['weight'];
            $product->description = $data['description'];
            $product->profile_image = '/assets/products/' . $generated_new_name;
            $product->provider_id = $data['provider'];
            $product->save();
            $product->categories()->attach((int)$request->category);
            return ['ok' => true];
        } catch (Exception $ex) {
            error_log($ex->getMessage());
            return ['ok' => false, 'msg' => 'Hubo un error ' . $ex->getMessage()];
        }
    }
}
