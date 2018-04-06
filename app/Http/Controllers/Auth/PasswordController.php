<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Mockery\CountValidator\Exception;
use Validator;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after password reset.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new password controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Check whether email isset.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Mockery\CountValidator\Exception
     */
    public function checkEmail(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->only('email'), ['email' => 'required|exists:users']);

            return $validator->fails() ? response(['valid' => false]) : response(['valid' => true]);
        }

        throw new Exception('Request is not ajax.');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, $this->getEmailValidationRules(), $this->getEmailValidationMessages());

        $broker = $this->getBroker();

        $response = Password::broker($broker)->sendResetLink($request->only('email'), function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->getSendResetLinkEmailSuccessResponse($response, $request['email']);

            case Password::INVALID_USER:
            default:
                return $this->getSendResetLinkEmailFailureResponse();
        }
    }

    /**
     * Get a validation rules for an incoming password reset request.
     *
     * @return array
     */
    protected function getEmailValidationRules()
    {
        return [
            'email' => 'required|email'
        ];
    }

    /**
     * Get a validation error messages for an incoming password reset request.
     *
     * @return array
     */
    protected function getEmailValidationMessages()
    {
        return [
            'email.required' => 'Это обязательное поле.',
            'email.email' => 'Неверный формат.'
        ];
    }

    /**
     * Get the e-mail subject line to be used for the reset link email.
     *
     * @return string
     */
    protected function getEmailSubject()
    {
        return property_exists($this, 'subject') ? $this->subject : 'Восстановление пароля';
    }

    /**
     * Get the response for after the reset link has been successfully sent.
     *
     * @param $response
     * @param $email
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function getSendResetLinkEmailSuccessResponse($response, $email)
    {
        return redirect()->back()->with(['status' => trans($response), 'email' => $email]);
    }

    /**
     * Get the response for after the reset link could not be sent.
     *
     * @return $this
     */
    protected function getSendResetLinkEmailFailureResponse()
    {
        return redirect()->back()->withErrors(['email' => 'Введеный вами e-mail не зарегистрирован.']);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reset(Request $request)
    {
        $this->validate($request, $this->getResetValidationRules(), $this->getResetValidationMessages());

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $broker = $this->getBroker();

        $response = Password::broker($broker)->reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return $this->getResetSuccessResponse($response);

            default:
                return $this->getResetFailureResponse($request, $response);
        }
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function getResetValidationRules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    /**
     * Get the password reset validation errors messages.
     *
     * @return array
     */
    protected function getResetValidationMessages()
    {
        return [
            'email.required' => 'Это обязательное поле.',
            'email.email' => 'Неверный формат.',
            'password.required' => 'Это обязательное поле.',
            'password.confirmed' => 'Пароли не совпадают.',
            'password.min' => 'Пароль должен состоять минимум из 6-ти символов. Выбирайте надежный пароль!'
        ];
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = $password;

        $user->save();

        Auth::guard($this->getGuard())->login($user);
    }
}
