<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function updateStatus($id, Request $request) {
        try {
            $data = $request->all();
            $order = Order::with('products')->where('id', $id)->first();
            $order->status = $data['status'];
            if ($data['status'] == 'rechazada') {
                foreach ($order->products as $p) {
                    $p->stock = $p->stock + $p->pivot->amount;
                    $p->save();
                }
            }
            $order->save();
            return ['ok' => true];
        } catch (Exception $ex) {
            error_log($ex->getMessage());
            return ['ok' => false, 'msg' => 'Hubo un error ' . $ex->getMessage()];
        }
    }

    public function create(Request $request)
    {
        try {
            $data = $request->all();
            $order = new Order();
            if(isset($request->file)){
                $file_extension = $request->file->getClientOriginalExtension();
                $generated_new_name = time() . '.' . $file_extension;
                $upload_path = public_path('assets/bank_transfers');
                $request->file->move($upload_path, $generated_new_name);
                $order->receipt = 'assets/bank_transfers/'.$generated_new_name;
            }
            $order->user_id = $data['user_id'] ?? null;
            $order->status = 'aceptada';
            $order->email = $data['email'];
            $order->total = (int) $data['total'];
            $order->shipping_address = $data['shipping_address'];
            $order->order_type = $data['order_type'];
            $order->save();
            foreach ($data['products'] as $p) {
                $k = json_decode($p);
                $order->products()->attach($k->id, ['amount' => (int) $k->amount]);
                $product = Product::where('id', (int) $k->id)->first();
                $product->stock = $product->stock - (int) $k->amount;
                $product->save();
            }
            return ['ok' => true];
        } catch (Exception $ex) {
            error_log($ex->getMessage());
            return ['ok' => false, 'msg' => 'Hubo un error ' . $ex->getMessage()];
        }
    }
}
