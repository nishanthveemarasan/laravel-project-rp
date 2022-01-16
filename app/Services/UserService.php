<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendUserCreationMailJob;
use App\Mail\UserCreationSuccessMail;

class UserService
{
    public function index()
    {
        return User::withTrashed()->paginate(10);
    }

    public function store($data)
    {
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $user->assignRole('user');

        SendUserCreationMailJob::dispatch($user);

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

    public function restore(User $user)
    {
        $user->restore();

        return ['message' => 'user has been enabld successfully'];
    }
}
