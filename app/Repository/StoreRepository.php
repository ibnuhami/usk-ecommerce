<?php

namespace App\Repository;
use Illuminate\Support\Facades\DB;
use App\Helpers\Response;
use App\Models\Store;
use App\Models\User;
use App\Enum\UserType;

class StoreRepository
{
    public function verifyAccount($data, $userId)
    {
        DB::transaction(function () use ($data, $userId) {
            $data =
            $payload = [
                'user_id' => $userId,
                'store_name' => $data['store_name'],
                'store_address' => $data['store_address'],
            ];
            User::where('id', $userId)->update([
                'user_type' => UserType::Admin->value
            ]);
            Store::insert($payload);
        });

        return (new Response)->json(1, 'Account verified', 200);
    }
}
