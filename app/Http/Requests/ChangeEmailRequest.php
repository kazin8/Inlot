<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangeEmailRequest extends Request
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
            'email' => 'required|email|unique:users'
        ];
    }

    /**
     * Get the validation messages for errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Это обязательное поле.',
            'email.email' => 'Неверный формат.',
            'email.unique' => 'Такой e-mail уже зарегистрирован.',
        ];
    }
}
