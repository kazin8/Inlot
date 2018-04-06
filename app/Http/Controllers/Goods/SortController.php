<?php

namespace App\Http\Controllers\Goods;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;

class SortController extends Controller
{

    protected $request;

    protected $accessableColumns = ['default' => 'price'];

    protected $accessableDirections = ['default' => 'asc', 'desc'];

    public function __construct(Request $request, $columns = [], $directions = [])
    {
        $this->request = $request;
        $this->accessableColumns = count($columns) ? $columns : $this->accessableColumns;
        $this->accessableDirections = count($directions) ? $directions : $this->accessableDirections;
    }

    public function apply(Builder $builder)
    {
        $sortAttributes = $this->getSortAttributes();

        return $builder->orderBy($sortAttributes['column'], $sortAttributes['direction']);
    }

    private function getSortAttributes()
    {
        $sortAttributes = $this->request->exists('sort') ?
            explode('_', $this->request->sort) :
            [$this->accessableColumns['default'], $this->accessableDirections['default']];

        return ($this->isAccessableAttributes($sortAttributes)) ?
            ['column' => $sortAttributes[0], 'direction' => $sortAttributes[1]] :
            $this->getDefaultAttributes();
    }

    private function isAccessableAttributes(array $sortAttributes)
    {
        if ((false === array_search($sortAttributes[0], $this->accessableColumns)) or
            (false === array_search($sortAttributes[1], $this->accessableDirections))
        ) {
            return false;
        }

        return true;
    }

    private function getDefaultAttributes()
    {
        return [
            'column' => $this->accessableColumns['default'],
            'direction' => $this->accessableDirections['default']
        ];
    }

}
