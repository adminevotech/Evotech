<?php

namespace App\Http\Resources\Portfolio;

use App\Constants\Media_Collections;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
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
            'service_id' => $this->service_id,
            'name' => $this->name,
            'link' => $this->link,
            'photo' => $this->getFirstMediaUrl(Media_Collections::PORTFOLIO),
            'active' => $this->active
        ];
    }
}
