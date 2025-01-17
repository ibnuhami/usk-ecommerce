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
            ->orWhere('status', OrderStatus::CONFIRM->value)
            ->orWhere('status', OrderStatus::PAID->value)
            ->with(['product', 'user'])
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
            ->update(['status' => OrderStatus::PAID->value]);
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
    public function getOrderByStore($storeId)
    {
        if (!$storeId)
            return 'Store ID Not Found';
        return Order::where('store_id', $storeId)
            ->with(['product', 'user'])
            ->where('status', OrderStatus::PAID->value)
            ->get();
    }
    public function approveOrder($id)
    {
        return Order::where('id', $id)
            ->update(['status' => OrderStatus::CONFIRM->value]);
    }
}
