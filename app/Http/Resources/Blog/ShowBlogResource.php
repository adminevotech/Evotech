<?php

namespace App\Http\Resources\Blog;

use App\Constants\Media_Collections;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowBlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->attributes('title')->data['title'],
            'description' => $this->attributes('description')->data['description'],
            'cover' => $this->getFirstMediaUrl(Media_Collections::BLOG_COVER),
            'photo' => $this->getFirstMediaUrl(Media_Collections::BLOG_PHOTO),
            'active' => $this->active,
            'created_at' => $this->created_at,
        ];
    }
}
