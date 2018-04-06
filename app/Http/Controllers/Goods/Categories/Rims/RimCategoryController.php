<?php

namespace App\Http\Controllers\Goods\Categories\Rims;

use App\Handbook;
use App\HintList;
use App\Http\Controllers\Goods\SortController;
use App\Http\Controllers\Goods\GoodsController;
use App\Plugins\Breadcrumbs;
use App\Plugins\Pagination;
use App\Rim;
use Illuminate\Http\Request;
use Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RimCategoryController extends Controller
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
        $this->filter = new RimFilterController($request);
        $this->sort = new SortController($request, $this->accessableColumns, $this->accessableDirections);
        $this->paginationAction = route('goods.list.pagination', ['slug' => 'rims']);
    }

    public function goodsList()
    {
        $builder = Rim::rimList();
        $pagination = new Pagination(clone $builder, 1, $this->perPage);
        $rims = $builder->sort($this->sort)->pagination(1, $this->perPage)->get();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        $filters = $this->getFilters();


        Breadcrumbs::add(['name' => 'Диски']);
        Breadcrumbs::render();

        return view('goods.categories.rims.list', compact('rims', 'filters', 'paginationBlock'));
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
        $builder = Rim::rimList()->filter($this->filter);
        $pagination = new Pagination(clone $builder, $this->request->page, $this->perPage);
        $rims = $builder->sort($this->sort)->pagination(1, $pagination->getPage() * $this->perPage)->get();
        $viewTemplate = $this->getViewTemplate();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return Response::json([
            'view' => view('goods.categories.rims.partials.list_' . $viewTemplate, compact('rims'))->render(),
            'pagination' => $paginationBlock
        ]);
    }

    public function pagination()
    {
        $builder = Rim::rimList()->filter($this->filter);
        $pagination = new Pagination(clone $builder, $this->request->page, $this->perPage);
        $rims = $builder->sort($this->sort)->pagination($pagination->getPage(), $this->perPage)->get();
        $viewTemplate = $this->getViewTemplate();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return Response::json([
            'view' => view('goods.categories.rims.partials.list_' . $viewTemplate, compact('rims'))->render(),
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
