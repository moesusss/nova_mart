<?php

namespace App\Http\Controllers\api\v1\Customer;

use App\Models\Item;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Services\ItemService;
use Illuminate\Http\Response;
use App\Services\VendorService;
use App\Http\Controllers\Controller;
use App\Services\SubCategoryService;
use App\Http\Resources\api\v1\Customer\Item\ItemResource;
use App\Http\Resources\api\v1\Customer\Item\ItemCollection;
use App\Http\Resources\api\v1\Customer\Vendor\VendorResource;
use App\Http\Resources\api\v1\Customer\Vendor\VendorCollection;
use App\Http\Resources\api\v1\Customer\Category\CategoryCollection;

class VendorController extends Controller
{
 /**
     * @var VendorService
     */
    protected $vendorService;
    protected $itemService;
    protected $subCategoryService;

    /**
     * VendorController constructor.
     *
     * @param VendorService $vendorService
     */
    public function __construct(VendorService $vendorService,
                                ItemService $itemService,
                                SubCategoryService $subCategoryService
                            )
    {
        $this->vendorService = $vendorService;
        $this->itemService = $itemService;
        $this->subCategoryService = $subCategoryService;
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
    public function show(Vendor $vendor, Request $request)
    {
        $request['vendor_id'] = $vendor->id;
        $request['orderBy'] = 'created_at';
        $request['sortBy'] = 'desc';
        $categories = $this->itemService->getCategoryByVendor($vendor->id);
        $best_sellers = $this->itemService->getItems($request['item_type'] = 'best_sellers');
        $best_deals = $this->itemService->getItems($request['item_type'] = 'special_deals');
        $new_arrivals = $this->itemService->getItems($request);

        $items = $this->subCategoryService->getSubCategoriesWithHighlightItems($vendor);

        $hilighted_items = ItemResource::collection($items->load(['images']))
                        ->groupBy(function ($q) {
                        return  $q->sub_category->name;
                        })->map(function ($q1) {
                                return $q1->take(7);
                        });
       
        return response()->json([
                'status'=>true,
                'data' => new VendorResource($vendor->load([])),
                'categories' => new CategoryCollection($categories),
                'best_sellers' =>  new ItemCollection($best_sellers),
                'best_deals' =>  new ItemCollection($best_deals),
                'new_arrivals' =>  new ItemCollection($new_arrivals),
                'highlighted_items' =>  $hilighted_items,
            
            ],Response::HTTP_OK);
        // return new VendorResource($vendor->load([]));
    }

    
}
