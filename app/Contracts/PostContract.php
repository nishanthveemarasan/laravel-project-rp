<?php

namespace App\Contracts;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface PostContract
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
     * userPosts
     *
     * @param  User $user
     * @return void
     */
    public function userPosts(User $user);

    /**
     * update
     *
     * @param  mixed $data
     * @param  Post $post
     * @return void
     */
    public function update($data, Post $post);

    /**
     * edit
     *
     * @param  Post $post
     * @return void
     */
    public function edit(Post $post);

    /**
     * delete
     *
     * @param  Post $post
     * @return void
     */
    public function delete(Post $post);

    /**
     * restore
     *
     * @param  Post $post
     * @return void
     */
    public function restore(Post $post);
}
