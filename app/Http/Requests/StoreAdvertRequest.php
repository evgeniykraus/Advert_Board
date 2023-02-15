<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvertRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['required', 'string', 'min:2', 'max:4000'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'creator_id' => ['required', 'integer', 'exists:users,id'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999.99'],
        ];
    }
}
