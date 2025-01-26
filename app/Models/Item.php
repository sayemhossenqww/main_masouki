<?php

namespace App\Models;

use App\Classes\Formatter;
use App\Services\Strings;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasImage;

    const LIMIT = 45;
    const SIMILAR_ITEMS_CACHE_KEY = "similar_items";
    const CACHE_TTL = 60 * 60 * 72;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_path',
        'name',
        'slug',
        'des',
        'price',
        'cost',
        'discount',
        'active',
        'category_id',
        'modifiers',
        'removable_ingredients'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'menu_image_url',
        'image_url',
        'modal_image_url',
        'image_url_sm',
        'image_url_xsm',
        'base_price',
        'view_original_price',
        'view_original_price_usd',
        'view_price',
        'base_price_usd',
        'view_price_usd',
        'has_discount',
        'is_vegan',
        'is_vegetarian',
        'is_gluten_free',
        'is_spicy',
        'is_low_carb',
        'is_sugar_free',
        'is_lactose_free',
        'is_new',
        'preview_des',
        'url',
        'meta_description',
        'meta_keywords',
        'category_name',
        'search_name',
        'status',
    ];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function item_selection_option()
    {
        return $this->hasMany(ItemSelectionOption::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
    /**
     * check if item has discount.
     *
     * @return bool
     */
    public function getHasDiscountAttribute(): bool
    {
        return (bool) $this->discount > 0;
    }

    /**
     * check if item is popular
     *
     * @return bool
     */
    public function getIsPopularAttribute(): bool
    {
        return $this->order_details->count() > 2;
    }


    /**
     * get item base price.
     *
     * @return float
     */
    public function getBasePriceAttribute(): float
    {
        return $this->base_price_usd * Setting::getUsdRate();
    }
    /**
     * get item base price.
     *
     * @return float
     */
    public function getBasePriceUsdAttribute(): float
    {
        $price =  $this->has_discount ?
            $this->price - ($this->discount / 100) * $this->price
            : $this->price;

        return $price;
    }
    /**
     * get item view price.
     *
     * @return string
     */
    public function getViewPriceUsdAttribute(): string
    {
        return usd_money_format($this->base_price_usd);
    }
    /**
     * get item view price.
     *
     * @return string
     */
    public function getViewPriceAttribute(): string
    {
        return brl_money_format($this->base_price);
    }
    /**
     * get item view price.
     *
     * @return string
     */
    public function getViewOriginalPriceUsdAttribute(): string
    {
        return usd_money_format($this->price);
    }
    /**
     * get item view price.
     *
     * @return string
     */
    public function getViewOriginalPriceAttribute(): string
    {
        return brl_money_format($this->price * Setting::getUsdRate());
    }
    /**
     * get item preview description.
     *
     * @return string
     */
    public function getPreviewDesAttribute(): string
    {
        return html_entity_decode(strip_tags(Str::limit($this->des, self::LIMIT)));
    }


    public function getUrlAttribute(): string
    {
        return route('item.show', $this->slug);
    }
    public function getCategoryNameAttribute(): string
    {
        return $this->category->name;
    }
    /**
     * check if item contains any vegan words.
     *
     * @return bool
     */
    public function getIsVeganAttribute(): bool
    {
        // in portuguese language
        $vegan_words = ['vegana', 'vegano'];
        return Str::contains(strtolower($this->name), $vegan_words) ||
            Str::contains(strtolower(strip_tags($this->des)), $vegan_words) ?
            true : false;
    }



    /**
     * check if item contains any gluten free words.
     *
     * @return bool
     */
    public function getIsGlutenFreeAttribute(): bool
    {
        // in portuguese language
        $gluten_free_words = ['Não contém gluten', 'sem glúten'];
        return Str::contains(strtolower($this->name), $gluten_free_words) ||
            Str::contains(strtolower(strip_tags($this->des)), $gluten_free_words) ?
            true : false;
    }

    /**
     * check if item contains any Vegetarian words.
     *
     * @return bool
     */
    public function getIsVegetarianAttribute(): bool
    {
        // in portuguese language
        $vegetarian_words = ['vegetariana', 'vegetariano'];
        return Str::contains(strtolower($this->name), $vegetarian_words) ||
            Str::contains(strtolower(strip_tags($this->des)), $vegetarian_words) ?
            true : false;
    }

    /**
     * check if item contains any Spicy words.
     *
     * @return bool
     */
    public function getIsSpicyAttribute(): bool
    {
        // in portuguese language
        $spicy_words = ['picante'];
        return Str::contains(strtolower($this->name), $spicy_words) ||
            Str::contains(strtolower(strip_tags($this->des)), $spicy_words) ?
            true : false;
    }

    /**
     * check if item contains any low carbs words.
     *
     * @return bool
     */
    public function getIsLowCarbAttribute(): bool
    {
        // in portuguese language
        $low_carb_words = ['low carb'];
        return Str::contains(strtolower($this->name), $low_carb_words) ||
            Str::contains(strtolower(strip_tags($this->des)), $low_carb_words) ?
            true : false;
    }

    /**
     * check if item contains any sugar free words.
     *
     * @return bool
     */
    public function getIsSugarFreeAttribute(): bool
    {
        // in portuguese language
        $sugar_free_words = ['Sem Açúcar'];
        return Str::contains($this->name, $sugar_free_words) ||
            Str::contains(strip_tags($this->des), $sugar_free_words) ?
            true : false;
    }

    /**
     * check if item contains any Lactose free words.
     *
     * @return bool
     */
    public function getIsLactoseFreeAttribute(): bool
    {
        // in portuguese language
        $lactose_free_words = ['sem lactose'];
        return Str::contains(strtolower($this->name), $lactose_free_words) ||
            Str::contains(strtolower(strip_tags($this->des)), $lactose_free_words) ?
            true : false;
    }

    public function getMetaDescriptionAttribute()
    {
        return html_entity_decode(strip_tags(Str::limit($this->des, 160)));
    }
    public function getMetaKeywordsAttribute()
    {
        //return html_entity_decode(strip_tags(Str::limit($this->des, 255)));
        return str_replace(' ', ', ', $this->name);
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
     * get isNew.
     *
     * @return bool
     */
    public function getIsNewAttribute(): bool
    {
        return $this->created_at >= today()->subDays(14);
    }

    /**
     * get cache key.
     *
     * @return string
     */
    public function getCacheKeyAttribute(): string
    {
        return "item-{$this->slug}";
    }


    /**
     * get modifiers.
     *
     * @return string
     */
    public function getModifiersArrayAttribute(): array
    {
        if (is_null($this->modifiers)) return array();

        $assignedto =  explode(',', $this->modifiers);

        foreach ($assignedto as $recipient) {
            $tmp = explode(';', $recipient);
            $recipients[] = (object)array("name" => trim($tmp[0]));
        }

        return  $recipients;
    }
    /**
     * get removable_ingredients.
     *
     * @return string
     */
    public function getRemovableIngredientsArrayAttribute(): array
    {
        if (is_null($this->removable_ingredients)) return array();

        $assignedto =  explode(',', $this->removable_ingredients);

        foreach ($assignedto as $recipient) {
            $tmp = explode(';', $recipient);
            $recipients[] = (object)array("name" => trim($tmp[0]));
        }

        return  $recipients;
    }
    
    /**
     * get search name.
     *
     * @return string
     */
    public function getSearchNameAttribute(): string
    {
        $slug = Str::slug($this->name, ' ');
        $searchName = "{$this->name} {$slug} {$this->category->name}";

        if ($this->is_vegan) {
            $searchName = "{$searchName} vegana vegano";
        }

        if ($this->is_vegetarian) {
            $searchName = " vegetariana vegetariano";
        }

        if ($this->is_gluten_free) {
            $searchName = "{$searchName} Não contém gluten sem glúten";
        }

        if ($this->is_spicy) {
            $searchName = "{$searchName} picante";
        }

        if ($this->is_low_carb) {
            $searchName = "{$searchName} low carb";
        }

        if ($this->is_sugar_free) {
            $searchName = "{$searchName} Sem Açúcar";
        }

        if ($this->is_lactose_free) {
            $searchName = "{$searchName} sem lactose";
        }

        if ($this->has_discount) {
            $searchName = "{$searchName} Discount";
        }
        if ($this->is_new) {
            $searchName = "{$searchName} New";
        }
        if ($this->is_popular) {
            $searchName = "{$searchName} popular";
        }

        return $searchName;
    }
}
