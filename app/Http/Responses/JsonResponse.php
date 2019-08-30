<?php

namespace App\Http\Responses;

use Carbon\Carbon;

class  JsonResponse
{
    public static function Success($message, $data = null)
    {
        $json = [];
        if (isset($data)) {
            $json = ['code' => 200, 'message' => $message, 'data' => $data];
        } else {
            $json = ['code' => 200, 'message' => $message];
        }
        return response()->json($json,200);
    }

    public static function Failed($message, $data = null)
    {
        $json = [];
        if (isset($data)) {
            $json = ['code' => 500, 'message' => $message, 'data' => $data];
        } else {
            $json = ['code' => 500, 'message' => $message];
        }
        return response()->json($json,200);

    }
}
