<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'filters' => ['filled', 'array'],
            'filters.email' => ['email'],
            'filters.name' => ['string', 'max:120'],
        ];
    }
}
