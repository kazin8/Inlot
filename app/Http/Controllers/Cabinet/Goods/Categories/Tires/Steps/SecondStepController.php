<?php

namespace App\Http\Controllers\Cabinet\Goods\Categories\Tires\Steps;

use Storage;
use Validator;
use App\City;
use App\Goods;
use App\GoodsGallery;
use App\Handbook;
use App\HintList;
use App\Http\Controllers\Cabinet\Goods\Categories\StepController;
use App\Plugins\FileManager;
use App\Region;
use App\Tire;
use Illuminate\Http\Request;

use App\Http\Requests;

class SecondStepController extends StepController
{
    public $status = Goods::SECOND_STEP_ADDITION;

    public function view()
    {
        $data = $this->getData();
        $goods = $this->goods;
        $tire = Tire::find($goods->item_id);

        return view('cabinet.goods.categories.tires.step_2', compact('data', 'goods', 'tire'));
    }

    private function getData()
    {
        return [
            'regions' => Region::lists('name', 'id'),
            'cities' => City::where(['region_id' => $this->goodsController->getCurrentRegionId($this->goods)])
                    ->lists('name', 'id'),
            'diameters' => HintList::getDiameters(),
            'seasonalities' => Handbook::find(14)->records()->lists('name', 'id'),
            'profileWidthValues' => HintList::getProfileWidthValues(),
            'profileHeightValues' => HintList::getProfileHeightValues(),
            'states' => Handbook::find(13)->records()->lists('name', 'id'),
            'region' => $this->goodsController->getCurrentRegionId($this->goods),
            'city' => $this->goodsController->getCurrentCityId($this->goods),
            'address' => $this->goodsController->getCurrentAddress($this->goods),
        ];
    }

    public function execute()
    {
        $goods = $this->goods;
        $request = $this->request;
        $tire = Tire::find($goods->item_id);

        $validator = Validator::make($request->all(), $this->getValidationRules(), $this->getValidationMessages());

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $tire->fill($request->except('region_id', 'city_id', 'address', 'comment'));

        $goods->fill($request->only('comment', 'region_id', 'city_id', 'address'));
        $goods->name = 'Шины ' . $tire->profile_width . '/' . $tire->profile_height . ' R' . $tire->diameter;
        $goods->image = $request->hasFile('image') ?
            FileManager::loadFile($request->file('image'), $goods->imagesDir) :
            $goods->image;

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $fileName = FileManager::loadFile($file, $goods->imagesDir);
                $fileHash = md5(Storage::get($goods->imagesDir . $fileName));
                $galleryItem = $goods->gallery()->where('hash', $fileHash)->first() ?: new GoodsGallery();
                $galleryItem->goods_id = $goods->id;
                $galleryItem->filename = $fileName;
                $galleryItem->hash = $fileHash;
                $galleryItem->save();
            }
        }

        if ($tire->save() and $goods->save()) {
            $this->goodsController->changeStepStatus($goods, $this->getNextStep());

            return response(['url' => route('cabinet.goods.edit', ['step' => 3, 'goods' => $goods->id])]);
        }

        return response(['message' => 'Произошла необратимая ошибка'], 500);
    }

    /**
     * Get the validation rules for second step.
     *
     * @return array
     */
    private function getValidationRules()
    {
        return [
            'region_id' => 'required',
            'city_id' => 'required',
            'diameter' => 'required',
            'seasonality_id' => 'required',
            'profile_width' => 'required',
            'profile_height' => 'required',
            'state_id' => 'required',
            'image' => 'image|between:0,5120'
        ];
    }

    /**
     * Get the validation messages for errors.
     *
     * @return array
     */
    private function getValidationMessages()
    {
        return [
            'region_id.required' => 'Это обязательное поле.',
            'city_id.required' => 'Это обязательное поле.',
            'diameter.required' => 'Это обязательное поле.',
            'seasonality_id.required' => 'Это обязательное поле.',
            'profile_width.required' => 'Это обязательное поле.',
            'profile_height.required' => 'Это обязательное поле.',
            'state_id.required' => 'Это обязательное поле.',
            'image.image' => 'Файл должен быть в формате jpeg, png, bmp, gif или svg.',
            'image.between' => 'Файл не должен превышать 5Мб'
        ];
    }
}
