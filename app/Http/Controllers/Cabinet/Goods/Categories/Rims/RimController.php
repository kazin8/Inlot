<?php

namespace App\Http\Controllers\Cabinet\Goods\Categories\Rims;

use App\Goods;
use App\Http\Controllers\Cabinet\Goods\Categories\CategoryController;
use App\Rim;
use Illuminate\Http\Request;

use App\Http\Requests;

class RimController extends CategoryController
{
    protected $rim;

    protected $categoryDir = 'Rims';

    public function __construct(Goods $goods, Request $request)
    {
        parent::__construct($goods, $request);

        $this->rim = Rim::find($goods->item_id);
    }

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

    public function update()
    {
        return $this->getCurrentStep($this->categoryDir)->execute();
    }
}
