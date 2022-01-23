<?php

namespace App\Http\Controllers;

use App\Events\UserWelcomeEvent;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\ResponseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Jobs\SendUserCreationMailJob;
use App\Jobs\sendUserRegistrationEmailJob;

class UserController extends Controller
{
    private $userService;
    private $result;

    public function __construct(UserService $service, ResponseService $responseService)
    {
        $this->userService = $service;
        $this->responseService = $responseService;
    }

    public function index()
    {
        $this->authorize('viewAny', User::class);
        try {
            $this->result['data'] = $this->userService->index();
        } catch (Exception $e) {
            DB::rollBack();
            $this->result['errors']['message'] = $e->getMessage();
        }

        return $this->result;
    }

    public function store(UserStoreRequest $request)
    {
        $this->authorize('create', User::class);
        try {
            DB::beginTransaction();
            $this->result = $this->userService->store($request->validated());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $this->result['errors']['message'] = $e->getMessage();
            $this->code = 500;
        }

        return $this->result;
    }

    public function edit(User $user)
    {
        $this->authorize('view', $user);
        try {
            $this->result['data'] = $this->userService->edit($user);
        } catch (Exception $e) {
            DB::rollBack();
            $this->result['errors']['message'] = $e->getMessage();
        }

        return $this->result;
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        try {
            $this->result['data'] = $this->userService->update($request->all(), $user);
        } catch (Exception $e) {
            DB::rollBack();
            $this->result['errors']['message'] = $e->getMessage();
        }
        return $this->result;
    }

    public function destroy(User $user)
    {
        $this->authorize('delete');
        try {
            $this->result['date'] = $this->userService->delete($user);
        } catch (Exception $e) {
            DB::rollBack();
            $this->result['errors']['message'] = $e->getMessage();
        }

        return $this->result;
    }

    public function restore(User $user)
    {
        $this->authorize('restore');
        try {
            $this->result['data'] = $this->userService->restore($user);
        } catch (Exception $e) {
            DB::rollBack();
            $this->result['errors']['message'] = $e->getMessage();
        }

        return $this->result;
    }
}
