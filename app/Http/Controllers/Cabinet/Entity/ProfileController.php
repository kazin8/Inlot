<?php

namespace App\Http\Controllers\Cabinet\Entity;

use App\Plugins\FileManager;
use Auth;
use Validator;
use Mail;

use App\Address;
use App\City;
use App\Company;
use App\Region;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Common\Cabinet\ProfileController as BaseProfileController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends BaseProfileController
{

    public function index()
    {
        $profile = $this->getProfileData();
        $goodsOnSale = Auth::user()->goods()->onSale()->orderBy('created_at', 'desc')->take(3)->get();
        $visitedGoods = $this->goodsController->getVisitedGoods($this->request, 3);

        return view('cabinet.entity.index', compact('profile', 'goodsOnSale', 'visitedGoods'));
    }

    /**
     * Render profile view with profile data.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        $profile = $this->getProfileData();

        $regions = Region::lists('name', 'id');
        $cities = City::where(['region_id' => $profile['currentRegion']])->lists('name', 'id');
        $profileActive = true;

        return view(
            'cabinet.entity.profile.index',
            compact('profile', 'regions', 'cities', 'profileActive')
        );
    }

    /**
     * Update user's profile.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Mockery\CountValidator\Exception
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationRules($request), $this->getValidationMessages());

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $user = User::findOrFail(Auth::user()->id);
        $user->fill($request->only(['name', 'phone']));
        $user->image = $this->request->hasFile('image') ?
            FileManager::loadFile($this->request->file('image'), Auth::user()->imagesDir) :
            Auth::user()->image;

        $company = Company::where(['user_id' => $user->id])->first();
        $company->fill($request->only(['inn']));
        $company->name = $request->input('company');

        $address = Address::firstOrCreate(['user_id' => $user->id]);
        $address->fill($request->only(['address', 'postcode', 'description', 'region_id', 'city_id']));

        if ($user->save() and $user->company()->save($company) and $user->address()->save($address)) {
            Session::flash('success_message', 'Профиль успешно изменен!');

            return response(['status' => 'success']);
        }

        return response(['message' => 'Произошла необратимая оишбка.'], 500);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function getValidationRules(Request $request)
    {
        $rules = parent::getValidationRules($request);

        $rules['company'] = 'required|max:255';
        $rules['inn'] = 'inn';

        return $rules;
    }

    /**
     * Get the messages of errors.
     *
     * @return array
     */
    public function getValidationMessages()
    {
        $messages = parent::getValidationMessages();

        $messages['company.required'] = 'Это обязательное поле.';
        $messages['company.max'] = 'Слишком длинное название компании.';
        $messages['inn.inn'] = 'Это не похоже на ИНН.';

        return $messages;
    }

    public function becomeDealer()
    {
        Mail::send('cabinet.emails.becomeDealer', ['user' => Auth::user()], function($m) {
            $m->to(User::where('is_admin', true)->first()['email'])->subject('Запрос на статус продавца');
        });
    }

}
