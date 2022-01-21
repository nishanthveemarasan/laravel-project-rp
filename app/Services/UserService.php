<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Jobs\sendUserRegistrationEmailJob;

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

        sendUserRegistrationEmailJob::dispatch($user);

        return ['message' => 'Your Account has been created Successfully!!. Conformation Email has been sent to your mail!!'];
    }

    public function update($data, User $user)
    {
        $user->update($data);

        return ['message' => 'Data updated successfully'];
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
