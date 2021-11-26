<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    
    public static function boot(): void
    {
        parent::boot();

        static::deleting(function($post) {
            $post->posts()->detach();
        });
   }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function getUrl(): string
    {
        return route('posts.tag', $this->slug);
    }
}
