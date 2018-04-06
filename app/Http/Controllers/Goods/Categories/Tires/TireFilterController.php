<?php

namespace App\Http\Controllers\Goods\Categories\Tires;

use App\Http\Controllers\Goods\FilterController;
use Illuminate\Http\Request;

use App\Http\Requests;

class TireFilterController extends FilterController
{

    public function diameter($diameter = null)
    {
        return $diameter ? $this->builder->where('diameter', $diameter) : $this->builder;
    }

    public function seasonality($seasonalityId = null)
    {
        return $seasonalityId ? $this->builder->where('seasonality_id', $seasonalityId) : $this->builder;
    }

    public function profileWidth($profileWidth = null)
    {
        return $profileWidth ? $this->builder->where('profile_width', $profileWidth) : $this->builder;
    }

    public function profileHeight($profileHeight = null)
    {
        return $profileHeight ? $this->builder->where('profile_height', $profileHeight) : $this->builder;
    }

    public function state($stateId = null)
    {
        return $stateId ? $this->builder->where('state_id', $stateId) : $this->builder;
    }

}
