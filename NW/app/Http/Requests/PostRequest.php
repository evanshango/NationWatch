<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'text' => 'required|max:255',
            'media_type' => 'required',
            'media' => 'required|max:50128',
            'tag1_id' => 'required',
            'tag2_id' => 'nullable',
            'tag3_id' => 'nullable',
            'is_positive' => 'required'
        ];
    }
}
