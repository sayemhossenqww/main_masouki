<?php

namespace App\Models;

use App\Services\Strings;
use App\Traits\CategoryImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CategoryImage;

    const CACHE_KEY = "category_items";
    const CACHE_KEY_V2 = "categories_v2";
    const CACHE_KEY_2_V2 = "category_v2";
    const CACHE_TTL = 60 * 60 * 72;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'active',
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'status',
        'image_url',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
    public function items()
    {
        return $this->hasMany(Item::class);
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

    /**
     * get url.
     *
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route('category.items.show', $this->slug);
    }
}
