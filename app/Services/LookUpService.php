<?php

namespace App\Services;

use Exception;
use App\Models\Brand;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Backend\LookupRepository;
use App\Services\Interfaces\LookUpServiceInterface;

class LookUpService implements LookUpServiceInterface
{
    protected $lookupRepository;

    public function __construct(LookupRepository $lookupRepository)
    {
        $this->lookupRepository = $lookupRepository;
    }

    public function getAuthenticatedUser()
    {
        return Auth::user();
    }

    public function getLookupByType($type)
    {
        return $this->lookupRepository->getLookups('type',$type);
    }

}