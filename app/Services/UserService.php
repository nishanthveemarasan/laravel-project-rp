<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function index()
    {
        return User::paginate(10);
    }

    public function store($data)
    {
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return ['message' => 'user has been create successfully'];
    }

    public function update($data, User $user)
    {
        $user->update($data);

        return ['message' => 'user has been updated successfully'];
    }

    public function edit(User $user)
    {
        return $user;
    }
    public function delete(User $user)
    {
        $user->delete();

        return ['message' => 'user has been disabled successfully'];
    }

    public function restore($uuid)
    {
        $user = User::whereUuid($uuid)
            ->withTrashed()
            ->restore();

        return ['message' => 'user has been enabld successfully'];
    }
}
