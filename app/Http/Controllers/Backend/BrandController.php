<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Services\BrandService;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\CreateBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Http\Resources\api\v1\Customer\Brand\BrandCollection;
use App\Services\SubCategoryService;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * @var brandService
     */
    protected $brandService;
    protected $subcategoryService;
   

    /**
     * AgentController constructor.
     *
     * @param categoryService $categoryService
     */
    public function __construct(BrandService $brandService,SubCategoryService $subcategoryService)
    {
        $this->brandService = $brandService;
        $this->subcategoryService = $subcategoryService;
        $this->middleware('permission:brand-list|brand-create|brand-edit|brand-delete', ['only' => ['index','show']]);
        $this->middleware('permission:brand-create', ['only' => ['create','store']]);
        $this->middleware('permission:brand-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = $this->brandService->getBrands();
        
        
        if($request->ajax()){            
            return DataTables::of($brands)
                            ->addIndexColumn()
                            ->addColumn('sub_category', function ($brands) {
                                return $brands->sub_category->name;

                            })
                            ->editColumn('is_active', function ($brands) {
                                if($brands->is_active == 0){
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
                                $btn = '<a rel="tooltip" class="btn btn-success" href="'. url('admin/brands/'.$row->id.'/change_status') .'"
                                data-original-title="" title="">
                                '.$status.'
                                <div class="ripple-container"></div>
                                </a> &nbsp;';
                                $btn = $btn.'<a rel="tooltip" class="btn btn-primary" href="'. url('admin/brands/'.$row->id.'/edit') .'"
                                data-original-title="" title="">
                                <i class="fas fa-edit"> Edit</i>
                                <div class="ripple-container"></div>
                                </a>';
                                $btn = $btn.'<form action="'. route('brands.destroy',$row->id) .'" method="POST" id="del-role-'.$row->id.'" class="d-inline">
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
        return view('backend.brands.index', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_categories = $this->subcategoryService->getSubCategories();
        return view('backend.brands.create',compact('sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBrandRequest $request)
    {
        $result = $this->brandService->create($request->all());
        return redirect('admin/brands')->withStatus(__('Brand successfully created.'));
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
    public function edit(Brand $brand)
    {
        $sub_categories = $this->subcategoryService->getSubCategories();
        return view('backend.brands.edit',compact('sub_categories','brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $this->brandService->update($brand, $request->all());
        return redirect()->route('brands.index')->with('status', 'Brand has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $this->brandService->destroy($brand);
        return redirect()->route('brands.index')->with('status', 'Brand has been deleted successfully');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Brand $brand)
    {
        $result = $this->brandService->changeStatus($brand);
        return redirect('admin/brands')->withStatus(__('Brand successfully updated.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDataBySubCategoryID($id)
    {
        $result = $this->brandService->getDataBySubCategoryID($id);
        return new BrandCollection($result);
    }
}
