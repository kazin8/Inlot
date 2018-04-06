<?php

namespace App\Http\Controllers\Cabinet\Goods\Categories\Cars\Steps;

use App\Car;
use App\Goods;
use App\GoodsGallery;
use App\Interfaces\Category;
use App\Plugins\FileManager;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\CarModel;
use App\City;
use App\Handbook;
use App\HintList;
use App\Http\Controllers\Cabinet\Goods\Categories\StepController;
use App\Mark;
use App\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;

/**
 * First step of car's addition.
 *
 * Class SecondStepController
 * @package App\Http\Controllers\Cabinet\Goods\Categories\Cars\Steps
 */
class SecondStepController extends StepController
{

    public $status = Goods::SECOND_STEP_ADDITION;

    /**
     * View the second step of car's addition.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        $data = $this->getData();
        $goods = $this->goods;
        $car = Car::find($goods->item_id);

        return view('cabinet.goods.categories.cars.step_2', compact('data', 'goods', 'car'));
    }

    /**
     * Get the data for second step of car's addition.
     *
     * @return array
     */
    public function getData()
    {
        $car = Car::find($this->goods->item_id);

        return [
            'regions' => Region::lists('name', 'id'),
            'cities' => City::where(['region_id' => $this->goodsController->getCurrentRegionId($this->goods)])->lists('name', 'id'),
            'marks' => Mark::lists('name', 'id'),
            'models' => $car->mark_id ?
                    CarModel::where('mark_id', $car->mark_id)->lists('name', 'id') :
                    [],
            'dates' => HintList::getReleaseDates(),
            'ptsList' => Handbook::find(7)->records()->lists('name', 'id'),
            'ptsOwnerNumberList' => Handbook::find(8)->records()->lists('name', 'id'),
            'gears' => Handbook::find(2)->records()->lists('name', 'id'),
            'bodies' => Handbook::find(1)->records()->lists('name', 'id'),
            'colors' => Handbook::find(9)->records()->lists('name', 'id'),
            'engines' => Handbook::find(4)->records()->lists('name', 'id'),
            'rudders' => Handbook::find(5)->records()->lists('name', 'id'),
            'kppList' => Handbook::find(6)->records()->lists('name', 'id'),
            'states' => Handbook::find(10)->records()->lists('name', 'id'),
            'tyres' => Handbook::find(11)->records()->lists('name', 'id'),
            'region' => $this->goodsController->getCurrentRegionId($this->goods),
            'city' => $this->goodsController->getCurrentCityId($this->goods),
            'address' => $this->goodsController->getCurrentAddress($this->goods),
        ];
    }

    /**
     * Execute the second step of car's addition.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function execute()
    {
        $goods = $this->goods;
        $request = $this->request;
        $car = Car::find($goods->item_id);

        $validator = Validator::make($request->all(), $this->getValidationRules(), $this->getValidationMessages());

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $car->fill($request->except(
            'image',
            'video',
            'comment',
            'region_id',
            'city_id',
            'address',
            'fl_tyre_image',
            'fr_tyre_image',
            'bl_tyre_image',
            'br_tyre_image',
            'tyre_id',
            'body_id'
        ));
        $car->body_id = $request->input('body_id') ?: null;
        $car->tyre_id = $request->input('tyre_id') ?: null;
        $car->fl_tyre_image = $request->hasFile('fl_tyre_image') ?
            FileManager::loadFile($request->file('fl_tyre_image'), $goods->imagesDir) :
            $car->fl_tyre_image;
        $car->fr_tyre_image = $request->hasFile('fr_tyre_image') ?
            FileManager::loadFile($request->file('fr_tyre_image'), $goods->imagesDir) :
            $car->fr_tyre_image;
        $car->bl_tyre_image = $request->hasFile('bl_tyre_image') ?
            FileManager::loadFile($request->file('bl_tyre_image'), $goods->imagesDir) :
            $car->bl_tyre_image;
        $car->br_tyre_image = $request->hasFile('br_tyre_image') ?
            FileManager::loadFile($request->file('br_tyre_image'), $goods->imagesDir) :
            $car->br_tyre_image;

        $goods->fill($request->only('comment', 'region_id', 'city_id', 'address'));
        $goods->name = Mark::findById($request->input('mark_id'))['name'] . ' ' . CarModel::findById($request->input('model_id'))['name'];
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
        $videoUrl = 'https://www.youtube.com/oembed?format=json&url=' . $request->input('video');
        $goods->video = @file_get_contents($videoUrl) ? $request->input('video') : null;

        if ($car->save() and $goods->save()) {
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
            'mark_id' => 'required',
            'model_id' => 'required',
            'date_release_id' => 'required|integer|between:1930,' . Carbon::now()->format('Y'),
            'run' => 'required|integer|between:0,1000000',
            'state_id' => 'required',
            'gear_id' => 'required',
            'color_id' => 'required',
            'rudder_id' => 'required',
            'engine_id' => 'required',
            'kpp_id' => 'required',
            'vin' => 'size:17',
            'power' => 'integer',
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
            'mark_id.required' => 'Это обязательное поле.',
            'model_id.required' => 'Это обязательное поле.',
            'date_release_id.required' => 'Это обязательное поле.',
            'date_release_id.integer' => 'Это числовое поле.',
            'date_release_id.between' => 'Год выпуска должен быть в диапазоне от 1930 до ' . Carbon::now()->format('Y'),
            'run.required' => 'Это обязательное поле.',
            'run.integer' => 'Это числовое поле',
            'run.between' => 'Пробег должен быть в диапазоне от 1 до 1000000',
            'state_id.required' => 'Это обязательное поле.',
            'gear_id.required' => 'Это обязательное поле.',
            'color_id.required' => 'Это обязательное поле.',
            'rudder_id.required' => 'Это обязательное поле.',
            'engine_id.required' => 'Это обязательное поле.',
            'kpp_id.required' => 'Это обязательное поле.',
            'vin.size' => 'Значение VIN должно содержать 17 символов.',
            'power.integer' => 'Это числовое поле.',
            'image.image' => 'Файл должен быть в формате jpeg, png, bmp, gif или svg.',
            'image.between' => 'Файл не должен превышать 5Мб'
        ];
    }

}
