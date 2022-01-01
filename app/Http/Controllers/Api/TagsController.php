<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TagResource;
use App\Http\Resources\PostResource;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TagResource::collection(
            Tag::orderBy('name', 'ASC')->paginate(request('per_page', 10))
        );
    }

    public function show(Request $request, string $id)
    {
        return new TagResource(Tag::findOrFail($id));
    }

    public function showBySlug(Request $request, string $slug)
    {
        return new TagResource(Tag::where('slug', $slug)->firstOrFail());
    }

    public function posts(Request $request, string $id)
    {
        $tag = Tag::findOrFail($id);

        $posts = $tag
            ->posts()
            ->filter($request->query('filter'))
            ->published()
            ->orderBy('posts.id', 'DESC')
            ->get();

        return PostResource::collection($posts);
    }
}
