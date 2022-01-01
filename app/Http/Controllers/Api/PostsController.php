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
    public function index(Request $request)
    {
        return PostResource::collection(
            Post::select('posts.*')
                ->filter($request->query('filter'))
                ->published()
                ->orderBy('posts.created_at', 'DESC')
                ->paginate(request('per_page', 10))
        );
    }

    public function show(Request $request, string $id)
    {
        return new PostResource(Post::published()->findOrFail($id));
    }

    public function showBySlug(Request $request, string $slug)
    {
        return new PostResource(Post::where('slug', $slug)->published()->firstOrFail());
    }
}
