<?php

namespace App\Http\Controllers\Goods\Categories\AutoParts;

use App\Plugins\Breadcrumbs;
use App\Plugins\Pagination;
use Validator;
use App\AutoPart;
use App\Handbook;
use App\HintList;
use App\Http\Controllers\Goods\SortController;
use App\Http\Controllers\Goods\GoodsController;
use App\Mark;
use Illuminate\Http\Request;
use Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AutoPartCategoryController extends Controller
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
        $this->filter = new AutoPartFilterController($request);
        $this->sort = new SortController($request, $this->accessableColumns, $this->accessableDirections);
        $this->paginationAction = route('goods.list.pagination', ['slug' => 'auto-parts']);
    }

    public function goodsList()
    {
        $builder = AutoPart::autoPartList();
        $pagination = new Pagination(clone $builder, 1, $this->perPage);
        $autoParts = $builder->sort($this->sort)->pagination(1, $this->perPage)->get();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        $filters = $this->getFilters();


        Breadcrumbs::add(['name' => 'Запчасти']);
        Breadcrumbs::render();

        return view('goods.categories.auto_parts.list', compact('autoParts', 'filters', 'paginationBlock'));
    }

    protected function getFilters()
    {
        return [
            'kinds' => Handbook::find(12)->records()->lists('name', 'id'),
            'states' => Handbook::find(13)->records()->lists('name', 'id'),
            'marks' => Mark::lists('name', 'id'),
            'dates' => HintList::getReleaseDates(),
            'engines' => Handbook::find(4)->records()->lists('name', 'id')
        ];
    }

    public function filterAndViewPartial()
    {
        $builder = AutoPart::autoPartList()->filter($this->filter);
        $pagination = new Pagination(clone $builder, $this->request->page, $this->perPage);
        $autoParts = $builder->sort($this->sort)->pagination(1, $pagination->getPage() * $this->perPage)->get();
        $viewTemplate = $this->getViewTemplate();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return Response::json([
            'view' => view('goods.categories.auto_parts.partials.list_' . $viewTemplate, compact('autoParts'))->render(),
            'pagination' => $paginationBlock
        ]);
    }

    public function pagination()
    {
        $builder = AutoPart::autoPartList()->filter($this->filter);
        $pagination = new Pagination(clone $builder, $this->request->page, $this->perPage);
        $autoParts = $builder->sort($this->sort)->pagination($pagination->getPage(), $this->perPage)->get();
        $viewTemplate = $this->getViewTemplate();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return Response::json([
            'view' => view('goods.categories.auto_parts.partials.list_' . $viewTemplate, compact('autoParts'))->render(),
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
