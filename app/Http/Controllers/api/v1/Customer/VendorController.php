<?php

namespace App\Http\Controllers\api\v1\Customer;

use App\Models\Item;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Services\ItemService;
use Illuminate\Http\Response;
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
    protected $itemService;

    /**
     * VendorController constructor.
     *
     * @param VendorService $vendorService
     */
    public function __construct(VendorService $vendorService,ItemService $itemService)
    {
        $this->vendorService = $vendorService;
        $this->itemService = $itemService;
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
        $categories = $this->itemService->getCategoryByVendor($vendor->id);
        $best_sellers = $this->itemService->getBestSellerItems($vendor->id);
        $best_deals = $this->itemService->getBestDealItems($vendor->id);
        $new_arrivals = $this->itemService->getNewItems($vendor->id);
       
        return response()->json([
                'status'=>true,
                'data' => new VendorResource($vendor->load([])),
                'categories' => $categories,
                'best_sellers' => $best_sellers,
                'best_deals' => $best_deals,
                'new_arrivals' => $new_arrivals,
            
            ],Response::HTTP_OK);
        return new VendorResource($vendor->load([]));
    }

    
}
