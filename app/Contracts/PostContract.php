<?php

namespace App\Contracts;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface PostContract
{

    public function index();

    public function store($data);

    public function userPosts(User $user);

    public function update($data, Post $post);

    public function edit(Post $post);

    public function delete(Post $post);

    public function restore(Post $post);
}
