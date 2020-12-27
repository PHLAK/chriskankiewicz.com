<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => ['string', 'max:255'],
            'title' => ['string', 'max:255'],
            'body' => ['string', 'max:10000'],
            'featured_image_url' => ['url', 'max:2048'],
            'featured_image_text' => ['string', 'max:255'],
            'published_at' => ['date'],
        ];
    }
}
