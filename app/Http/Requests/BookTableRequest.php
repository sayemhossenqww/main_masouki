<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookTableRequest extends FormRequest
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
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'phone' => ['required', 'max:100'],
            'day' => ['required', 'max:2', 'string'],
            'month' => ['required', 'max:50', 'string'],
            'year' => ['required', 'max:4', 'string'],
            'number_of_people' => ['required', 'min:1', 'max:100', 'integer'],
            'message' => ['nullable', 'max:190', 'string'],
        ];
    }
}
