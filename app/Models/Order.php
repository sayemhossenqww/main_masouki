<?php

namespace App\Models;

use App\Services\Strings;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'display_date',
        'display_date_created_at',
        'type',
        'display_total',
        'display_subtotal',
        'display_delivery_fee',
        'display_discount',
        'date_year_month',
    ];

    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class)->withTrashed();
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class);
    }
    public function order_source()
    {
        return $this->belongsTo(OrderSource::class);
    }
    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($order) {
            $order->order_detail->each->delete();
        });
    }

    public function getDisplayDateAttribute()
    {
        return $this->created_at->isToday() ?
            Carbon::parse($this->created_at)->diffForHumans()
            : Carbon::parse($this->created_at)->format(config('app.default_datetime_format'));
    }

    public function getDisplayDateCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format(config('app.default_datetime_format'));
    }
    public function getDisplayDateCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->formatLocalized('%d %B, %Y');;
    }
    public function getDisplayTimeCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('H:i');;
    }
    public function getTypeAttribute()
    {
        return $this->is_delivery ? Strings::DELIVERY : Strings::PICKUP;
    }
    public function getDateYearMonthAttribute(): string
    {
        return Carbon::parse($this->created_at)->format('M-Y');
    }
    public function getDisplaySubtotalAttribute(): string
    {
        return brl_money_format($this->subtotal);
    }
    public function getDisplayDeliveryFeeAttribute(): string
    {
        return brl_money_format($this->delivery_fee);
    }
    public function getDisplayTotalAttribute(): string
    {
        return brl_money_format($this->total);
    }

    public function getOrderDetailsTotalAttribute(): float
    {
        return $this->order_detail->sum(function ($query) {
            return $query->subtotal * $query->qty;
        });
    }
    public function getDisplayDiscountAttribute(): string
    {
        return "-" . brl_money_format($this->discount);
    }
    public function getDisplayOrderDetailsTotalAttribute(): string
    {
        return brl_money_format($this->order_details_total);
    }
}
