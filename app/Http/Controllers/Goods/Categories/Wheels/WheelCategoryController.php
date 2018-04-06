<?php

namespace App\Http\Controllers\Goods\Categories\Wheels;

use App\Handbook;
use App\HintList;
use App\Http\Controllers\Goods\SortController;
use App\Http\Controllers\Goods\GoodsController;
use App\Plugins\Breadcrumbs;
use App\Plugins\Pagination;
use App\Wheel;
use Illuminate\Http\Request;
use Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WheelCategoryController extends Controller
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

    private $paginationAction;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->goodsController = new GoodsController();
        $this->filter = new WheelFilterController($request);
        $this->sort = new SortController($request, $this->accessableColumns, $this->accessableDirections);
        $this->paginationAction = route('goods.list.pagination', ['slug' => 'wheels']);
    }

    public function goodsList()
    {
        $builder = Wheel::wheelList();
        $pagination = new Pagination(clone $builder, 1, $this->perPage);
        $wheels = $builder->sort($this->sort)->pagination(1, $this->perPage)->get();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        $filters = $this->getFilters();


        Breadcrumbs::add(['name' => 'Колеса']);
        Breadcrumbs::render();

        return view('goods.categories.wheels.list', compact('wheels', 'filters', 'paginationBlock'));
    }

    protected function getFilters()
    {
        return [
            'diameters' => HintList::getRimDiameters(),
            'types' => Handbook::find(15)->records()->lists('name', 'id'),
            'widthList' => HintList::getRimWidthValues(),
            'numberOfHolesList' => HintList::getNumberOfHolesValues(),
            'holeDiameters' => Handbook::find(16)->records()->lists('name', 'id'),
            'radiuses' => Handbook::find(17)->records()->lists('name', 'id'),
            'seasonalities' => Handbook::find(14)->records()->lists('name', 'id'),
            'profileWidthList' => HintList::getProfileWidthValues(),
            'profileHeightList' => HintList::getProfileHeightValues(),
            'states' => Handbook::find(13)->records()->lists('name', 'id')
        ];
    }

    public function filterAndViewPartial()
    {
        $builder = Wheel::wheelList()->filter($this->filter);
        $pagination = new Pagination(clone $builder, $this->request->page, $this->perPage);
        $wheels = $builder->sort($this->sort)->pagination(1, $pagination->getPage() * $this->perPage)->get();
        $viewTemplate = $this->getViewTemplate();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return Response::json([
            'view' => view('goods.categories.wheels.partials.list_' . $viewTemplate, compact('wheels'))->render(),
            'pagination' => $paginationBlock
        ]);
    }

    public function pagination()
    {
        $builder = Wheel::wheelList()->filter($this->filter);
        $pagination = new Pagination(clone $builder, $this->request->page, $this->perPage);
        $wheels = $builder->sort($this->sort)->pagination($pagination->getPage(), $this->perPage)->get();
        $viewTemplate = $this->getViewTemplate();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return Response::json([
            'view' => view('goods.categories.wheels.partials.list_' . $viewTemplate, compact('wheels'))->render(),
            'pagination' => $paginationBlock
        ]);
    }

    private function getViewTemplate()
    {
        return (null === array_search($this->request->input('view'), $this->viewTemplates)) ?
            $this->viewTemplates['default'] :
            $this->request->input('view');
    }
}
