<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Services\UserService;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $vendorService;

    /**
     * AgentController constructor.
     *
     * @param UserService $vendorService
     */
    public function __construct(UserService $vendorService)
    {
        $this->vendorService = $vendorService;
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
        $vendors = $this->vendorService->getUsers($request);
        if($request->ajax()){            
            return DataTables::of($vendors)
                            ->addIndexColumn()
                            ->addColumn('action',function($row){
                                if($row->is_active==0){
                                    $status = '<i class="fas fa-thumbs-up"> Active</i>';
                                }else{
                                    $status = '<i class="fas fa-thumbs-down"> Inactive</i>';
                                    
                                }
                                
                                $btn = '<a rel="tooltip" class="btn btn-primary" href="'. url('admin/vendors/'.$row->id.'/edit') .'"
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
        $roles = $this->roleService->getRolesPluckName();
        return view('backend.vendors.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $this->vendorService->create($request->all());
        return redirect()->route('vendors.index')->with('status', 'User has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $vendor)
    {
        $roles = $this->roleService->getRolesPluckName();
        $vendorRole = $this->vendorService->getUserRolesPluckName($vendor);
        return view('backend.vendors.show',compact('user','roles','userRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $vendor)
    {
        $roles = $this->roleService->getRolesPluckName();
        $vendorRole = $this->vendorService->getUserRolesPluckName($vendor);
        return view('backend.vendors.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $vendor)
    {
        $this->vendorService->update($vendor, $request->all());
        return redirect()->route('vendors.index')->with('status', 'User has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $vendor)
    {
        $this->vendorService->destroy($vendor);
        return redirect()->route('vendors.index')->with('status', 'User has been deleted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(User $vendor)
    {
        $result = $this->vendorService->changeStatus($vendor);
        return redirect('admin/vendors')->withStatus(__('User successfully updated.'));
    }
}
