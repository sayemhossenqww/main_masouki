<?php

namespace App\Models;

use App\Services\Strings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use League\Glide\Server;

class Banner extends Model
{
    use HasFactory;

    public const CACHE_KEY = "banners";
    const CACHE_TTL = 60 * 60 * 72;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_path',
        'sort_order',
        'link',
        'active'
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'image_url',
        'status',
    ];
    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
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
                    'banner-image',
                )
            ])->save();

            if ($previous) {
                Storage::disk('public')->delete($previous);
            }
        });
    }


    /**
     * Get the URL to the item's image.
     *
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        return URL::to(App::make(Server::class)->fromPath($this->image_path, ['w' => 1140, 'h' => 380, 'fit' => 'crop']));
    }

    /**
     * get status.
     *
     * @return string
     */
    public function getStatusAttribute(): string
    {
        return $this->active ? Strings::ACTIVE : Strings::INACTIVE;
    }
}