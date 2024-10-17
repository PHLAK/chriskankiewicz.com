<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->is_admin;
    }

    /** @return array<string, array<mixed>> */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255', Rule::when($this->method() === 'POST', 'required')],
            'description' => ['string', 'max:10000'],
            'project_url' => ['url', 'max:255'],
            'source_url' => ['url', 'max:255', 'regex:/https?:\/\/(?:www\.)?github\.com\/(.+)\/(.+)\/?/'],
        ];
    }
}
