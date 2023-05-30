<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotSame implements ValidationRule
{
    protected $_comparison;
    protected $_field;

    public function __construct($comparison, $field)
    {
        $this->_comparison = $comparison;
        $this->_field = $field;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value == $this->_comparison) {
            $fail("The :attribute must be different from " . $this->_field);
        }
    }
}
