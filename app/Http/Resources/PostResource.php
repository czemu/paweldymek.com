<?php

namespace App\Http\Resources;

use Spatie\Image\Image;
use App\Http\Resources\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $showFullDetails = in_array($request->route()->getActionMethod(), ['show', 'showBySlug']);

        $array = parent::makeHidden(['pivot', 'content', 'is_published'])->toArray($request);

        $array += [
            'content' => $this->when($showFullDetails, parsedown($this->content)),
            'tags' => TagResource::collection($this->tags),
            'read_time' => $this->getReadTime(),
            'image' => null
        ];

        $image = $this->getFirstMedia('image');

        if ( ! is_null($image))
        {
            $array['image'] = [
                'url' => $image->getUrl('large'),
                'alt' => $image->hasCustomProperty('alt') ? $image->getCustomProperty('alt') : null,
                'description' => $image->hasCustomProperty('description') ? $image->getCustomProperty('description') : null,
                'width' => Image::load($image->getPath())->getWidth(),
                'height' => Image::load($image->getPath())->getHeight()
            ];
        }

        return $array;
    }
}
