<?php

namespace App\Http\Controllers\Goods;

use App\Goods;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Goods\SortController;
use App\Plugins\Pagination;
use Illuminate\Http\Request;
use Response;
use View;

class SearchController extends Controller
{

    private $request;

    private $viewTemplates = ['tile', 'default' => 'row'];

    private $accessableColumns = ['default' => 'price', 'name'];

    private $accessableDirections = ['default' => 'asc', 'desc'];

    private $perPage = 30;

    private $paginationAction;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->sort = new SortController($request, $this->accessableColumns, $this->accessableDirections);
        $this->paginationAction = route('goods.searchList.pagination');
    }
    
    public function search()
    {
        $builder = \App\Goods::search($this->request->searchQuery, $this->request->category);
        $pagination = new Pagination(clone $builder, 1, $this->perPage);
        $goodsCount = $builder->count();
        $goods = $builder->pagination(1, $pagination->getPage() * $this->perPage)->sort($this->sort)->get();
        $paginationBlock = $pagination->view($this->paginationAction)->render();
        $newGoods = Goods::newGoods(3);
        $searchQuery = $this->request->searchQuery;
        $categoryId = $this->request->category;

        return view(
            'goods.search_list',
            compact('goods', 'goodsCount', 'searchQuery', 'categoryId', 'newGoods', 'paginationBlock')
        );
    }

    public function filterAndViewPartial()
    {
        $builder = Goods::search($this->request->searchQuery, $this->request->category);
        $pagination = new Pagination(clone $builder, $this->request->page, $this->perPage);
        $goods = $builder->sort($this->sort)->pagination(1, $pagination->getPage() * $this->perPage)->get();
        $viewTemplate = $this->getViewTemplate();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return Response::json([
            'view' => view('partials/list_' . $viewTemplate, ['products' => $goods])->render(),
            'pagination' => $paginationBlock
        ]);
    }

    public function pagination()
    {
        $builder = Goods::search($this->request->searchQuery, $this->request->category);
        $pagination = new Pagination(clone $builder, $this->request->page, $this->perPage);
        $goods = $builder->pagination($pagination->getPage(), $this->perPage)->sort($this->sort)->get();
        $viewTemplate = $this->getViewTemplate();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return Response::json([
            'view' => view('partials/list_' . $viewTemplate, ['products' => $goods])->render(),
            'pagination' => $paginationBlock
        ]);
    }

    private function getViewTemplate()
    {
        return (null === array_search($this->request->view, $this->viewTemplates)) ?
            $this->viewTemplates['default'] :
            $this->request->input('view');
    }
    
}