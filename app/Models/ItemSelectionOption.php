<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSelectionOption extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'select_option_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function select_option()
    {
        return $this->belongsTo(SelectOption::class);
    }

}
