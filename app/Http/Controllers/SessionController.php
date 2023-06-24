<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class SessionController extends Controller
{
    public function receiveSessionData(Request $request)
    {
        $sessionData = $request->input('sessionData');

        // Assuming the session data contains the cart information
        $cartData = $sessionData['cart'];

        // Store the cart data in the orders table
        $order = new Order();
        $order->cart = json_encode($cartData);
        $order->save();

        // Clear the cart session
        $request->session()->forget('cart');

        // Perform any additional actions or return a response as needed
        return response()->json(['message' => 'Order placed successfully']);
    }
}
