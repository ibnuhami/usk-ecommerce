<?php

namespace App\Http\Controllers;

use App\Repository\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderPage() {
        $order = (new OrderRepository)->getByUser(auth()->id());
        return view('order-list', compact('order'));
    }
    public function cancelOrder($orderId) {
        (new OrderRepository)->deleteOrder($orderId);
        return back()->with('message', 'Success Cancel Order');
    }
}
