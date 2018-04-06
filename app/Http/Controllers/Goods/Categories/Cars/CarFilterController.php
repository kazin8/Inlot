<?php

namespace App\Http\Controllers\Goods\Categories\Cars;

use App\Handbook;
use App\HintList;
use App\Http\Controllers\Goods\FilterController;
use App\Mark;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CarFilterController extends FilterController
{

    protected function mark($markId = null)
    {
        return $markId ? $this->builder->where('mark_id', $markId) : $this->builder;
    }

    protected function models($modelIds = null)
    {
        return $modelIds ? $this->builder->whereIn('model_id', $modelIds) : $this->builder;
    }

    protected function engine($engineId = null)
    {
        return $engineId ? $this->builder->where('engine_id', $engineId) : $this->builder;
    }

    protected function dateBegin($dateBegin = null)
    {
        return $dateBegin ? $this->builder->where('date_release_id', '>=', $dateBegin) : $this->builder;
    }

    protected function dateEnd($dateEnd = null)
    {
        return $dateEnd ? $this->builder->where('date_release_id', '<=', $dateEnd) : $this->builder;
    }

}
