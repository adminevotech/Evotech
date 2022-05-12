<?php

namespace App\Http\Resources\Service;
use App\Constants\Media_Collections;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'sub_title' => $this->sub_title,
            'cover' => $this->getFirstMediaUrl(Media_Collections::SERVICE_COVER),
            'photo' => $this->getFirstMediaUrl(Media_Collections::SERVICE_PHOTO),
            'active' => $this->active,
            'created_at' => $this->created_at,
        ];
    }
}
