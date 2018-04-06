<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminPageRequest extends Request
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
     * @return array - validation rules.
     * @throws \Exception - if object is not instance of Page.
     */
    public function rules()
    {
        if ($this->pages) {
            if ($this->pages instanceof \App\Page) {
                return [
                    'name' => 'required',
                    'slug' => 'alpha_dash|required|unique:pages,slug,'. $this->pages->id
                ];
            }
            throw new \Exception('$this->pages не является объектом класса App\Page!');
        } else {
            return [
                'name' => 'required',
                'slug' => 'alpha_dash|required|unique:pages'
            ];
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'     => 'Укажите заголовок',
            'slug.required'     => 'Укажите ЧПУ',
            'slug.unique'       => 'Страница с таким адресом уже существует',
            'slug.alpha_dash'   => 'ЧПУ может содерать только буквы, цифры и знак тире'
        ];
    }
}
