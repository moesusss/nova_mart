<?php
 
namespace App\Services;

use Exception;
use App\Models\Vendor;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\VendorServiceInterface;
use App\Repositories\Backend\VendorRepository;

class VendorService implements VendorServiceInterface
{
    protected $vendorRepository;
    protected $userService;

    public function __construct(VendorRepository $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
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
        $result = $this->vendorRepository->create($data);
        return $result;
    }

    public function update(Vendor $vendor,array $data)
    {
        // $data['updatedBy'] = $this->userService->getAuthenticatedUser()->id;

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
}