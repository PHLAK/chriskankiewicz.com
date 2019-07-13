<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExperience extends FormRequest
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
            'company' => ['string', 'max:255'],
            'title' => ['string', 'max:255'],
            'description' => ['string'],
            'start_date' => ['date'],
            'end_date' => ['required_if:current_position,false', 'date', 'after:start_date'],
            'current_position' => ['boolean'],
            'location' => ['string', 'max:255'],
        ];
    }
}
