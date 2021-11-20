<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    
    public static function boot()
    {
        parent::boot();

        static::deleting(function($post) {
            $post->posts()->detach();
        });
   }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function getUrl()
    {
        return route('posts.tag', $this->slug);
    }
}
