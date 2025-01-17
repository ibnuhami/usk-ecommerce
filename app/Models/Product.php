<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = ['id'];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id', 'id');
    }
    public function order()
    {
        return $this->hasOne(Order::class, 'product_id', 'id');
    }
}
