<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App;

class RssController extends Controller
{
    public function posts()
    {
        $posts = Post::locale(App::getLocale())
            ->published()
            ->orderBy('id', 'DESC')
            ->take(20)
            ->get();

        return response(view('rss.posts', compact('posts')), 200, [
            'Content-Type' => 'application/xml'
        ]);
    }
}
