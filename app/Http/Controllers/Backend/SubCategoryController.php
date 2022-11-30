<?php

namespace App\Http\Controllers\Backend;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Services\SubCategoryService;
use App\Http\Requests\SubCategory\CreateSubCategoryRequest;
use App\Http\Requests\SubCategory\UpdateSubCategoryRequest;

class SubCategoryController extends Controller
{
    /**
     * @var categoryService
     */
    protected $subcategoryService;
    protected $categoryService;

    /**
     * AgentController constructor.
     *
     * @param categoryService $categoryService
     */
    public function __construct(SubCategoryService $subcategoryService,CategoryService $categoryService)
    {
        $this->subcategoryService = $subcategoryService;
        $this->categoryService = $categoryService;
        $this->middleware('permission:sub-category-list|sub-category-create|sub-category-edit|sub-category-delete', ['only' => ['index','show']]);
        $this->middleware('permission:sub-category-create', ['only' => ['create','store']]);
        $this->middleware('permission:sub-category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:sub-category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sub_categories = $this->subcategoryService->getSubCategories();
        
        if($request->ajax()){            
            return DataTables::of($sub_categories)
                            ->addIndexColumn()
                            ->addColumn('category', function ($sub_categories) {
                                return $sub_categories->category->name;

                            })
                            ->editColumn('is_active', function ($sub_categories) {
                                if($sub_categories->is_active == 0){
                                    return 'Inactive';
                                }else{
                                    return 'Active';
                                }
                            })
                            ->addColumn('action',function($row){
                                if($row->is_active==0){
                                    $status = '<i class="fas fa-thumbs-up"> Active</i>';
                                }else{
                                    $status = '<i class="fas fa-thumbs-down"> Inactive</i>';
                                    
                                }
                                $btn = '<a rel="tooltip" class="btn btn-success" href="'. url('admin/sub_categories/'.$row->id.'/change_status') .'"
                                data-original-title="" title="">
                                '.$status.'
                                <div class="ripple-container"></div>
                                </a> &nbsp;';
                                $btn = $btn.'<a rel="tooltip" class="btn btn-primary" href="'. url('admin/sub_categories/'.$row->id.'/edit') .'"
                                data-original-title="" title="">
                                <i class="fas fa-edit"> Edit</i>
                                <div class="ripple-container"></div>
                                </a>';
                                $btn = $btn.'<form action="'. route('sub_categories.destroy',$row->id) .'" method="POST" id="del-role-'.$row->id.'" class="d-inline">
                                <input type="hidden" name="_token" value="'.csrf_token() .'">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="button" class="btn btn-danger  destroy_btn" data-original-title="" data-origin="del-role-'.$row->id.'">
                                    <i class="fas fa-trash"> Delete</i>
                                    <div class="ripple-container"></div>
                                </button>                                                    
                                </form>';
                                
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
        return view('backend.sub_categories.index', ['sub_categories' => $sub_categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryService->getCategories();
        return view('backend.sub_categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubCategoryRequest $request)
    {
        $result = $this->subcategoryService->create($request->all());
        return redirect('admin/sub_categories')->withStatus(__('Sub Category successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $sub_category)
    {
        $categories = $this->categoryService->getCategories();
        return view('backend.sub_categories.edit',compact('categories','sub_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $sub_category)
    {
        $this->subcategoryService->update($sub_category, $request->all());
        return redirect()->route('sub_categories.index')->with('status', 'Sub Category has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $sub_category)
    {
        $this->subcategoryService->destroy($sub_category);
        return redirect()->route('categories.index')->with('status', 'Category has been deleted successfully');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(SubCategory $sub_category)
    {
        $result = $this->subcategoryService->changeStatus($sub_category);
        return redirect('admin/sub_categories')->withStatus(__('Sub Category successfully updated.'));
    }
}
