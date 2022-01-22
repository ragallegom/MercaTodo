<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'description' => 'max:255',
            'price' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
