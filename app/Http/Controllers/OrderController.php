<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends BaseController
{

    // public function __construct()
    // {
    //     $this->middleware('authorization');
    // }

    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        if (!$product) {
            return $this->out(status: "GAGAL", error: ['product tidak di temukan'], code: 404);
        }

        $data = new Order;
        $data->order_date = Carbon::now('Asia/jakarta');
        $data->product_id = $product->id;
        $data->costumer_id = $request->costumer_id;
        $data->qty = $request->qty;
        $data->price = $product->price * $data->qty;

        if ($data->save()) {
            return $this->out(data: $data, status: "OK", code: 201);
        } else {
            return $this->out(error: ['Data gagal di simpan'], status: "gagal", code: 504);
        }
    }

    public function findAll()
    {
        $order = Order::query()
            ->leftJoin('customers', 'customers.id', '=', 'orders.costumer_id')
            ->leftJoin('products', 'products.id', '=', 'orders.product_id');
        if (request()->has('q')) {
            $q = request('q');
            $order->where('products.title', 'LIKE', "%$q%");
        }

        $data = $order->paginate(10, [
            'orders.*',
            'customers.first_name',
            'customers.last_name',
            'customers.address',
            'customers.city',
            'products.title as product_title',
        ]);

        return $this->out(data: $data, status: "ok");
    }

    public function update(Order $order)
    {
        $product = Product::find(request('product_id'));

        if ($product == null) {
            return $this->out(status: "GAGAL", code: 404, error: ['product Tidak Di Temukan']);
        }

        $order->product_id = $product->id;
        $order->costumer_id = request('costumer_id');
        $order->qty = request('qty') + $order->qty;
        $order->price = $product->price * $order->qty;
        $hasil = $order->save();

        return $this->out(
            data: $hasil ? $order : null,
            status: $hasil ? "ok" : 'GAGAL',
            error: $hasil ? null : ['Gagal Merubah Data'],
            code: $hasil ? 201 : 504
        );
    }

    public function destroy(Order $order)
    {
        $hasil = $order->delete();
        return $this->out(
            data: $hasil ? $order : null,
            status: $hasil ? "ok" : 'GAGAL',
            error: $hasil ? null : ['Gagal Menghapus Data'],
            code: $hasil ? 201 : 504
        );
    }
}
