<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangePasswordRequest extends Request
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
            'current_password' => 'required|min:6|cur_password',
            'password' => 'required|confirmed|min:6'
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
            'current_password.required' => 'Это обязательное поле.',
            'current_password.min' => 'Пароль должен состоять минимум из 6 символов.',
            'current_password.cur_password' => 'Пароль введен неверно.',
            'password.required' => 'Это обязательное поле.',
            'password.confirmed' => 'Пароли не совпадают',
            'password.min' => 'Пароль должен состоять минимум из 6 символов. Выбирайте надежный пароль!'
        ];
    }
}
