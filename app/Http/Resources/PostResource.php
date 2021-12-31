<?php

namespace App\Http\Resources;

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

        $array = parent::makeHidden(['pivot', 'content', 'is_published', 'updated_at'])->toArray($request);

        $array += [
            'content' => $this->when($showFullDetails, parsedown($this->content)),
            'tags' => TagResource::collection($this->tags),
            'image_url' => $this->hasMedia('image') ? $this->getFirstMediaUrl('image', 'large') : null,
            'read_time' => $this->getReadTime()
        ];

        return $array;
    }
}
