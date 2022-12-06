<?php

namespace App\Services;

use App\Models\HubVendor;
use Exception;
use App\Models\User;
use App\Repositories\Backend\HubVendorRepository;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Backend\UserRepository;
use App\Services\Interfaces\HubVendorServiceInterface;

class HubVendorService implements HubVendorServiceInterface
{
    protected $hubvendorRepository;

    public function __construct(HubVendorRepository $hubvendorRepository)
    {
        $this->hubvendorRepository = $hubvendorRepository;
    }

    public function getAuthenticatedUser()
    {
        return Auth::user();
    }

    public function getHubVendors()
    {
        if( request()->is('api/*')){
            return $this->hubvendorRepository->getHubVendors();
        }
        return $this->hubvendorRepository->orderBy('created_at','desc')->get();
        
    }

    public function getHubVendor($id)
    {
        return $this->hubvendorRepository->getUser($id);
    }

    public function create(array $data)
    {        
        $result = $this->hubvendorRepository->create($data);
        return $result;
    }

    public function update(HubVendor $hub_vendor,array $data)
    {
        DB::beginTransaction();
        try {
            $result = $this->hubvendorRepository->update($hub_vendor, $data);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to update hub vendor');
        }
        DB::commit();

        return $result;
    }

    public function destroy(HubVendor $hub_vendor)
    {
        DB::beginTransaction();
        try {
            $result = $this->hubvendorRepository->destroy($hub_vendor);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to delete hub vendor');
        }
        DB::commit();
        
        return $result;
    }

    // change Status
    public function changeStatus(HubVendor $hub_vendor)
    {

        DB::beginTransaction();
        try {
            $result = $this->hubvendorRepository->changeStatus($hub_vendor);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to active hub vendor');
        }
        DB::commit();

        return $result;
    }

}