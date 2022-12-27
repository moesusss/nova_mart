<?php

namespace App\Repositories\Backend;

use App\Models\WeightConvention;
use App\Repositories\BaseRepository;

class WeightConventionRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return WeightConvention::class;
    }

    public function getWeightConventions()
    {
        $weight_conventions = WeightConvention::orderBy('created_at','desc')->get();
        return $weight_conventions;
    }

    public function getWeightConvention($id){
        return WeightConvention::find($id);
    }

}
