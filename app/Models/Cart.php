<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function order(){
        return $this->belongsTo(Order::class, 'cart_id');
    }
}
