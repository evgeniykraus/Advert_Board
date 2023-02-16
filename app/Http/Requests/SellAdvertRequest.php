<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellAdvertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => ['required', 'integer', 'exists:adverts,id'],
            'sold' => ['required', 'integer', 'min:1', 'max:1'],
        ];
    }
}
