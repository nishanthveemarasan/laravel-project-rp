<?php

namespace App\Contracts;

use App\Models\Post;
use App\Models\User;

interface UserContract
{

    /**
     * index
     *
     * @return void
     */
    public function index();

    /**
     * store
     *
     * @param  mixed $data
     * @return void
     */
    public function store($data);

    /**
     * update
     *
     * @param  mixed $data
     * @param  User $user
     * @return void
     */
    public function update($data, User $user);

    /**
     * edit
     *
     * @param  User $user
     * @return void
     */
    public function edit(User $user);

    /**
     * delete
     *
     * @param  User $user
     * @return void
     */
    public function delete(User $user);

    /**
     * restore
     *
     * @param  User $user
     * @return void
     */
    public function restore(User $user);
}
