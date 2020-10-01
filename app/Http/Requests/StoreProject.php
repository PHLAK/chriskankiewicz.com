<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProject extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:10000'],
            'project_url' => ['url', 'max:255'],
            'source_url' => ['url', 'max:255', 'regex:/https?:\/\/(?:www\.)?github\.com\/(.+)\/(.+)\/?/'],
        ];
    }
}
