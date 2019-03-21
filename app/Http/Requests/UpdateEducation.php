<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEducation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // TODO: Authorize this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'institution' => ['string', 'max:255'],
            'degree' => ['string', 'max:255'],
            'start_date' => ['date'],
            'end_date' => ['required_if:currently_enrolled,false', 'date', 'after:start_date'],
            'currently_enrolled' => ['boolean'],
        ];
    }
}
