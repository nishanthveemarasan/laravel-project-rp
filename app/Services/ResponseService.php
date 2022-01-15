<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;

class ResponseService
{

    public function result($data, $code)
    {
        $result = [
            'status' => $code,
            'data' => $data
        ];
        return response()->json($result, $code);
    }
}
