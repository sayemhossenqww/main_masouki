<?php

namespace App\Http\Requests\ItemRequests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100', 'unique:items,name,' . $this->item->id],
            'slug' => ['required', 'alpha_dash', 'max:150', 'unique:items,slug,' . $this->item->id],
            'des' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'cost' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'between:0,99.99'],
            'category' => ['required', 'integer'],
            'modifiers' => ['nullable', 'string'],
            'removable_ingredients' => ['nullable', 'string'],
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'slug.unique' => 'This link is used for another item.',
        ];
    }
}
