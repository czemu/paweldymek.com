<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\Tag as SpatieTag;

class Tag extends SpatieTag
{
    public static function findFromSlug(string $slug, string $type = null, string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return static::query()
            ->where("slug->{$locale}", $slug)
            ->where('type', $type)
            ->first();
    }

    public function getUrl()
    {
        return route('posts.tag', ['slug' => $this->getTranslation('slug', \App::getLocale())]);
    }
}
