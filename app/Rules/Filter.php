<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{


    protected $not_allowed_words  = ['php','laravel','js','God','html','css'];


    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // if(!($value == array_map(null,$this->not_allowed_words))){
        //     $fail('The '. $value.' is forbidden please Change it !');
        // }

    }

}