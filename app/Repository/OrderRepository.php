<?php
namespace App\Repository;

use App\Enum\OrderStatus;
use App\Models\Order;

class OrderRepository
{
    public function getByUser($userId)
    {
        if (!$userId)
            return "User ID Not Found";
        return Order::where('user_id', $userId)
            ->where('status', OrderStatus::PENDING->value)
            ->with('product')
            ->get();
    }
    public function insertOrder($data)
    {
        return Order::insert($data);
    }
    public function insertGetId($data)
    {
        return Order::insertGetId($data);
    }
    public function getTotal($id)
    {
        return Order::select('total')->where('id', $id)->first();
    }
    public function getById($id)
    {
        return Order::where('id', $id)
            ->with(['store', 'cart', 'product'])
            ->first();
    }
    public function updateToSuccess($id)
    {
        return Order::where('id', $id)
            ->update(['status' => OrderStatus::SUCCESS->value]);
    }
    public function rollbackTransaction($id)
    {
        return Order::where('id', $id)
            ->update(['status' => OrderStatus::PENDING->value]);
    }
    public function deleteOrder($id)
    {
        return Order::where('id', $id)
            ->delete();
    }
}
