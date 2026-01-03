<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidOAS implements ValidationRule {
    private array $uploadedOAS;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        $isValid = true;

        $uploadedOAS = $this->convertToJSON($value);

        $isValid = $this->checkOASValidity();

        if (!$isValid) {
            $fail('The uploaded OAS is not valid.');
        }
    }

    private function convertToJSON($filename) {
        $json = json_decode(file_get_contents($filename), true);
        
        return $json;
    }

    private function checkRequiredFields() {
        $requiredFields = ['openapi', 'info', 'paths'];

        foreach ($requiredFields as $field) {
            if (!isset($this->uploadedOAS[$field])) {
                return false;
            }
        }

        return true;
    }

    private function checkOASValidity() {
        if (!empty($this->uploadedOAS) && !preg_match('/^3\.[0-1]\.\d+(-rc\d)?$/i', $this->uploadedOAS)) {
            return false;
        }

        // ToDo: Check for required fields in the OAS according to the version of the specification.
    }
}
