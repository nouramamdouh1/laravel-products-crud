<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateproductrequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required','string','max:255',
            'description' => 'required',
            'price' => 'required',
            'brands_id' => 'required','exists:brands,id',
            'image' => ['required','max:1000','mimes:jpg,jpeg,png']
        ];
    }
}
