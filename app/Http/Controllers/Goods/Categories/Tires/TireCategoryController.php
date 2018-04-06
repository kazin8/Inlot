<?php

namespace App\Http\Controllers\Goods\Categories\Tires;

use App\Handbook;
use App\HintList;
use App\Http\Controllers\Goods\SortController;
use App\Http\Controllers\Goods\GoodsController;
use App\Plugins\Pagination;
use App\Tire;
use Illuminate\Http\Request;
use Response;

use App\Http\Requests;
use App\Plugins\Breadcrumbs;
use App\Http\Controllers\Controller;

class TireCategoryController extends Controller
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
        $this->filter = new TireFilterController($request);
        $this->sort = new SortController($request, $this->accessableColumns, $this->accessableDirections);
        $this->paginationAction = route('goods.list.pagination', ['slug' => 'tires']);
    }

    public function goodsList()
    {
        $builder = Tire::tireList();
        $pagination = new Pagination(clone $builder, 1, $this->perPage);
        $tires = $builder->sort($this->sort)->pagination(1, $this->perPage)->get();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        $filters = $this->getFilters();


        Breadcrumbs::add(['name' => 'Шины']);
        Breadcrumbs::render();

        return view('goods.categories.tires.list', compact('tires', 'filters', 'paginationBlock'));
    }

    protected function getFilters()
    {
        return [
            'diameters' => HintList::getDiameters(),
            'seasonalities' => Handbook::find(14)->records()->lists('name', 'id'),
            'profileWidthList' => HintList::getProfileWidthValues(),
            'profileHeightList' => HintList::getProfileHeightValues(),
            'states' => Handbook::find(13)->records()->lists('name', 'id')
        ];
    }

    public function filterAndViewPartial()
    {
        $builder = Tire::tireList()->filter($this->filter);
        $pagination = new Pagination(clone $builder, $this->request->page, $this->perPage);
        $tires = $builder->sort($this->sort)->pagination(1, $pagination->getPage() * $this->perPage)->get();
        $viewTemplate = $this->getViewTemplate();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return Response::json([
            'view' => view('goods.categories.tires.partials.list_' . $viewTemplate, compact('tires'))->render(),
            'pagination' => $paginationBlock
        ]);
    }

    public function pagination()
    {
        $builder = Tire::tireList()->filter($this->filter);
        $pagination = new Pagination(clone $builder, $this->request->page, $this->perPage);
        $tires = $builder->sort($this->sort)->pagination($pagination->getPage(), $this->perPage)->get();
        $viewTemplate = $this->getViewTemplate();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return Response::json([
            'view' => view('goods.categories.tires.partials.list_' . $viewTemplate, compact('tires'))->render(),
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
