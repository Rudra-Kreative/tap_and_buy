<?php

namespace App\Rules\Admin;

use Illuminate\Contracts\Validation\Rule;

class TimezoneSelect implements Rule
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
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return array_search($value,timezone_identifiers_list());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Selected timezone is invalid.';
    }
}
