<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
     * @throws \Exception
     */
    public function rules()
    {
        if ($this->users) {
            if ($this->users instanceof \App\User) {
                return [
                    'company' => 'required_if:type,entity|unique:companies,name,' . $this->users->id . ',user_id',
                    'inn' => 'inn',
                    'name' => 'required|max:255',
                    'login' => 'required|max:255|unique:users,login,' . $this->users->id,
                    'email' => 'required|email|unique:users,email,' . $this->users->id,
                    'phone' => 'required',
                    'password' => 'confirmed|min:6',
                    'postcode' => 'rus_zip',
                    'region_id' => 'exists:pgsql_classifier.regions,id',
                    'city_id' => 'exists:pgsql_classifier.cities,id|
                        belongs_with:pgsql_classifier.cities,id,' . $this->input('city_id') .
                        ',region_id,' . $this->input('region_id'),
                    'image' => 'image|between:0,5120'
                ];
            }
            throw new \Exception('$this->administrators не является объектом класса App\User!');
        } else {
            return [
                'type' => 'required',
                'company' => 'required_if:type,entity|unique:companies,name',
                'inn' => 'inn',
                'name' => 'required|max:255',
                'login' => 'required|max:255|unique:users',
                'email' => 'required|email|unique:users',
                'phone' => 'required',
                'password' => 'required|confirmed|min:6',
                'postcode' => 'rus_zip',
                'region_id' => 'exists:pgsql_classifier.regions,id',
                'city_id' => 'exists:pgsql_classifier.cities,id|
                        belongs_with:pgsql_classifier.cities,id,' . $this->input('city_id') .
                    ',region_id,' . $this->input('region_id'),
                'image' => 'image|between:0,5120'
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
            'type.required' => 'Укажите тип пользователя.',
            'company.required_id' => 'Укажите название компании.',
            'company.unique' => 'Компания с таким названием уже зарегистрирована.',
            'inn.inn' => 'Неверный формат.',
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
            'password.min' => 'Пароль не должен содержать меньше 6 символов.',
            'region_id.exists' => 'Такого региона не существует в нашей базе',
            'city_id.exists' => 'Такого города не существует в нашей базе',
            'city_id.belongs_with' => 'Выбранный город не соответствует выбранному региону',
            'postcode.rus_zip' => 'Индекс должен состоять из 6 цифр.',
            'image.image' => 'Файл должен быть в формате jpeg, png, bmp, gif или svg.',
            'image.between' => 'Файл не должен превышать 5Мб'
        ];
    }
}
