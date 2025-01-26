<?php

namespace App\Http\Resources\KioskResources;

use Illuminate\Http\Resources\Json\JsonResource;

class KioskItemResource extends JsonResource
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
            'des' => $this->des,
            'price_lbp' => $this->base_price,
            'price_usd' => $this->base_price_usd,
            'image_url' => $this->pos_image_url,
            'modifiers' => $this->modifiers_array,
            'removable_ingredients' => $this->removable_ingredients_array,
        ];
    }
}
