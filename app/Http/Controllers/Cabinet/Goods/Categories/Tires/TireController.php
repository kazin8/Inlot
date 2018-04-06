<?php

namespace App\Http\Controllers\Cabinet\Goods\Categories\Tires;

use App\Goods;
use App\Http\Controllers\Cabinet\Goods\Categories\CategoryController;
use App\Tire;
use Illuminate\Http\Request;

use App\Http\Requests;

class TireController extends CategoryController
{
    protected $tire;

    protected $categoryDir = 'Tires';

    public function __construct(Goods $goods, Request $request)
    {
        parent::__construct($goods, $request);

        $this->tire = Tire::find($goods->item_id);
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
