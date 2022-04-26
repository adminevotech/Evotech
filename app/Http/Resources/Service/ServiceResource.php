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
            'points' => $this->points,
            'photo' => $this->getFirstMediaUrl(Media_Collections::SERVICES),
            'active' => $this->active,
            'created_at' => $this->created_at,
        ];
    }
}
