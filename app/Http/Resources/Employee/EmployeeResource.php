<?php

namespace App\Http\Resources\Employee;

use App\Constants\Media_Collections;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'name' => $this->name,
            'position' => $this->position,
            'social_media' => $this->social_media,
            'photo' => $this->getFirstMediaUrl(Media_Collections::EMPLOYEE),
            'active' => $this->active
        ];
    }
}
