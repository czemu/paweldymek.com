<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use \Spatie\Tags\HasTags;

class Post extends Model implements HasMedia
{
    use HasMediaTrait;
    use HasTags;

    protected $guarded = ['id'];

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

    public static function getTagClassName(): string
    {
        return \App\Models\Tag::class;
    }

    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
            ->orderBy('order_column');
    }

    public function getUrl()
    {
        return route('posts.show', ['slug' => $this->slug]);
    }

    public function getReadTime()
    {
        return ceil(str_word_count($this->intro.' '.$this->content) / 230);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }
}
