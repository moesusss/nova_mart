<?php

namespace App\Http\Controllers\api\v1\Customer;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SubCategoryService;
use App\Http\Resources\api\v1\Customer\Item\ItemResource;
use App\Http\Resources\api\v1\Customer\Item\ItemCollection;
use App\Http\Resources\api\v1\Customer\SubCategory\SubCategoryResource;
use App\Http\Resources\api\v1\Customer\SubCategory\SubCategoryCollection;

class SubCategoryController extends Controller
{
 /**
     * @var SubCategoryService
     */
    protected $subCategoryService;

    /**
     * SubCategoryController constructor.
     *
     * @param SubCategoryService $subCategoryService
     */
    public function __construct(SubCategoryService $subCategoryService)
    {
        $this->subCategoryService = $subCategoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = request()->all();
        $limit = (request()->has('item_limit') && $request['item_limit']) ? $request['item_limit'] : 5;
        $items = $this->subCategoryService->getSubCategoriesWithItems();
        return response()->json([
            'status' => true, 
            'data' => ItemResource::collection($items->load(['images']))
                        ->groupBy(function ($q) {
                        return  $q->sub_category->name;
                        })->map(function ($q1) use ($limit) {
                                return $q1->take($limit);
                        })
        ]);
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        return new SubCategoryResource($subCategory->load(['category']));
    }

    
}
