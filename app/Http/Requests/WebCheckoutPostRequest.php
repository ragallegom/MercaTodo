<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class WebCheckoutPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:120',
            'surname' => 'required|max:120',
            'document' => 'required|integer|gt:999',
            'documentType' => 'required|in:CC,CE,TI,NIT,RUT',
            'company' => 'required|max:120',
            'email' => 'required|email|max:250',
            'mobile' => 'required|integer|digits:10',
            'address' => 'required|max:250',
            'totalValue' => 'required|integer|min:1'
        ];
    }
}
