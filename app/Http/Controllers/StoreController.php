<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Repository\StoreRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class StoreController extends Controller
{
    public function verifyAccount(Request $request)
    {
        try {
            Log::info(auth()->id());
            $data = $request->except(['_token', '_method']);
            (new StoreRepository)->verifyAccount($data, auth()->id());
            return (new Response)->web(1, 'Account verified');
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return response()->json([
                'message' => 'Failed to verify account'
            ], 500);
        }

    }
}
