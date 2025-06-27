<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class CurrentPassword implements Rule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Hash::check($value, auth()->user()->password)) {
            $fail('Password saat ini tidak valid.');
        }
    }

    public function passes($attribute, $value)
    {
        return \Hash::check($value, auth()->user()->password);
    }

    public function message()
    {
        return 'Password saat ini tidak valid.';
    }
}
