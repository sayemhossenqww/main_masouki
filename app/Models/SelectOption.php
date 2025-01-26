<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SelectOption extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category_name',
        'price',
        'cost',
        'description'
    ];

    // protected $appends = [
    //     'base_price',
    //     'view_price',
    //     'base_price_usd',
    //     'view_price_usd',
    //     'base_cost',
    //     'view_cost',
    //     'base_cost_usd',
    //     'view_cost_usd'
    // ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
    
    // /**
    //  * get item base price.
    //  *
    //  * @return float
    //  */
    // public function getBasePriceAttribute(): float
    // {
    //     return $this->base_price_usd * Setting::getUsdRate();
    // }
    // /**
    //  * get item base price.
    //  *
    //  * @return float
    //  */
    // public function getBasePriceUsdAttribute(): float
    // {
    //     $price =  $this->price;
    //     return $price;
    // }
    // /**
    //  * get item view price.
    //  *
    //  * @return string
    //  */
    // public function getViewPriceUsdAttribute(): string
    // {
    //     return usd_money_format($this->base_price_usd);
    // }
    // /**
    //  * get item view price.
    //  *
    //  * @return string
    //  */
    // public function getViewPriceAttribute(): string
    // {
    //     return brl_money_format($this->base_price);
    // }
    // /**
    //  * get item base cost.
    //  *
    //  * @return float
    //  */
    // public function getBaseCostAttribute(): float
    // {
    //     return $this->base_cost_usd * Setting::getUsdRate();
    // }
    // /**
    //  * get item base cost.
    //  *
    //  * @return float
    //  */
    // public function getBaseCostUsdAttribute(): float
    // {
    //     $cost =  $this->cost;

    //     return $cost;
    // }
    // /**
    //  * get item view cost.
    //  *
    //  * @return string
    //  */
    // public function getViewCostUsdAttribute(): string
    // {
    //     return usd_money_format($this->base_cost_usd);
    // }
    // /**
    //  * get item view cost.
    //  *
    //  * @return string
    //  */
    // public function getViewCostAttribute(): string
    // {
    //     return brl_money_format($this->base_cost);
    // }
}
