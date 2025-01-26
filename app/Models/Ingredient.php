<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsTo(Item::class);
    }


    public function getPosQuantityAttribute(): float
    {
        if ($this->unit == "G") {
            return $this->quantity / 1000;
        } elseif ($this->unit == "ML") {
            return $this->quantity / 1000;
        }
        return $this->quantity;
    }
}
