<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255', Rule::when($this->method() === 'POST', 'required')],
            'icon_name' => ['string', 'max:255'],
            'icon_style' => ['string', 'max:255'],
        ];
    }
}
