<?php

namespace App\Helpers;

class ApiResource
{
     public static function success($data = null, string $message = 'OK', int $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'result' => $data,
        ], $code);
    }

    public static function error(string $message = 'Error', int $code = 400)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'result' => []
        ], $code);
    }
    
}
