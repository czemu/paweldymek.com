<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Input;
use Auth;
use App;

class PostsController extends Controller
{
    public function show($slug)
	{
        $post = Post::where('slug', $slug)->first();

        if (is_null($post) OR ( ! Auth::check()) AND $post->is_published !== 1)
        {
            abort(404);
        }
        elseif ($post->locale != App::getLocale())
        {
            return redirect()->to($post->getUrl());
        }

        return view('posts.show', compact('post'))
            ->with('title', $post->name);
	}

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->first();

        if (is_null($tag))
        {
            abort(404);
        }

        $posts = Post::published()
            ->whereHas('tags', function ($query) use ($tag) {
                $query->where('tag_id', $tag->id);
            })
            ->locale(App::getLocale())
            ->orderBy('id', 'DESC')
            ->get();

        return view('posts.tag', compact('tag', 'posts'))
            ->with('title', 'Tag: '.$tag->name);
    }
}
