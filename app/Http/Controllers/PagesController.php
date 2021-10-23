<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Input;

class PagesController extends Controller
{
    public function home()
	{
        setlocale(LC_TIME, config('app.locale'));
        
        $posts = Post::locale(\App::getLocale())
            ->published()
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('pages.home', compact('posts'));
	}
}
