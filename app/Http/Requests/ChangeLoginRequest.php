<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangeLoginRequest extends Request
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
            'login' => 'required|max:255|unique:users'
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
            'login.required' => 'Это обязательное поле.',
            'login.max' => 'Логин не должен быть больше 255 символов',
            'login.unique' => 'Такой логин уже зарегистрирован.'
        ];
    }
}
