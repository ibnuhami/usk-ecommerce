<?php
namespace App\Helpers;

class Response {
    public function json($status = null, $message, $httpCode, $data = null) {
        $response = array_filter([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], function ($value) {
            return !is_null($value);
        });
        return response()->json($response, $httpCode);
    }
    public function web($status, $message) {
        return back()->with('message', [
            'status' => $status,
            'message' => $message
        ]);
    }
}
