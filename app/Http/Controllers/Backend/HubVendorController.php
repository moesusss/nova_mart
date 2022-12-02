<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\HubVendor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Services\HubVendorService;
use App\Http\Controllers\Controller;
use App\Services\MainServiceService;
use App\Http\Requests\HubVendor\CreateHubVendorRequest;
use App\Http\Requests\HubVendor\UpdateHubVendorRequest;

class HubVendorController extends Controller
{
    /**
     * @var HubVendorService
     */
    protected $hubvendorService;
    protected $mainService;

    /**
     * AgentController constructor.
     *
     * @param HubVendorService $hubvendorService
     */
    public function __construct(HubVendorService $hubvendorService,MainServiceService $mainService)
    {
        $this->hubvendorService = $hubvendorService;
        $this->mainService = $mainService;
        $this->middleware('permission:hub-vendor-list|hub-vendor-create|hub-vendor-edit|hub-vendor-delete', ['only' => ['index','show']]);
        $this->middleware('permission:hub-vendor-create', ['only' => ['create','store']]);
        $this->middleware('permission:hub-vendor-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:hub-vendor-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hub_vendors = $this->hubvendorService->getHubVendors($request);
        if($request->ajax()){            
            return DataTables::of($hub_vendors)
                            ->addIndexColumn()
                            ->addColumn('main_service', function ($hub_vendors) {
                                return $hub_vendors->main_service->name;

                            })
                            ->editColumn('is_active', function ($hub_vendors) {
                                if($hub_vendors->is_active == 0){
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
                                $btn = '<a rel="tooltip" class="btn btn-success" href="'. url('admin/hub_vendors/'.$row->id.'/change_status') .'"
                                data-original-title="" title="">
                                '.$status.'
                                <div class="ripple-container"></div>
                                </a> &nbsp;';
                                $btn = $btn.'<a rel="tooltip" class="btn btn-primary" href="'. url('admin/hub_vendors/'.$row->id.'/edit') .'"
                                data-original-title="" title="">
                                <i class="fas fa-edit"> Edit</i>
                                <div class="ripple-container"></div>
                                </a>';
                                $btn = $btn.'<form action="'. route('hub_vendors.destroy',$row->id) .'" method="POST" id="del-role-'.$row->id.'" class="d-inline">
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
        return view('backend.hub_vendors.index', ['hub_vendors' => $hub_vendors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_services = $this->mainService->getMainServices();
        return view('backend.hub_vendors.create',compact('main_services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateHubVendorRequest $request)
    {
        $this->hubvendorService->create($request->all());
        return redirect()->route('hub_vendors.index')->with('status', 'Hub Vendor has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(HubVendor $hub_vendor)
    {
        // $roles = $this->roleService->getRolesPluckName();
        // return view('backend.vendors.show',compact('user','roles','userRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(HubVendor $hub_vendor)
    {
        $main_services = $this->mainService->getMainServices();
        return view('backend.hub_vendors.edit',compact('hub_vendor','main_services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHubVendorRequest $request, HubVendor $hub_vendor)
    {
        $this->hubvendorService->update($hub_vendor, $request->all());
        return redirect()->route('hub_vendors.index')->with('status', 'Hub vendor has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(HubVendor $hub_vendor)
    {
        $this->hubvendorService->destroy($hub_vendor);
        return redirect()->route('hub_vendors.index')->with('status', 'Hub vendor has been deleted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(HubVendor $hub_vendor)
    {
        $result = $this->hubvendorService->changeStatus($hub_vendor);
        return redirect('admin/hub_vendors')->withStatus(__('Hub vendor successfully updated.'));
    }
}
