<?php

namespace App\Services\Interfaces;

use App\Models\LookUp;

interface LookUpServiceInterface
{
    public function getLookupByType($type);
    
}