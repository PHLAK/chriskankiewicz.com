<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'company' => ['string', 'max:255', Rule::when($this->method() === 'POST', 'required')],
            'title' => ['string', 'max:255', Rule::when($this->method() === 'POST', 'required')],
            'description' => ['string', Rule::when($this->method() === 'POST', 'required')],
            'start_date' => ['date', Rule::when($this->method() === 'POST', 'required')],
            'end_date' => ['date', 'after:start_date'],
            'location' => ['string', 'max:255', Rule::when($this->method() === 'POST', 'required')],
        ];
    }
}
