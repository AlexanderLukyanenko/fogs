<?php

namespace App\Http\Requests\User;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
     * @param RecaptchaRule $recaptchaRule
     * @return array
     */
    public function rules(RecaptchaRule $recaptchaRule)
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
            'recaptcha_token' => ['required', $recaptchaRule]
        ];
    }
}
