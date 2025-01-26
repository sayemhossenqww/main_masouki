<?php

namespace App\Http\Resources\ServiceResources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category_name' => $this->category_name,
            'price' => $this->price,
            'cost' => $this->cost,
            'description' => $this->description
        ];
    }
}
