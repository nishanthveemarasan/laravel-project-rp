<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Support\Facades\Log;
use App\Events\UserPostCreatedEmail;
use App\Jobs\sendUserPostCreatedMailJob;
use App\Http\Requests\PostCreateUpdateRequest;

class PostController extends Controller
{
    private $postService;
    private $result;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(PostCreateUpdateRequest $request)
    {
        $this->authorize('create', Post::class);
        try {
            $this->result = $this->postService->store($request->validated());
        } catch (Exception $e) {
            $this->result['errors']['message'] = $e->getMessage();
            $this->code = 500;
        }

        return $this->result;
    }

    public function index()
    {
        $this->authorize('viewAny', Post::class);
        try {
            $this->result['data'] = $this->postService->index();
        } catch (Exception $e) {
            $this->result['errors']['message'] = $e->getMessage();
            $this->code = 500;
        }

        return $this->result;
    }

    public function ownPosts()
    {
        $this->authorize('ownPosts', Post::class);
        try {
            $this->result['data'] = $this->postService->userPosts(auth()->user());
        } catch (Exception $e) {
            $this->result['errors']['message'] = $e->getMessage();
            $this->code = 500;
        }

        return $this->result;
    }

    public function userPosts(User $user)
    {
        $this->authorize('viewAny', Post::class);
        try {
            $this->result['data'] = $this->postService->userPosts($user);
        } catch (Exception $e) {
            $this->result['errors']['message'] = $e->getMessage();
            $this->code = 500;
        }

        return $this->result;
    }

    public function edit(Post $post)
    {
        $this->authorize('view', $post);
        try {
            $this->result['data'] = $this->postService->edit($post);
        } catch (Exception $e) {
            $this->result['errors']['message'] = $e->getMessage();
            $this->code = 500;
        }

        return $this->result;
    }

    public function update(PostCreateUpdateRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        try {
            $this->result['data'] = $this->postService->update($request->all(), $post);
        } catch (Exception $e) {
            $this->result['errors']['message'] = $e->getMessage();
        }
        return $this->result;
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        try {
            $this->result['date'] = $this->postService->delete($post);
        } catch (Exception $e) {
            $this->result['errors']['message'] = $e->getMessage();
        }

        return $this->result;
    }

    public function restore(Post $post)
    {
        // dd($post);
        $this->authorize('restore', $post);
        try {
            $this->result['data'] = $this->postService->restore($post);
        } catch (Exception $e) {
            $this->result['errors']['message'] = $e->getMessage();
        }

        return $this->result;
    }
}
