<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|min:3',
            'family' => 'nullable|min:2',
            'second' => 'nullable|min:2',
            'birthday' => 'nullable|date',
            'attachment' => 'nullable|max:1024|mimes:png,jpeg'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
