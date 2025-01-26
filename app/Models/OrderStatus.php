<?php

namespace App\Models;

use App\Services\Strings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    const PENDING = 1;
    const DELIVERED = 2;
    const CANCELLED = 3;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'full_status'
    ];

    public static $statuses = [
        self::PENDING => Strings::PENDING,
        self::DELIVERED => Strings::DELIVERED,
        self::CANCELLED => Strings::CANCELLED
    ];

    public static $icons = [
        self::PENDING => '<span class="material-symbols-rounded">timer</span>',
        self::DELIVERED => '<span class="material-symbols-rounded">task_alt</span>',
        self::CANCELLED => '<span class="material-symbols-rounded">cancel</span>'
    ];

    public static $colors = [
        self::PENDING => 'bg-warning',
        self::DELIVERED => 'bg-success',
        self::CANCELLED => 'bg-danger'
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function getIconAttribute($attr)
    {
        return self::$icons[$this->id];
    }
    public function getFullStatusAttribute()
    {
        return '<span class="badge rounded-pill ' . self::$colors[$this->id] . '">' . self::$icons[$this->id] . ' ' . self::$statuses[$this->id] . '</span>';
    }
}
