<?php

namespace App\Http\Controllers\Cabinet;

use Auth;
use Validator;

use App\User;

use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeEmailRequest;
use App\Http\Requests\ChangeLoginRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Mockery\CountValidator\Exception;

class SettingsController extends Controller
{

    /**
     * Render the page of settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $settingsActive = true;

        return view('cabinet.settings.index', compact('settingsActive'));
    }

    /**
     * Change password.
     *
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Mockery\CountValidator\Exception
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->password = $request->input('password');

        if ($user->save()) {
            Session::flash('success_message', 'Пароль успешно изменен.');

            return response(['status' => 'success']);
        }

        return response(['message' => 'Произошла необратимая ошибка.'], 500);
    }

    /**
     * Change e-mail.
     *
     * @param ChangeEmailRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Mockery\CountValidator\Exception
     */
    public function changeEmail(ChangeEmailRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->email = $request->input('email');

        if ($user->save()) {
            Session::flash('success_message', 'E-mail успешно изменен.');

            return response(['status' => 'success']);
        }

        return response(['message' => 'Произошла необратимая ошибка.'], 500);
    }

    /**
     * Change login.
     *
     * @param ChangeLoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Mockery\CountValidator\Exception
     */
    public function changeLogin(ChangeLoginRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->login = $request->input('login');

        if ($user->save()) {
            Session::flash('success_message', 'Логин успешно изменен.');

            return response(['status' => 'success']);
        }

        return response(['message' => 'Произошла необратимая ошибка.'], 500);
    }

    /**
     * Delete account.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAccount()
    {
        User::destroy(Auth::user()->id);

        return redirect()->route('main');
    }

}
