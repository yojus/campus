<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject_id' => 'required|exists:subjects,id',
            'school' => 'required|string|max:50',
            'money' => 'required|string|max:10',
            'area' => 'required|string|max:50',
        ];
    }
}
