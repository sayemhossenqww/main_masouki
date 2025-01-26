<?php

namespace App\Models;

use App\Services\Strings;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    public const CLOSED_MESSAGE = "Our deliveries at the moment are not active. The delivery time will be arranged with you by whatsapp or phone, to clarify doubts and confirm your data.";

    protected $fillable = [
        'value',
    ];


    public const STORE_STATUS = 1;
    public const GLOBAL_ALERT = 2;
    public const ABOUT = 3;
    public const USD_RATE = 4;


    public static $settings = [
        self::STORE_STATUS => Strings::STORE_STATUS,
        self::GLOBAL_ALERT => Strings::GLOBAL_ALERT,
        self::ABOUT => Strings::ABOUT,
        self::USD_RATE => Strings::USD_RATE,
    ];

    public static $settings_value = [
        self::STORE_STATUS => Strings::CLOSED,
        self::GLOBAL_ALERT => null,
        self::ABOUT => "ABOUT US",
        self::USD_RATE => 0.0,
    ];

    public static function getUsdRate(): float
    {
        return Setting::find(self::USD_RATE)->value ?? 0;
    }
}
