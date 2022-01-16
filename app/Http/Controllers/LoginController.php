<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $code = 200;
    protected $apiResponseService;
    protected $result;
    public function __construct(ResponseService $apiResponseService)
    {
        $this->apiResponseService = $apiResponseService;
    }
    public function login(AuthRequest $request)
    {
        if (Auth::attempt($request->all())) {
            $user = Auth::user();
            $this->result['token'] = $user->createToken('api-application')->accessToken;
            $this->result['name'] = $user->first_name;
        } else {
            $this->result['error'] = "Incorrect Login details";
            $this->code = 500;
        }
        return $this->apiResponseService->result($this->result, $this->code);
    }
}
