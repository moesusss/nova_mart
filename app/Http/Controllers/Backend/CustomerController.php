<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Services\CustomerService;
use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService=$customerService;
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:customer-create', ['only' => ['create','store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = $this->customerService->getCustomers($request);
        if($request->ajax()){            
            return DataTables::of($customers)
                            ->addIndexColumn()
                            ->editColumn('is_active', function ($customers) {
                                if($customers->is_active == 0){
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
                                $btn = '<a rel="tooltip" class="btn btn-success" href="'. url('admin/customers/'.$row->id.'/change_status') .'"
                                data-original-title="" title="">
                                '.$status.'
                                <div class="ripple-container"></div>
                                </a> &nbsp;';
                                $btn = $btn.'<a rel="tooltip" class="btn btn-warning" href="'. url('admin/customers/'.$row->id.'/') .'"
                                data-original-title="" title="" style="color:#FFF">
                                <i class="fas fa-eye"> View</i>
                                <div class="ripple-container"></div>
                                </a> &nbsp;';
                                $btn = $btn.'<a rel="tooltip" class="btn btn-primary" href="'. url('admin/customers/'.$row->id.'/edit') .'"
                                data-original-title="" title="">
                                <i class="fas fa-edit"> Edit</i>
                                <div class="ripple-container"></div>
                                </a>';
                                // $btn = $btn.'<form action="'. route('customers.destroy',$row->id) .'" method="POST" id="del-role-'.$row->id.'" class="d-inline">
                                // <input type="hidden" name="_token" value="'.csrf_token() .'">
                                // <input type="hidden" name="_method" value="DELETE">
                                // <button type="button" class="btn btn-danger  destroy_btn" data-original-title="" data-origin="del-role-'.$row->id.'">
                                //     <i class="fas fa-trash"> Delete</i>
                                //     <div class="ripple-container"></div>
                                // </button>                                                    
                                // </form>';
                                
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
        return view('backend.customers.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('backend.customers.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Change the active status for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Customer $customer)
    {
        $result = $this->customerService->changeStatus($customer);
        return redirect('admin/customers')->withStatus(__('Customer successfully updated.'));
    }
}
