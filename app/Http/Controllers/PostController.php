<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(PostCreateRequest $request)
    {
        $this->authorize('createPost', Post::class);
        dd($request->validated());
    }
}
