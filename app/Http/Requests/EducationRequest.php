<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->is_admin;
    }

    /** @return array<string, array<mixed>> */
    public function rules(): array
    {
        return [
            'institution' => ['string', 'max:255', Rule::when($this->method() === 'POST', 'required')],
            'degree' => ['string', 'max:255', Rule::when($this->method() === 'POST', 'required')],
            'start_date' => ['date', Rule::when($this->method() === 'POST', 'required')],
            'end_date' => ['date', 'after:start_date'],
        ];
    }
}
