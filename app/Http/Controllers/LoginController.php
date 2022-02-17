<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
<<<<<<< HEAD
=======
    /**
     * apiResponseService
     *
     * @var mixed
     */
>>>>>>> manage-product
    protected $apiResponseService;

    /**
     * result
     *
     * @var mixed
     */
    protected $result;

    /**
     * __construct
     *
     * @param  ResponseService $apiResponseService
     * @return void
     */
    public function __construct(ResponseService $apiResponseService)
    {
        $this->apiResponseService = $apiResponseService;
    }
<<<<<<< HEAD
    public function login(Request $request)
=======

    /**
     * login
     *
     * @param  AuthRequest $request
     * @return void
     */
    public function login(AuthRequest $request)
>>>>>>> manage-product
    {
        if (Auth::attempt($request->all())) {
            $user = Auth::user();
            $this->result['token'] = $user->createToken('api-application')->accessToken;
            $this->result['name'] = $user->first_name;
            return $this->apiResponseService->result($this->result, 200);
        } else {
            $this->result['error'] = "Incorrect Login details";
<<<<<<< HEAD
        }
        return $this->result;
=======
            return $this->apiResponseService->result($this->result, 500);
        }
>>>>>>> manage-product
    }
}
