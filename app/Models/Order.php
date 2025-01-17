<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_id', 'store_id', 'total_price', 'status'];

    public function generateOrderCode($data)
    {
        return 'c' . auth()->id() . '-' . '-' . strval(floor(microtime(true) * 1000));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class, '');
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'order_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }
}
