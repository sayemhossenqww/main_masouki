<?php

namespace App\Models;

use App\Classes\Formatter;

class Cart
{
    public $items = null;
    public $qty = 0;
    public $total = 0;


    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->qty = $oldCart->qty;
            $this->total = $oldCart->total;
        }
    }

    public function add($item, $id, $qty2)
    {
        $storedItem = [
            'qty' => 0,
            'price' => $item->base_price,
            'view_price' => $this->viewPrice($item->base_price),
            'item' => $item
        ];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty'] += $qty2;
        $price = $item->base_price * $storedItem['qty'];
        $storedItem['price'] = $price;
        $storedItem['view_price'] = $this->viewPrice($price);
        $this->items[$id] = $storedItem;
        $this->qty += $qty2;
        $this->total += $item->base_price * $qty2;
        if ($storedItem['qty'] == 0) {
            $this->remove($id);
        }
    }

    public function remove($id)
    {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $this->qty -= $this->items[$id]['qty'];
                $this->total -=  $this->items[$id]['price'];
                unset($this->items[$id]);
            }
        }
    }


    public function viewPrice($price): string
    {
        return brl_money_format($price);
    }
}
