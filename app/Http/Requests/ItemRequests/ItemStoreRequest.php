<?php

namespace App\Http\Requests\ItemRequests;

use Illuminate\Foundation\Http\FormRequest;

class ItemStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100', 'unique:items'],
            'des' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'cost' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'between:0,100'],
            // 'image' => ['nullable', 'max:2024'],
            'category' => ['required', 'integer'],
            'modifiers' => ['nullable', 'string'],
            'removable_ingredients' => ['nullable', 'string'],
        ];
    }
}
