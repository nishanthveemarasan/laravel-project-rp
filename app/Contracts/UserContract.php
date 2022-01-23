<?php

namespace App\Contracts;

use App\Models\Post;
use App\Models\User;

interface UserContract
{

    public function index();

    public function store($data);

    public function update($data, User $user);

    public function edit(User $user);

    public function delete(User $user);

    public function restore(User $user);
}
