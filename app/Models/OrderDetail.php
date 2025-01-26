<?php

namespace App\Models;

use App\Classes\Formatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'display_subtotal',
        'display_total',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id')->withTrashed();
    }

    public function getDisplaySubtotalAttribute(): string
    {
        return brl_money_format($this->subtotal);
    }
    public function getDisplayTotalAttribute(): string
    {
        return brl_money_format($this->subtotal * $this->qty);
    }
}
