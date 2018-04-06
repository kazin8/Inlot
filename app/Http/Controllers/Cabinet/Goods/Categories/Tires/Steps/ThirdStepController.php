<?php

namespace App\Http\Controllers\Cabinet\Goods\Categories\Tires\Steps;

use Validator;
use App\Goods;
use App\Http\Controllers\Cabinet\Goods\Categories\StepController;
use Illuminate\Http\Request;

use App\Http\Requests;

class ThirdStepController extends StepController
{
    public $status = Goods::THIRD_STEP_ADDITION;

    /**
     * View the third step of car's addition.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        $goods = $this->goods;

        return view('cabinet.goods.categories.tires.step_3', compact('goods'));
    }

    /**
     * Execute the third step.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function execute()
    {
        $validator = Validator::make(
            $this->request->all(),
            $this->getValidationRules(),
            $this->getValidationMessages()
        );

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $this->goods->fill($this->request->all());

        if ($this->goods->save()) {
            $this->goodsController->changeStepStatus($this->goods, $this->getNextStep());

            return response(['url' => route('cabinet.goods.edit', ['step' => 4, 'goods' => $this->goods->id])]);
        }

        return response(['message' => 'Произошла необратимая ошибка'], 500);
    }

    /**
     * Get the validation rules for third step.
     *
     * @return array
     */
    private function getValidationRules()
    {
        return [
            'price' => 'integer'
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
            'price.integer' => 'Это числовое поле.'
        ];
    }
}
