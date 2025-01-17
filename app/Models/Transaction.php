<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    public static function generateCodeNumber($data)
    {
        return $data['cart_id'] . '-' . $data['order_id'] . '-' . time();
    }
    public function order()
    {
        return $this->hasOne(Order::class, 'order_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
