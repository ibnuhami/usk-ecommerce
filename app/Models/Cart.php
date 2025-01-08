<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    public function scopeUserCarts($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
