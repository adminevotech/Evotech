<?php

namespace App\Http\Resources\StaticContent;

use Illuminate\Http\Resources\Json\JsonResource;

class StaticContentResource extends JsonResource
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
            "id" => $this->id,
            "group" => $this->group,
            "key" => $this->key,
            "text" => $this->text,
        ];
    }
}
