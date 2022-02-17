<?php

namespace App\Services;

use Illuminate\Http\Response;

class ResponseService
{

    /**
     * result
     *
     * @param  mixed $data
     * @param  mixed $code
     * @return Response
     * 
     */
    public function result($data = [], $code = 200)
    {
        $result = [
            'status' => $code,
            'data' => $data
        ];
        return response()->json($result, $code);
    }
}
