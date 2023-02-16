<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => ['required', 'exists:users,id'],
            'admin' => ['required', 'integer', 'min:0', 'max:1'],
            'name' => ['required', 'string', 'min:2', 'max:64'],
            'surname' => ['required', 'string', 'min:2', 'max:64'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users,email,' . $this->input('id')],
            'phone' => ['required', new PhoneNumber(), 'unique:users,phone,' . $this->input('id')],
            'password' => ['nullable', 'string', 'min:6', 'max:255', 'regex:/^[0-9A-Za-z]+$/'],
        ];
    }
}
