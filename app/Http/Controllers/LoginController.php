<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $apiResponseService;
    protected $result;
    public function __construct(ResponseService $apiResponseService)
    {
        $this->apiResponseService = $apiResponseService;
    }
    public function login(Request $request)
    {
        if (Auth::attempt($request->all())) {
            $user = Auth::user();
            $this->result['token'] = $user->createToken('api-application')->accessToken;
            $this->result['name'] = $user->first_name;
        } else {
            $this->result['error'] = "Incorrect Login details";
        }
        return $this->result;
    }
}
