<?php

namespace App\Http\Controllers\api\v1\Customer;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Services\ItemService;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\Customer\Item\ItemResource;
use App\Http\Resources\api\v1\Customer\Item\ItemCollection;
use App\Http\Resources\api\v1\Customer\RelatedItem\RelatedItemCollection;

class ItemController extends Controller
{
 /**
     * @var ItemService
     */
    protected $itemService;

    /**
     * ItemController constructor.
     *
     * @param ItemService $itemService
     */
    public function __construct(ItemService $itemService)
    {
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
        $items = $this->itemService->getItems();
        return new ItemCollection($items);
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item, Request $request)
    {
        $related_items = $this->itemService->getRelatedItems($item);
         return response()->json([
                'status'=>true,
                'message'=>'Success',
                'data' => new ItemResource($item->load(['images'])),
                'related_items' => new RelatedItemCollection($related_items->load(['images'])),
            
            ],Response::HTTP_OK);
    }

    
}
