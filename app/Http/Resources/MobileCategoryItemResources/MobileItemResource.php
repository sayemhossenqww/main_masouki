<?php

namespace App\Http\Resources\MobileCategoryItemResources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use League\Glide\Server;

class MobileItemResource extends JsonResource
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
            'slug' => $this->slug,
            'name' => $this->name,
            'search_name' => $this->search_name,
            'image_url' => $this->mobile_image_url,
            'image_url' => $this->image_path
                ? URL::to(App::make(Server::class)->fromPath($this->image_path, ['w' => 1000, 'h' => 1000, 'fit' => 'crop-center']))
                : asset('images/webp/placeholder.webp'),
            'thumbnail_url' => $this->image_path
                ? URL::to(App::make(Server::class)->fromPath($this->image_path, ['w' => 500, 'h' => 500, 'fit' => 'crop-center']))
                : asset('images/webp/placeholder.webp'),
            'price' => $this->base_price_usd,
            'has_discount' => $this->has_discount,
            'description' => $this->des,
            'is_popular' => $this->is_popular,
            'is_new' => $this->is_new,
            'has_discount' => $this->has_discount,
            'url' => $this->url,
            'category_name' => $this->category_name,
            'category_slug' => $this->category->slug,
        ];
    }
}
