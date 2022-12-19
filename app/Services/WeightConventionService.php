<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Backend\WeightConventionRepository;
use App\Services\Interfaces\WeightConventionServiceInterface;

class WeightConventionService implements WeightConventionServiceInterface
{
    protected $weightconventionRepository;

    public function __construct(WeightConventionRepository $weightconventionRepository)
    {
        $this->weightconventionRepository = $weightconventionRepository;
    }

    public function getWeightConventions()
    {
        return $this->weightconventionRepository->getWeightConventions();
    }

}