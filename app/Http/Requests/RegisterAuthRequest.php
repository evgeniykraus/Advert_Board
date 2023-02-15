<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumber;
use App\Rules\UniquePhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class RegisterAuthRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:64'],
            'surname' => ['required', 'string', 'min:2', 'max:64'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'phone' => ['required', 'unique:users', new PhoneNumber(), new UniquePhoneNumber()],
            'password' => ['required', 'string', 'min:6', 'max:255', 'confirmed'],
            'password_confirmation' => ['required', 'min:6', 'max:255'],
        ];
    }
}
