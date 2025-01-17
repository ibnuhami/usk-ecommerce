<?php

namespace App\Repository;

use App\Models\Transaction;

class TransactionRepository
{
    public function getById($transactionId)
    {
        if (!$transactionId)
            return "Transaction ID Not Found";
        return Transaction::where('id', $transactionId)->first();
    }
    public function insertTransaction($data)
    {
        return Transaction::insert($data);
    }
    public function getByOrderId($orderId)
    {
        return Transaction::where('order_id', $orderId)->first();
    }
}
