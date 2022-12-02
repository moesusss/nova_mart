<?php

namespace App\Http\Controllers\api\v1\Customer;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\Customer\Category\CategoryResource;
use App\Http\Resources\api\v1\Customer\Category\CategoryCollection;

class CategoryController extends Controller
{
 /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * CategoryController constructor.
     *
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request['is_active'] = true;
        $categorys = $this->categoryService->getCategories();
        return new CategoryCollection($categorys);
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category->load(['main_service','sub_categories']));
    }

    
}
