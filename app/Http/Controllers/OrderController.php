<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getPendingOrders()
    {
        $orders = Order::with('product')
            ->where('customer_id', Auth::id())
            ->where('status', 'pending')
            ->get();

        return response()->json($orders);
    }

    
}
