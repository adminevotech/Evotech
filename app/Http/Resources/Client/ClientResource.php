<?php

namespace App\Http\Resources\Client;

use App\Constants\Media_Collections;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'client_category_id' => $this->client_category_id,
            'name' => $this->name,
            'photo' => $this->getFirstMediaUrl(Media_Collections::CLIENT),
            'active' => $this->active,
            'created_at' => $this->created_at,
        ];
    }
}
