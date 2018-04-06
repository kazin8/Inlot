<?php

namespace App\Http\Controllers\Auth;

use App\Company;

use Mail;
use Storage;

use App\User;
use App\HintList;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';



    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Check whether login is unique.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Mockery\CountValidator\Exception
     */
    public function checkLogin(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->only('login'), ['login' => 'required|unique:users']);

            return $validator->fails() ? response(['valid' => false]) : response(['valid' => true]);
        }

        throw new Exception('Request is not ajax.');
    }

    /**
     * Check whether email is unique.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Mockery\CountValidator\Exception
     */
    public function checkEmail(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->only('email'), ['email' => 'required|unique:users']);

            return $validator->fails() ? response(['valid' => false]) : response(['valid' => true]);
        }

        throw new Exception('Request is not ajax.');
    }

    /**
     * Check whether company is unique.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Mockery\CountValidator\Exception
     */
    public function checkCompany(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->only('company'), ['company' => 'required|unique:companies,name']);

            return $validator->fails() ? response(['valid' => false]) : response(['valid' => true]);
        }

        throw new Exception('Request is not ajax');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $this->sendEmailAboutSuccessRegister($request->input('email'));

        Auth::guard($this->getGuard())->login($this->create($request->all()));

        return redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            $this->getRegisterValidationRules($data['register']),
            $this->getRegisterValidationMessages($data['register'])
        );
    }

    /**
     * Get a validation rules for an incoming registration request.
     *
     * @param $registerType
     * @return array
     */
    protected function getRegisterValidationRules($registerType)
    {
        $rules = [
            'name' => 'required|max:255',
            'login' => 'required|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:7',
            'password' => 'required|min:6',
        ];

        if ($registerType == 'entity') {
            $rules['company'] = 'required|unique:companies,name';
        }

        return $rules;
    }

    /**
     * Get a validation error messages for an incoming registration request.
     *
     * @param $registerType
     * @return array
     */
    protected function getRegisterValidationMessages($registerType)
    {
        $messages = [
            'name.required' => 'Это обязательное поле.',
            'name.max' => 'Слишком длинное имя.',
            'login.required' => 'Это обязательное поле.',
            'login.max' => 'Слишком длинный логин.',
            'login.unique' => 'Пользователь с таким логином уже существует.',
            'email.required' => 'Это обязательное поле.',
            'email.email' => 'Неверный формат.',
            'email.unique' => 'Пользователь с таким e-mail уже существует.',
            'phone.required' => 'Это обязательное поле.',
            'phone.min' => 'Телефон должен состоять минимум из 7 символов.',
            'password.required' => 'Это обязательное поле.',
            'password.min' => 'Пароль должен состоять минимум из 6 символов. Выбирайте надежный пароль!.'
        ];

        if ($registerType == 'entity') {
            $messages['company.required'] = 'Это обязательное поле.';
            $messages['company.unique'] = 'Компания с таким названием уже существует.';
        }

        return $messages;
    }

    /**
     * Send an email about success register.
     *
     * @param $email
     */
    protected function sendEmailAboutSuccessRegister($email)
    {
        Mail::send('auth.emails.success_register', [], function($m) use ($email) {
            $m->to($email)->subject('Добро пожаловать в INLOT!');
        });
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $userData = $data;
        $userData['is_admin'] = false;
        $userData['type'] = isset($data['company']) ?
            HintList::getUserTypeByCode('entity') :
            HintList::getUserTypeByCode('individual');

        $user = User::create($userData);

        if (isset($data['company'])) {
            $user->company()->save(new Company(['name' => $data['company']]));
        }

        Storage::makeDirectory('/users/' . $user->id);

        return $user;
    }

    /**
     * @return string
     */
    public function loginUsername()
    {
        return 'login';
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return 'Не найдено ни одного пользователя с такими учетными данными.';
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, $this->getLoginValidationRules(), $this->getLoginValidationMessages());
    }

    /**
     * Get a validation rules for an user login request.
     *
     * @return array
     */
    protected function getLoginValidationRules()
    {
        return [
            $this->loginUsername() => 'required',
            'password' => 'required'
        ];
    }

    /**
     * Get a validation error messages for an user login request.
     *
     * @return array
     */
    protected function getLoginValidationMessages()
    {
        return [
            $this->loginUsername() . '.required' => 'Это обязательное поле.',
            'password.required' => 'Это обязательное поле.'
        ];
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        $login = $request->get('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

        return [
            $field => $login,
            'password' => $request->get('password'),
        ];
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, \App\User $user){
        if ($user->is_admin){
            $this->redirectTo = '/admin/';
        }

        return redirect()->intended($this->redirectPath());
    }

}
