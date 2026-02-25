<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use cebe\openapi\Reader;

class ValidOAS implements ValidationRule {
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        $uploadedOAS = match ($value->getClientOriginalExtension()) {
            'json' => Reader::readFromJsonFile($value),
            'yaml', 'yml' => Reader::readFromYamlFile($value),
            default => null
        };

        if ($uploadedOAS === null) {
            $fail('Unsupported file extension (' . $value->extension() . ').');

            return; // No need to check if the uploaded file is a valid OpenAPI specification since its extension is unsupported.
        }

        if (!$uploadedOAS->validate()) {
            $fail('The uploaded OAS is not valid.');
        }
    }
}
