<?php
 
namespace App\Services;

use Exception;
use App\Models\Vendor;
use App\Repositories\Backend\HubVendorRepository;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\VendorServiceInterface;
use App\Repositories\Backend\VendorRepository;

class VendorService implements VendorServiceInterface
{
    protected $vendorRepository;
    protected $userService;
    protected $hubvendorRepository;

    public function __construct(VendorRepository $vendorRepository,HubVendorRepository $hubvendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
        $this->hubvendorRepository = $hubvendorRepository;
    }

    public function getVendors()
    {
        if( request()->is('api/*')){
            return $this->vendorRepository->getVendors();
        }
        return $this->vendorRepository->orderBy('created_at','desc')->get();
    }

    public function getVendor($id)
    {
        return $this->vendorRepository->getVendor($id);
    }

    public function create(array $data)
    {   
        $hub_vendor= $this->hubvendorRepository->getHubVendor($data['hub_vendor_id']);
        $data['main_service_id'] = $hub_vendor->main_service_id;
        $result = $this->vendorRepository->create($data);
        return $result;
    }

    public function update(Vendor $vendor,array $data)
    {
        $hub_vendor= $this->hubvendorRepository->getHubVendor($data['hub_vendor_id']);
        $data['main_service_id'] = $hub_vendor->main_service_id;

        DB::beginTransaction();
        try {
            $result = $this->vendorRepository->update($vendor, $data);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to update vendor');
        }
        DB::commit();

        return $result;
    }

    public function destroy(Vendor $vendor)
    {
        DB::beginTransaction();
        try {
            $result = $this->vendorRepository->destroy($vendor);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to delete vendor');
        }
        DB::commit();
        
        return $result;
    }

    // change Status
    public function changeStatus(Vendor $hub_vendor)
    {

        DB::beginTransaction();
        try {
            $result = $this->vendorRepository->changeStatus($hub_vendor);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to active vendor');
        }
        DB::commit();

        return $result;
    }
}