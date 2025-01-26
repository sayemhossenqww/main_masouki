<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use League\Glide\Server;

trait HasImage
{

    /**
     * Update the item's image.
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @return void
     */
    public function updateImage(UploadedFile $image)
    {
        tap($this->image_path, function ($previous) use ($image) {
            $this->forceFill([
                'image_path' => $image->store(
                    'item-image',
                )
            ])->save();

            // if ($previous) {
            //     Storage::disk('public')->delete($previous);
            // }
        });
    }
    /**
     * Get the URL to the item's image.
     *
     * @return string
     */
    public function getImageUrlOriginalAttribute(): string
    {
        return $this->image_path
            ? URL::to(App::make(Server::class)->fromPath($this->image_path, ['w' => 1000, 'h' => 800, 'fit' => 'crop']))
            : asset('images/webp/placeholder.webp');
    }


    /**
     * Get the URL to the item's image.
     *
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        return $this->image_path
            ? URL::to(App::make(Server::class)->fromPath($this->image_path, ['w' => 550, 'h' => 440, 'fit' => 'crop']))
            : asset('images/webp/placeholder.webp');
    }
    /**
     * Get the URL to the item's image fo POS.
     *
     * @return string
     */
    public function getPosImageUrlAttribute(): string
    {
        return $this->image_path
            ? URL::to(App::make(Server::class)->fromPath($this->image_path, ['w' => 512, 'h' => 512, 'fit' => 'crop']))
            : asset('images/webp/placeholder.webp');
    }
    /**
     * Get the URL to the item's image.
     *
     * @return string
     */
    public function getModalImageUrlAttribute(): string
    {
        return $this->image_path
            ? URL::to(App::make(Server::class)->fromPath($this->image_path, ['w' => 600, 'h' => 600, 'fit' => 'crop']))
            : asset('images/webp/placeholder.webp');
    }

    /**
     * Get the URL to the item's image.
     *
     * @return string
     */
    public function getImageUrlSmAttribute(): string
    {
        return $this->image_path
            ? URL::to(App::make(Server::class)->fromPath($this->image_path, ['w' => 158, 'h' => 158, 'fit' => 'crop']))
            : asset('images/webp/placeholder.webp');
    }
    /**
     * Get the URL to the item's image.
     *
     * @return string
     */
    public function getImageUrlXsmAttribute(): string
    {
        return $this->image_path
            ? URL::to(App::make(Server::class)->fromPath($this->image_path, ['w' => 35, 'h' => 35, 'fit' => 'crop']))
            : asset('images/webp/placeholder.webp');
    }
    /**
     * Delete the item's image.
     *
     * @return void
     */
    public function deleteImage()
    {
        //Storage::disk('public')->delete($this->image_path);

        $this->forceFill([
            'image_path' => null,
        ])->save();
    }


    /**
     * Get the URL to the item's image for the menu.
     *
     * @return string
     */
    public function getMenuImageUrlAttribute(): string
    {
        return $this->image_path
            ? URL::to(App::make(Server::class)->fromPath($this->image_path, ['w' => 158, 'h' => 158, 'fit' => 'crop']))
            : asset('images/webp/placeholder158x158.webp');
    }

    /**
     * Get the URL to the item's image.
     *
     * @return string
     */
    public function getImageUrlV2Attribute(): string
    {
        return $this->image_path
            ? URL::to(App::make(Server::class)->fromPath($this->image_path, ['w' => 528, 'h' => 297, 'fit' => 'crop', 'format' => 'webp']))
            : asset('images/bg.webp');
    }
}
