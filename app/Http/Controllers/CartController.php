<?php

namespace App\Http\Controllers;
use App\Helpers\Response;
use App\Repository\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function cartPage()
    {
        try {
            $carts = (new CartRepository)->getByUser(auth()->user()->id);
            Log::info($carts);
            return view('carts', compact('carts'));
            // return response()->json($carts);
        } catch (\Throwable $e) {
            Log::info($carts);
            Log::info($e->getMessage());
        }

    }
    public function insertToCart(Request $request)
    {
        $payload = [
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => isset($request->quantity) ? $request->quantity : 1,
            'total' => 0
        ];
        (new CartRepository)->insertCart($payload);
        return (new Response)->web(1, 'Success Insert Cart');
    }
    public function cancelCart($cartID)
    {
        (new CartRepository)->deleteCart($cartID);
        return (new Response)->web(1, 'Success Delete Cart');
    }
}
