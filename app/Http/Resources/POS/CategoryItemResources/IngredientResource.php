<?php

namespace App\Http\Resources\POS\CategoryItemResources;

use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
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
            'master_item_id' => $this->master_item_id,
            'master_item_name' => $this->master_item_name,
            'unit' => $this->pos_unit,
            'quantity' => $this->pos_quantity,
        ];
    }
}