<?php

namespace App\Services;

use App\Contracts\UserContract;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
<<<<<<< HEAD
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendUserCreationMailJob;
use App\Mail\UserCreationSuccessMail;
=======
use App\Jobs\sendUserRegistrationEmailJob;
>>>>>>> manage-product

class UserService implements UserContract
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return User::withTrashed()->paginate(10);
    }

    /**
     * store
     *
     * @param  array $data
     * @return array
     */
    public function store($data)
    {
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
<<<<<<< HEAD

        $user->assignRole('user');

        SendUserCreationMailJob::dispatch($user);
=======
>>>>>>> manage-product

        $user->assignRole('user');

        sendUserRegistrationEmailJob::dispatch($user);

        return ['message' => 'Your Account has been created Successfully!!. Conformation Email has been sent to your mail!!'];
    }

    /**
     * update
     *
     * @param  array $data
     * @param  User $user
     * @return array
     */
    public function update($data, User $user)
    {
        $user->update($data);

        return ['message' => 'Data updated successfully'];
    }

    /**
     * edit
     *
     * @param  User $user
     * @return void
     */
    public function edit(User $user)
    {
        return $user;
    }
    /**
     * delete
     *
     * @param  User $user
     * @return array
     */
    public function delete(User $user)
    {
        $user->delete();

        return ['message' => 'user has been disabled successfully'];
    }

<<<<<<< HEAD
=======
    /**
     * restore
     *
     * @param  User $user
     * @return array
     */
>>>>>>> manage-product
    public function restore(User $user)
    {
        $user->restore();

        return ['message' => 'user has been enabld successfully'];
    }
}
