<?php

namespace App\Http\Resources\POS\CategoryItemResources;

use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'price' => $this->base_price,
            'cost' => ($this->cost ?? 0) * Setting::getUsdRate(),
            'image_url' => $this->pos_image_url,
            'barcode' => "",
            'sku' => "",
            // 'ingredients' => new IngredientResourceCollection($this->ingredients),
            // 'ingredients' => [],
            'services' => new ServiceResourceCollection($this->item_selection_option)
        ];
    }
}
