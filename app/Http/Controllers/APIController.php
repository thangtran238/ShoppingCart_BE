<?php

namespace App\Http\Controllers;

use App\Models\productLazada;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\File;

class APIController extends Controller
{
    public function getProducts()
    {
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    public function getOneProduct($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function checkOutCart(Request $request)
    {
        $data = $request->input('data');
        if (!is_array($data)) {
            $data = explode(',', $data);
        }

        $latestOrder = Order::orderBy('buying_time', 'desc')->value('buying_time');
        $latestOrder = (int)$latestOrder + 1;

        foreach ($data as $productId) {
            Order::create(['product_id' => $productId, 'buying_time' => $latestOrder]);
        }

        return response()->json(['message' => 'Checkout successful', 'data' => $data]);
    }
}
