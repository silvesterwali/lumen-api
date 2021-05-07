<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Custom validation for match given password with current auth password
 *
 */
class PasswordMatchRole implements Rule
{

    /**
     * Determine if the validation rule passed
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Hash::check($value, Auth::user()->password);
    }

    /**
     * Get the validation error
     * @return string
     */
    public function message()
    {
        return 'The :attribute is match with old password.';
    }
}
