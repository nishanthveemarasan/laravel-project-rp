<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:products,name'],
            'price' => ['required', 'numeric'],
            'offerPrice' => ['nullable', 'numeric'],
            'product_image' => ['required', 'image'],
            'color' => ['required', 'array'],
            'height' => ['required', 'array'],
            'description' => ['required', 'string'],
        ];
    }
}
