<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'slug' => ['string', 'max:255', Rule::when($this->method() === 'POST', 'required')],
            'title' => ['string', 'max:255', Rule::when($this->method() === 'POST', 'required')],
            'body' => ['string', 'max:10000', Rule::when($this->method() === 'POST', 'required')],
            'featured_image_url' => ['url', 'max:2048'],
            'featured_image_text' => ['string', 'max:255'],
            'published_at' => ['date', Rule::when($this->method() === 'POST', 'required')],
        ];
    }
}
