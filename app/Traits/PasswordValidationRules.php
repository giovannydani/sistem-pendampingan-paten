<?php
namespace App\Traits;

use Illuminate\Validation\Rules\Password;

/**
 * Password Validation Rules
 */
trait PasswordValidationRules
{
    
    protected function passwordRules()
    {
        // return ['required', 'string', Password::min(8)->uncompromised(), 'confirmed'];
        return ['required', 'string', Password::min(8), 'confirmed'];
    }
}

?>