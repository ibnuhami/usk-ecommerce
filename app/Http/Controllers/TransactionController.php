<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use App\Repository\CartRepository;
use App\Repository\OrderRepository;
use App\Repository\TransactionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class TransactionController extends Controller
{
    public function checkoutTransactionPage($cartId)
    {
        $cart = (new CartRepository)->getCartById($cartId);
        if (!$cart)
            return 'Cart Not Found';
        return view('checkout-transaction', compact('cart'));
    }
    public function createTransactionPayment(Request $request)
    {
        try {
            $cartId = $request->input('cart_id');
            $payload = [
                'user_id' => auth()->id(),
                'order_number' => (new Order)->generateOrderCode($request->input('cart_data')),
                'total' => intval($request->input('total_paid')),
                'product_id' => $request->input('product_id'),
                'cart_id' => $cartId
            ];

            DB::beginTransaction();
            $orderId = (new OrderRepository)->insertGetId($payload);
            DB::commit();
            $cart = (new CartRepository)->getCartById($cartId);
            $order = (new OrderRepository)->getById($orderId);
            Log::info($cart);

            return view('payment-transaction', compact('order', 'cart'));
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
    public function paidOrder(Request $request)
    {
        Log::info($request->all());
        try {
            $cartId = $request->input('cart_id');
            $orderId = $request->input('order_id');
            $payloadTransaction = [
                'user_id' => auth()->id(),
                'order_id' => $orderId,
                'transaction_number' => Transaction::generateCodeNumber($request->all()),
                'total' => $request->input('total_price')
            ];
            DB::beginTransaction();
            (new TransactionRepository)->insertTransaction($payloadTransaction);
            (new CartRepository)->updateToAlready($cartId);
            (new OrderRepository)->updateToSuccess($orderId);
            DB::commit();

            $order = (new OrderRepository)->getById($orderId);
            $cart = (new CartRepository)->getCartByIdForce($cartId);
            return view('transaction.callback-success-transaction', compact('order', 'cart'))->with('message', 'Success Transaction Your Order');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return view('transaction.callback-failed-transaction')->with('message', 'Failed Transaction your Order');
        }
    }
    public function cancelPayment(Request $request)
    {
        try {
            $cartId = $request->input('cart_id');
            $orderId = $request->input('order_id');
            DB::beginTransaction();
            (new CartRepository)->deleteCart($cartId);
            (new OrderRepository)->rollbackTransaction($orderId);
            DB::commit();
            return redirect()->route('cartPage')->with('message', 'Cancel Payment Success');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return redirect()->route('cartPage')->with('message', 'Cancel Payment Failed');
        }
    }
 }
