<?php
namespace App\Repository;

use App\Enum\CartStatus;
use App\Models\Cart;

class CartRepository
{
    public function getByUser($userID)
    {
        return Cart::where('user_id', $userID)
            ->where('status', CartStatus::NO_ORDER->value)
            ->with(['product'])
            ->get();
    }
    public function insertCart($data)
    {
        return Cart::insert($data);
    }
    public function getCartById($cartId)
    {
        if(!$cartId) return "ID Not Found";
        return Cart::where('id', $cartId)
            ->where('status', CartStatus::NO_ORDER->value)
            ->with(['product', 'product.store'])
            ->first();
    }
    public function getCartByIdForce($cartId)
    {
        if(!$cartId) return "ID Not Found";
        return Cart::where('id', $cartId)
            ->with(['product', 'product.store'])
            ->first();
    }
    public function deleteCart($cartId)
    {
        if(!$cartId) return "ID Not Found";
        return Cart::where('id', $cartId)->update(['status' => CartStatus::DELETE_ORDER->value]);
    }
    public function updateToAlready($id)
    {
        if(!$id) return "ID Not Found";
        return Cart::where('id', $id)->update(['status' => CartStatus::ALREADY_ORDER->value]);
    }
    public function rollbackCart($id)
    {
        if(!$id) return "ID Not Found";
        return Cart::where('id', $id)->update(['status' => CartStatus::NO_ORDER->value]);
    }
}
