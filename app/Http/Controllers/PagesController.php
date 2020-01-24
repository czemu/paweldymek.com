<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Input;

class PagesController extends Controller
{
    public function home()
	{
        $posts = Post::locale(\App::getLocale())
            ->published()
            ->orderBy('id', 'DESC')
            ->get();

        return view('pages.home', compact('posts'));
	}
}
