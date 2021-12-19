<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function findAll()
    {
        $data = Product::paginate(10, [
            'id', 'title', 'category', 'price', 'stock', 'rate', 'free_shipping'
        ]);

        if (count($data) == 0) {
            return $this->out(data: [], status: 'Kosong', code: 200);
        }
        return $this->out(data: $data, status: 'Ok');
    }

    public function findOne(Product $product)
    {
        return $this->out(data: $product, status: 'Ok');
    }
}
