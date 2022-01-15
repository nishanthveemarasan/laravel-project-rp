<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\ResponseService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    private $userService;
    private $responseService;
    private $code = 200;
    private $result;

    public function __construct(UserService $service, ResponseService $responseService)
    {
        $this->userService = $service;
        $this->responseService = $responseService;
    }

    public function index()
    {
        try {
            $this->result = $this->userService->index();
        } catch (Exception $e) {
            DB::rollBack();
            $this->result['errors']['message'] = $e->getMessage();
            $this->code = 500;
        }

        return $this->responseService->result($this->result, $this->code);
    }

    public function store(UserStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->result = $this->userService->store($request->validated());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $this->result['errors']['message'] = $e->getMessage();
            $this->code = 500;
        }

        return $this->responseService->result($this->result, $this->code);
    }

    public function edit(User $user)
    {
        try {
            $this->result = $this->userService->edit($user);
        } catch (Exception $e) {
            DB::rollBack();
            $this->result['errors']['message'] = $e->getMessage();
            $this->code = 500;
        }

        return $this->responseService->result($this->result, $this->code);
    }

    public function update(Request $request, User $user)
    {
        try {
            $this->result = $this->userService->update($request->all(), $user);
        } catch (Exception $e) {
            DB::rollBack();
            $this->result['errors']['message'] = $e->getMessage();
            $this->code = 500;
        }
        return $this->responseService->result($this->result, $this->code);
    }

    public function destroy(User $user)
    {
        try {
            $this->result = $this->userService->delete($user);
        } catch (Exception $e) {
            DB::rollBack();
            $this->result['errors']['message'] = $e->getMessage();
            $this->code = 500;
        }

        return $this->responseService->result($this->result, $this->code);
    }

    public function restore($uuid)
    {
        try {
            $this->result = $this->userService->restore($uuid);
        } catch (Exception $e) {
            DB::rollBack();
            $this->result['errors']['message'] = $e->getMessage();
            $this->code = 500;
        }

        return $this->responseService->result($this->result, $this->code);
    }
}
