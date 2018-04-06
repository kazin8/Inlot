<?php

namespace App\Http\Controllers\Common\Cabinet;

use App\CarModel;
use App\City;
use App\HintList;
use App\Plugins\FileManager;
use Auth;
use App\Http\Controllers\Cabinet\Goods\GoodsController;
use Illuminate\Http\Request;
use App\Traits\File;
use App\Http\Requests;
use App\Http\Controllers\Controller;

abstract class ProfileController extends Controller
{

    protected $request;

    protected $goodsController;
    
    protected $pathToImageDir = '/avatars/';

    abstract public function index();

    abstract public function profile();

    abstract public function update(Request $request);

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->goodsController = new GoodsController();
    }

    /**
     * Get common profile data for all user's types (not administrators).
     *
     * @return array
     */
    protected function getProfileData()
    {
        $address = Auth::user()->address;

        return [
            'currentRegion' => $this->getCurrentRegionId($address),
            'currentCity' => $this->getCurrentCityId($address)
        ];
    }

    /**
     * Get current id of region. If there's not id so get default value.
     *
     * @param null $address
     * @return mixed
     */
    protected function getCurrentRegionId($address = null)
    {
        if (null !== $address) {
            return $address->region_id;
        }

        return HintList::getDefaultLocation('region');
    }

    /**
     * Get current id of city. If there's not id so get default value.
     *
     * @param null $address
     * @return mixed
     */
    protected function getCurrentCityId($address = null)
    {
        if (null !== $address) {
            return $address->city_id;
        }

        return HintList::getDefaultLocation('city');
    }

    /**
     * Get the common validation rules.
     *
     * @param Request $request
     * @return array
     */
    protected function getValidationRules(Request $request)
    {
        return [
            'name' => 'required|max:255',
            'phone' => 'required',
            'region_id' => 'exists:pgsql_classifier.regions,id',
            'city_id' => 'exists:pgsql_classifier.cities,id|
                belongs_with:pgsql_classifier.cities,id,' . $request->input('city_id') .
                ',region_id,' . $request->input('region_id'),
            'postcode' => 'rus_zip',
            'image' => 'image|between:0,5120'
        ];
    }

    /**
     * Get the common validation messages for errors.
     *
     * @return array
     */
    protected function getValidationMessages()
    {
        return [
            'name.required' => 'Это обязательное поле.',
            'name.max' => 'Слишком длинное имя.',
            'phone.required' => 'Это обязательное поле.',
            'region_id.exists' => 'Такого региона не существует в нашей базе',
            'city_id.exists' => 'Такого города не существует в нашей базе',
            'city_id.belongs_with' => 'Выбранный город не соответствует выбранному региону',
            'postcode.rus_zip' => 'Индекс должен состоять из 6 цифр.',
            'image.image' => 'Файл должен быть в формате jpeg, png, bmp, gif или svg.',
            'image.between' => 'Файл не должен превышать 5Мб'
        ];
    }

}
