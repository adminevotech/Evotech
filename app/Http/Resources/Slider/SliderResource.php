<?php

namespace App\Http\Resources\Slider;

use App\Constants\Media_Collections;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

class SliderResource extends JsonResource
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
            'button' => $this->button,
            'sub_title' => $this->sub_title,
            'photo' => $this->getFirstMediaUrl(Media_Collections::SLIDER),
        ];
    }
}
