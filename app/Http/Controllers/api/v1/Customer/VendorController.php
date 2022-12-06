<?php

namespace App\Http\Controllers\api\v1\Customer;

use App\Models\Item;
use App\Models\Vendor;
use Illuminate\Http\Request;
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
        $category = Item::where('vendor_id',$vendor->id)
                    ->join('categories', 'categories.id', '=', 'items.category_id')
                     ->selectRaw("
                      categories.id as cat_id,
                      categories.name as category_name
                      ")
                ->groupBy('cat_id')
                ->get();
        $special_items = Item::where('vendor_id',$vendor->id)
                            ->where('item_type','best_deal')->get();
        $best_items = Item::where('vendor_id',$vendor->id)
                            ->where('item_type','best_seller')->get();
        return response()->json([
            'categories'=> $category,
            'special_items'=> $special_items,
            'best_items'=> $best_items,
                'status'=>true,
                'data' => new VendorResource($vendor->load([]))
            
            ],Response::HTTP_OK);
        return new VendorResource($vendor->load([]));
    }

    
}
