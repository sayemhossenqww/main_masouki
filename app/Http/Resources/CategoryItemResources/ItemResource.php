<?php

namespace App\Http\Resources\CategoryItemResources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'name' => $this->name,
            'search_name' => $this->search_name,
            'slug' => $this->slug,
            'image_url_original' => $this->image_url_original,
            'image_url' => $this->image_url,
            'modal_image_url' => $this->modal_image_url,
            'menu_image_url' => $this->menu_image_url,
            'image_url_sm' => $this->image_url_sm,
            'image_url_xsm' => $this->image_url_xsm,
            'base_price' => $this->base_price,
            'view_original_price' => $this->view_original_price,
            'view_price' => $this->view_price,

            'base_price_usd' => $this->base_price_usd,
            'view_original_price_usd' => $this->view_original_price_usd,
            'view_price_usd' => $this->view_price_usd,
            'has_discount' => $this->has_discount,
            'is_vegan' => $this->is_vegan,
            'is_vegetarian' => $this->is_vegetarian,
            'is_gluten_free' => $this->is_gluten_free,
            'is_spicy' => $this->is_spicy,
            'is_new' => $this->is_new,
            'des' => $this->des,
            'preview_des' => $this->preview_des,
            'is_popular' => $this->is_popular,
            'url' => $this->url,
            'category_name' => $this->category_name,
        ];
    }
}
