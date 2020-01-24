<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Post extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($post) {
            $post->tags()->detach();
        });
   }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('image')->singleFile();
    }

    public function registerMediaConversions(Media $media = null)
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
        return url($this->locale.'/post/'.$this->slug);
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
