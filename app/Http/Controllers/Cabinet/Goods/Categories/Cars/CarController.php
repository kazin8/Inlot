<?php

namespace App\Http\Controllers\Cabinet\Goods\Categories\Cars;

use Auth;

use App;

use App\Http\Requests;
use App\Http\Controllers\Cabinet\Goods\Categories\CategoryController;

use Illuminate\Http\Request;

class CarController extends CategoryController
{

    protected $car;

    /**
     * The directory of Car's classes.
     *
     * @var string
     */
    protected $categoryDir = 'Cars';

    public function __construct(App\Goods $goods, Request $request = null)
    {
        parent::__construct($goods, $request);

        $this->car = App\Car::find($goods->item_id);
    }

    /**
     * View the page of car's edition.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit()
    {
        $currentStepController = $this->getCurrentStep($this->categoryDir);

        if ($this->enableCurrentStep($currentStepController)) {
            return $currentStepController->view();
        }

        return redirect()->route(
            'cabinet.goods.edit',
            ['step' => $this->goods->status + 1, 'goods' => $this->goods->id]
        );
    }

    /**
     * Update the car.
     *
     * @return mixed
     */
    public function update()
    {
        return $this->getCurrentStep($this->categoryDir)->execute();
    }

    public function getFlImage(App\Car $car)
    {
        if ($car->flTyreImagePath) {
            $preview[] = $car->flTyreImagePath;
            $previewConfig[] = ['url' => route('carFlImage.delete', ['car' => $car->id]), 'key' => $car->flTyreImage];
        }

        return json_encode([isset($preview) ? $preview : [], isset($previewConfig) ? $previewConfig : []]);
    }

    public function deleteFlImage(App\Car $car, Request $request)
    {
        App\Plugins\FileManager::deleteFile($request->key, $this->goods->imagesDir);
        $car->flTyreImage = null;
        $car->save();

        return $this->getFlImage($car);
    }

    public function getFrImage(App\Car $car)
    {
        if ($car->frTyreImagePath) {
            $preview[] = $car->frTyreImagePath;
            $previewConfig[] = ['url' => route('carFrImage.delete', ['car' => $car->id]), 'key' => $car->frTyreImage];
        }

        return json_encode([isset($preview) ? $preview : [], isset($previewConfig) ? $previewConfig : []]);
    }

    public function deleteFrImage(App\Car $car, Request $request)
    {
        App\Plugins\FileManager::deleteFile($request->key, $this->goods->imagesDir);
        $car->frTyreImage = null;
        $car->save();

        return $this->getFrImage($car);
    }

    public function getBlImage(App\Car $car)
    {
        if ($car->BlTyreImagePath) {
            $preview[] = $car->BlTyreImagePath;
            $previewConfig[] = ['url' => route('carBlImage.delete', ['car' => $car->id]), 'key' => $car->blTyreImage];
        }

        return json_encode([isset($preview) ? $preview : [], isset($previewConfig) ? $previewConfig : []]);
    }

    public function deleteBlImage(App\Car $car, Request $request)
    {
        App\Plugins\FileManager::deleteFile($request->key, $this->goods->imagesDir);
        $car->blTyreImage = null;
        $car->save();

        return $this->getBlImage($car);
    }

    public function getBrImage(App\Car $car)
    {
        if ($car->brTyreImagePath) {
            $preview[] = $car->brTyreImagePath;
            $previewConfig[] = ['url' => route('carBrImage.delete', ['car' => $car->id]), 'key' => $car->brTyreImage];
        }

        return json_encode([isset($preview) ? $preview : [], isset($previewConfig) ? $previewConfig : []]);
    }

    public function deleteBrImage(App\Car $car, Request $request)
    {
        App\Plugins\FileManager::deleteFile($request->key, $this->goods->imagesDir);
        $car->brTyreImage = null;
        $car->save();

        return $this->getBrImage($car);
    }

}
