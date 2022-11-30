<?php

namespace App\Http\Controllers\api\v1\Customer;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Services\SubCategoryService;
use App\Http\Controllers\Controller;
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
        $subCategorys = $this->subCategoryService->getSubCategories();
        return new SubCategoryCollection($subCategorys);
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
