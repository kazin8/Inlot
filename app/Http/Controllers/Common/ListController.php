<?php

namespace App\Http\Controllers\Common;

use Auth;
use App\City;
use App\CarModel;
use App\Goods;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ListController extends Controller
{

    /**
     * Get cities of the region.
     *
     * @param Request $request
     * @return string
     */
    public function getCitiesByRegionId(Request $request)
    {
        if ($request->regionId) {
            $cities = City::where(['region_id' => $request->regionId])->lists('name', 'id')->toArray();
        }

        return isset($cities) ? json_encode($cities) : json_encode([]);
    }

    public function getModelsByMarkId(Request $request)
    {
        $models = [];

        if (is_array($request->markId)) {
            if (count($request->markId)) {
                foreach ($request->markId as $markId) {
                    $models = $models + CarModel::where(['mark_id' => $markId])->lists('name', 'id')->toArray();
                }
            }
        } else {
            $models = CarModel::where(['mark_id' => (int)$request->markId])->lists('name', 'id')->toArray();
        }

        return json_encode($models);
    }

}
