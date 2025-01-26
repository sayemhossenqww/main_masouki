<?php

namespace App\Http\Resources\POS\CategoryItemResources;

use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'item_id' => $this->item_id,
            'select_option_id' => isset($this->select_option) && isset($this->select_option->id) ? $this->select_option->id : "",
            'category_name' => isset($this->select_option) ? $this->select_option->category_name : "",
            'cost' => isset($this->select_option) ? ($this->select_option->cost) * Setting::getUsdRate() : 0,
            'price' => isset($this->select_option) ? ($this->select_option->price) * Setting::getUsdRate() : 0,
            'name' => isset($this->select_option) ? $this->select_option->name : "",
            'description' => isset($this->select_option) ? $this->select_option->description : "",
            'is_selected' => false
        ];
    }
}
