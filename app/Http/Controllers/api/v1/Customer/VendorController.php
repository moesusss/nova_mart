<?php

namespace App\Http\Controllers\api\v1\Customer;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Services\VendorService;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\Customer\Vendor\VendorResource;
use App\Http\Resources\api\v1\Customer\Vendor\VendorCollection;

class VendorController extends Controller
{
 /**
     * @var VendorService
     */
    protected $vendorService;

    /**
     * VendorController constructor.
     *
     * @param VendorService $vendorService
     */
    public function __construct(VendorService $vendorService)
    {
        $this->vendorService = $vendorService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request['is_active'] = true;
        $vendors = $this->vendorService->getVendors();
        return new VendorCollection($vendors);
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return new VendorResource($vendor->load([]));
    }

    
}
