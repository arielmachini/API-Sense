<?php

namespace App\Http\Requests;

use App\Rules\ValidOAS;
use Illuminate\Foundation\Http\FormRequest;

class UploadOASRequest extends FormRequest {
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'OAS' => [
                'required',
                'max:2048',
                new ValidOAS
            ]
        ];
    }
}
