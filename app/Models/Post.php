<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($post) {
            $post->tags()->detach();
        });
   }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('large')->crop('crop-center', 1024, 655);
        $this->addMediaConversion('medium')->crop('crop-center', 500, 320);
        $this->addMediaConversion('small')->crop('crop-center', 100, 80);
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function getUrl()
    {
        return ! empty($this->external_url) ? $this->external_url : url($this->locale.'/post/'.$this->slug);
    }

    public function getExternalDomain()
    {
        return parse_url($this->getUrl(), PHP_URL_HOST);
    }

    public function getReadTime()
    {
        return ceil(str_word_count($this->intro.' '.$this->content) / 230);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }

    public function scopeLocale($query, $locale)
    {
        return $query->where('locale', $locale);
    }
}
