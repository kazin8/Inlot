<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdministratorRequest extends Request
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
     * @return array - validation rules
     * @throws \Exception - if object is not instance of User.
     */
    public function rules()
    {
        if ($this->administrators) {
            if ($this->administrators instanceof \App\User) {
                return [
                    'name' => 'required|max:255',
                    'login' => 'required|max:255|unique:users,login,' . $this->administrators->id,
                    'email' => 'required|email|unique:users,email,' . $this->administrators->id,
                    'phone' => 'required',
                    'password' => 'confirmed|min:6'
                ];
            }
            throw new \Exception('$this->administrators не является объектом класса App\User!');
        } else {
            return [
                'name' => 'required|max:255',
                'login' => 'required|max:255|unique:users',
                'email' => 'required|email|unique:users',
                'phone' => 'required',
                'password' => 'required|confirmed|min:6'
            ];
        }
    }

    /**
     * Get the messages of errors.
     *
     * @return array - messages of errors.
     */
    public function messages()
    {
        return [
            'name.required' => 'Укажите ФИО.',
            'name.max' => 'ФИО не должно содержать больше 255 символов.',
            'login.required' => 'Укажите логин.',
            'login.max' => 'Логин не должен содержать больше 255 символов.',
            'login.unique' => 'Пользователь с таким логином уже существует.',
            'email.required' => 'Укажите E-mail.',
            'email.email' => 'Укажите E-mail верного формата.',
            'email.unique' => 'Пользователь с таким E-mail уже существует.',
            'phone.required' => 'Укажите телефон',
            'password.required' => 'Укажите пароль.',
            'password.confirmed' => 'Пароли не совпадают.',
            'password.min' => 'Пароль не должен содержать меньше 6 символов.'
        ];
    }
}
