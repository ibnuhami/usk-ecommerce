<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Repository\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function orderPage()
    {
        $order = (new OrderRepository)->getByUser(auth()->id());
        return view('order-list', compact('order'));
    }
    public function orderAdminList($storeId)
    {
        try {
            $order = (new OrderRepository)->getOrderByStore($storeId);
            Log::info($order);
            return response()->json($order);
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
        }
    }
    public function cancelOrder($orderId)
    {
        (new OrderRepository)->deleteOrder($orderId);
        return back()->with('message', 'Success Cancel Order');
    }
    public function confirmOrder($orderId)
    {
        (new OrderRepository)->approveOrder($orderId);
        return back()->with('message', 'Success Confirm Order');
    }
}
