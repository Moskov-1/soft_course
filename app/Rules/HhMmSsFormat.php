<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HhMmSsFormat implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Quick reject if not a string like "00:00:00"
        if (!preg_match('/^(?<h>\d{1,2}):(?<m>\d{2}):(?<s>\d{2})$/', $value, $matches)) {
            $fail('The :attribute must be in hh:mm:ss format.');
            return;
        }

        $hours = (int) $matches['h'];
        $minutes = (int) $matches['m'];
        $seconds = (int) $matches['s'];

        if ($minutes > 59 || $seconds > 59) {
            $fail('The :attribute must have minutes and seconds between 00 and 59.');
        }
    }
}
