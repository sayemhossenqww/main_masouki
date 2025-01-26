<?php

namespace App\Http\Controllers\Admin\Item;

use App\Http\Controllers\Controller;
use App\Models\ItemSelectionOption;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemServiceController extends Controller
{

    public function store(Request $request, Item $item)
    {
        $request->validate([
            'service' => ['required'],
        ]);

        $select_option = ItemSelectionOption::create([
            "item_id" => $item->id,
            "select_option_id"=> $request->service
        ]);
        $i = Item::with('item_selection_option.select_option')->where('id', $item->id)->get();
        return $this->jsonResponse(['data' =>  $i[0]->item_selection_option]);
    }
    public function destroy(Item $item, ItemSelectionOption $service)
    {
        $service->delete();
        $i = Item::with('item_selection_option.select_option')->where('id', $item->id)->get();
        return $this->jsonResponse(['data' => $i[0]->item_selection_option]);
    }
}
