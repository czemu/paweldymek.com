<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PostResource::collection(
            Post::select('posts.*')
                ->published()
                ->orderBy('posts.id', 'DESC')
                ->paginate(request('per_page', 10))
        );
    }

    public function show(Request $request, $id)
    {
        return new PostResource(Post::findOrFail($id));
    }
}
