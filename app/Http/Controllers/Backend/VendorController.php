<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Services\VendorService;
use Yajra\DataTables\DataTables;
use App\Services\HubVendorService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\Vendor\CreateVendorRequest;
use App\Http\Requests\Vendor\UpdateVendorRequest;
use App\Services\SubCategoryService;

class VendorController extends Controller
{
    /**
     * @var VendorService
     */
    protected $vendorService;
    protected $hubvendorService;
    protected $subcategoryService;

    /**
     * AgentController constructor.
     *
     * @param VendorService $vendorService
     */
    public function __construct(VendorService $vendorService,HubVendorService $hubvendorService, SubCategoryService $subcategoryService)
    {
        $this->vendorService = $vendorService;
        $this->hubvendorService = $hubvendorService;
        $this->subcategoryService = $subcategoryService;
        $this->middleware('permission:vendor-list|vendor-create|vendor-edit|vendor-delete', ['only' => ['index','show']]);
        $this->middleware('permission:vendor-create', ['only' => ['create','store']]);
        $this->middleware('permission:vendor-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:vendor-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vendors = $this->vendorService->getVendors($request);
        if($request->ajax()){            
            return DataTables::of($vendors)
                            ->addIndexColumn()
                            ->addColumn('hub_vendor', function ($vendors) {
                                return $vendors->hub_vendor->name;

                            })
                            ->editColumn('is_active', function ($vendors) {
                                if($vendors->is_active == 0){
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
                                if($row->is_active==0){
                                    $status = '<i class="fas fa-thumbs-up"> Active</i>';
                                }else{
                                    $status = '<i class="fas fa-thumbs-down"> Inactive</i>';
                                    
                                }
                                $btn = '<a rel="tooltip" class="btn btn-success" href="'. url('admin/vendors/'.$row->id.'/change_status') .'"
                                data-original-title="" title="">
                                '.$status.'
                                <div class="ripple-container"></div>
                                </a> &nbsp;';

                                $btn = $btn.'<a rel="tooltip" class="btn btn-warning" href="'. url('admin/vendors/'.$row->id.'/') .'"
                                data-original-title="" title="" style="color:#FFF">
                                <i class="fas fa-eye"> View</i>
                                <div class="ripple-container"></div>
                                </a> &nbsp;';
                                
                                $btn = $btn. '<a rel="tooltip" class="btn btn-primary" href="'. url('admin/vendors/'.$row->id.'/edit') .'"
                                data-original-title="" title="">
                                <i class="fas fa-edit"> Edit</i>
                                <div class="ripple-container"></div>
                                </a>';
                                $btn = $btn.'<form action="'. route('vendors.destroy',$row->id) .'" method="POST" id="del-role-'.$row->id.'" class="d-inline">
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
        return view('backend.vendors.index', ['vendors' => $vendors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hub_vendors = $this->hubvendorService->getHubVendors();
        $sub_categories = $this->subcategoryService->getSubCategories();
        return view('backend.vendors.create',compact('hub_vendors','sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVendorRequest $request)
    {
        
        $this->vendorService->create($request->all());
        return redirect()->route('vendors.index')->with('status', 'Vendor has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        $hub_vendors = $this->hubvendorService->getHubVendors();
        return view('backend.vendors.show',compact('vendor','hub_vendors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        $sub_categories = $this->subcategoryService->getSubCategories();
        $hub_vendors = $this->hubvendorService->getHubVendors();
        return view('backend.vendors.edit',compact('vendor','hub_vendors','sub_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        $this->vendorService->update($vendor, $request->all());
        return redirect()->route('vendors.index')->with('status', 'Vendor has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $this->vendorService->destroy($vendor);
        return redirect()->route('vendors.index')->with('status', 'Vendor has been deleted successfully');
    }

    /**
     * Change the active status for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Vendor $vendor)
    {
        $result = $this->vendorService->changeStatus($vendor);
        return redirect('admin/vendors')->withStatus(__('Vendor successfully updated.'));
    }
}
