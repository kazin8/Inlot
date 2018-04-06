<?php

namespace App\Http\Controllers\Cabinet\Individual;

use App\Plugins\FileManager;
use Auth;
use Validator;

use App\Address;
use App\City;
use App\Region;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Common\Cabinet\ProfileController as BaseProfileController;
use App\Traits\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends BaseProfileController
{

    public function index()
    {
        $profile = $this->getProfileData();
        $visitedGoods = $this->goodsController->getVisitedGoods($this->request, 3);

        return view('cabinet.individual.index', compact('profile', 'visitedGoods'));
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
            'cabinet.individual.profile.index',
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

        $fileManager = new FileManager($request);

        $user = User::findOrFail(Auth::user()->id);
        $user->fill($request->only(['name', 'phone']));
        $user->image = $this->request->hasFile('image') ?
            FileManager::loadFile($this->request->file('image'), Auth::user()->imagesDir) :
            Auth::user()->image;

        $address = Address::firstOrCreate(['user_id' => Auth::user()->id]);
        $address->fill($request->only(['address', 'postcode', 'description', 'region_id', 'city_id']));

        if ($user->save() and $user->address()->save($address)) {
            Session::flash('success_message', 'Профиль успешно изменен!');

            return response(['status' => 'success']);
        }

        return response(['message' => 'Произошла необратимая ошибка.'], 500);
    }

}
