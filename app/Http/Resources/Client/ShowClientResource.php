<?php

namespace App\Http\Resources\Client;

use App\Constants\Media_Collections;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowClientResource extends JsonResource
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
            'name' => $this->attributes('name')->data['name'],
            'link' => $this->link,
            'photo' => $this->getFirstMediaUrl(Media_Collections::CLIENT),
            'active' => $this->active,
            'created_at' => $this->created_at,
        ];
    }
}
