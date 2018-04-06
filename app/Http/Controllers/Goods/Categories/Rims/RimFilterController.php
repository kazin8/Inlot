<?php

namespace App\Http\Controllers\Goods\Categories\Rims;

use App\Http\Controllers\Goods\FilterController;
use Illuminate\Http\Request;

use App\Http\Requests;

class RimFilterController extends FilterController
{

    public function diameter($diameter = null)
    {
        return $diameter ? $this->builder->where('diameter', $diameter) : $this->builder;
    }

    public function type($typeId = null)
    {
        return $typeId ? $this->builder->where('rim_type_id', $typeId) : $this->builder;
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

    public function width($width = null)
    {
        return $width ? $this->builder->where('width', $width) : $this->builder;
    }

    public function numberOfHoles($numberOfHoles = null)
    {
        return $numberOfHoles ? $this->builder->where('number_of_holes', $numberOfHoles) : $this->builder;
    }

    public function holeDiameter($holeDiameterId = null)
    {
        return $holeDiameterId ? $this->builder->where('hole_diameter_id', $holeDiameterId) : $this->builder;
    }

    public function radius($radiusId = null)
    {
        return $radiusId ? $this->builder->where('radius_id', $radiusId) : $this->builder;
    }

    public function state($stateId = null)
    {
        return $stateId ? $this->builder->where('state_id', $stateId) : $this->builder;
    }

}
