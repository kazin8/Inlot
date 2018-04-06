<?php

namespace App\Http\Controllers\Goods\Categories\Cars;

use App\Car;
use App\Handbook;
use App\HintList;
use App\Http\Controllers\Goods\SortController;
use App\Mark;
use App\Plugins\Breadcrumbs;
use App\Plugins\Pagination;
use Validator;
use App\Http\Controllers\Goods\GoodsController;
use Illuminate\Http\Request;
use Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CarCategoryController extends Controller
{

    protected $category;

    protected $request;

    protected $goodsContoller;

    protected $filter;

    protected $sort;

    private $viewTemplates = ['tile', 'default' => 'row'];

    protected $accessableColumns = ['default' => 'price', 'name'];

    protected $accessableDirections = ['default' => 'asc', 'desc'];

    private $perPage = 30;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->goodsController = new GoodsController();
        $this->filter = new CarFilterController($request);
        $this->sort = new SortController($request, $this->accessableColumns, $this->accessableDirections);
        $this->paginationAction = route('goods.list.pagination', ['slug' => 'cars']);
    }

    public function goodsList()
    {
        $builder = Car::carList();
        $pagination = new Pagination(clone $builder, 1, $this->perPage);
        $cars = $builder->sort($this->sort)->pagination(1, $this->perPage)->get();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        $filters = $this->getFilters();


        Breadcrumbs::add(['name' => 'Легковые автомобили']);
        Breadcrumbs::render();

        return view('goods.categories.cars.list', compact('cars', 'filters', 'paginationBlock'));
    }

    protected function getFilters()
    {
        return [
            'marks' => Mark::lists('name', 'id'),
            'dates' => HintList::getReleaseDates(),
            'engines' => Handbook::find(4)->records()->lists('name', 'id')
        ];
    }

    public function filterAndViewPartial()
    {
        $builder = Car::carList()->filter($this->filter);
        $pagination = new Pagination(clone $builder, $this->request->page, $this->perPage);
        $cars = $builder->sort($this->sort)->pagination(1, $pagination->getPage() * $this->perPage)->get();
        $viewTemplate = $this->getViewTemplate();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return Response::json([
            'view' => view('goods.categories.cars.partials.list_' . $viewTemplate, compact('cars'))->render(),
            'pagination' => $paginationBlock
        ]);
    }

    public function pagination()
    {
        $builder = Car::carList()->filter($this->filter);
        $pagination = new Pagination(clone $builder, $this->request->page, $this->perPage);
        $cars = $builder->sort($this->sort)->pagination($pagination->getPage(), $this->perPage)->get();
        $viewTemplate = $this->getViewTemplate();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return Response::json([
            'view' => view('goods.categories.cars.partials.list_' . $viewTemplate, compact('cars'))->render(),
            'pagination' => $paginationBlock
        ]);
    }

    protected function getValidationRules(Request $request)
    {
        return [
            'models' => 'belongs_with:pgsql_classifier.models,id,' .
                $this->arrayToString($request->input('models')) . ',mark_id,' . $request->input('mark'),
            'date_begin' => 'integer|max:' . $request->input('date_end'),
            'engine' => 'belongs_with:pgsql_classifier.handbooks_content,id,' .
                $request->input('engine') . ',handbook_id,4'
        ];
    }

    protected function getValidationMessages()
    {
        return [
            'models.belongs_with' => 'Одна или несколько моделей не относятся к выбранной марке.',
            'date_begin.max' => 'Неверно указан диапазон дат.',
            'engine.belongs_with' => 'Нет такого типа двигателя.'
        ];
    }

    private function arrayToString($array)
    {
        $string = '';

        if (is_array($array)){
            $string = implode(';', $array);
        }

        return $string ? $string : null;
    }

    private function getViewTemplate()
    {
        return (null === array_search($this->request->input('view'), $this->viewTemplates)) ?
            $this->viewTemplates['default'] :
            $this->request->input('view');
    }

}
