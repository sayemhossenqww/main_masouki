<?php

namespace App\Http\Resources\MobileCategoryItemResources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use League\Glide\Server;

class MobileCategoryItemResource extends JsonResource
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
            'url' => $this->url,
            'image_url' => $this->image_path
                ? URL::to(App::make(Server::class)->fromPath($this->image_path, ['w' => 500, 'h' => 500, 'fit' => 'crop-center']))
                : asset('images/webp/placeholder.webp'),
            'sort_order' => $this->sort_order,
            'items' => new MobileItemResourceCollection($this->items)
        ];
    }
}
