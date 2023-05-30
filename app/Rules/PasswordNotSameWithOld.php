<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordNotSameWithOld implements ValidationRule, DataAwareRule
{
    protected $data = [];

    public function setData(array $data): static
    {
        $this->data = $data;
 
        return $this;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $userPassword = User::select('password')->where('email', $this->data['email'])->first();
        // Hash::check();
        if (! Hash::check($this->data['password'], $userPassword)) {
            $fail = 'The :attribute must be different from the old one.';
        }
    }
}
