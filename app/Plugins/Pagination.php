<?php

namespace App\Plugins;

use Illuminate\Database\Eloquent\Builder;

class Pagination
{
    private $builder;

    private $page;

    private $perPage;

    public function __construct(Builder $builder, $page, $perPage = 30)
    {
        $this->builder = $builder;
        $this->page = $page ?: ceil($builder->count() / $perPage);
        $this->perPage = $perPage;
    }

    public function view($url)
    {
        $builder = $this->builder;
        $page = $this->page;
        $perPage = $this->perPage;

        $goodsCount = $builder->count();
        $paginationView = (($page * $perPage) < $goodsCount) ?: false;
        $curGoodsCount = $paginationView ? $page * $perPage : $goodsCount;

        return view(
            'partials/pagination',
            compact('paginationView', 'goodsCount', 'curGoodsCount', 'page', 'perPage', 'url')
        );
    }

    public function getPage()
    {
        return $this->page;
    }
}