<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UniquePhoneNumber implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $phone = substr(preg_replace("/[^a-zA-Z0-9\s]/", '', $value), 1);

        $numberAlreadyExists = User::where('phone', 'LIKE', '%' . $phone)->first();

        return is_null($numberAlreadyExists);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Такое значение поля телефон уже существует.';
    }
}
