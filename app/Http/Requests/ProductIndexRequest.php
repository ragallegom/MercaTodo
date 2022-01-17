<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'searchName' => 'max:50|alpha_num|nullable',
            'searchDescription' => 'max:255|alpha_num|nullable',
            'searchRangeMin' => 'min:0|integer',
            'searchRangeMax' => 'max:1000000|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'searchName.max' => 'El :attribute es obligatorio.',
            'searchDescription.max' => 'Añade un :attribute al producto',
        ];
    }
}
