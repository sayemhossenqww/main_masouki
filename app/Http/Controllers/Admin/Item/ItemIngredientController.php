<?php

namespace App\Http\Controllers\Admin\Item;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemIngredientController extends Controller
{

    public function store(Request $request, Item $item)
    {
        $request->validate([
            'ingredient' => ['required'],
            'unit' => ['required'],
            'quantity' => ['required']
        ]);

        $ingredient = new Ingredient();
        $ingredient->master_item_id = $request->ingredient;
        $ingredient->master_item_name = $request->ingredient_name;
        $ingredient->unit = $request->unit;
        $ingredient->quantity = $request->quantity;
        $ingredient->item_id = $item->id;
        $ingredient->save();

        return $this->jsonResponse(['data' => $item->load('ingredients')]);
    }
    public function destroy(Item $item, Ingredient $ingredient)
    {
        $ingredient->delete();
        return $this->jsonResponse(['data' => $item->load('ingredients')]);
    }
}
