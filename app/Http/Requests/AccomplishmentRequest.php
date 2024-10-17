<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccomplishmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->is_admin;
    }

    /** @return array<string, array<mixed>> */
    public function rules(): array
    {
        return [
            'description' => ['string', Rule::when($this->method() === 'POST', 'required')],
        ];
    }
}
