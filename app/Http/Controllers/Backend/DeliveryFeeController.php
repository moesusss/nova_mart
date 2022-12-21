<?php

namespace App\Http\Controllers\Backend;

use App\Models\DeliveryFee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Services\DeliveryFeeService;
use App\Http\Requests\DeliveryFee\CreateDeliveryFeeRequest;
use App\Http\Requests\DeliveryFee\UpdateDeliveryFeeRequest;

class DeliveryFeeController extends Controller
{
    protected $deliveryfeeService;

    public function __construct(DeliveryFeeService $deliveryfeeService)
    {
        $this->deliveryfeeService = $deliveryfeeService;
        $this->middleware('permission:delivery-fee-list|delivery-fee-create|delivery-fee-edit|delivery-fee-delete', ['only' => ['index','store']]);
        $this->middleware('permission:delivery-fee-create', ['only' => ['create','store']]);
        $this->middleware('permission:delivery-fee-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:delivery-fee-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $delivery_fees = $this->deliveryfeeService->getDeliveryFees();
        if($request->ajax()){            
            return DataTables::of($delivery_fees)
                            ->addIndexColumn()
                            ->addColumn('action',function($row){
                                $btn = '<a rel="tooltip" class="btn btn-primary" href="'. url('admin/delivery_fees/'.$row->id.'/edit') .'"
                                data-original-title="" title="">
                                <i class="fas fa-edit"> Edit</i>
                                <div class="ripple-container"></div>
                                </a>';
                                $btn = $btn.'<form action="'. route('delivery_fees.destroy',$row->id) .'" method="POST" id="del-main-service-'.$row->id.'" class="d-inline">
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
        return view('backend.delivery_fees.index',compact('delivery_fees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.delivery_fees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDeliveryFeeRequest $request)
    {
        $result = $this->deliveryfeeService->create($request->all());
        return redirect('admin/delivery_fees')->withStatus(__('Delivery Fees successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryFee $delivery_fee)
    {
        // $artist_types = $this->deliveryfeeService->getDeliveryFee($delivery_fee);
        return view('backend.delivery_fees.edit',compact('delivery_fee'));
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliveryFeeRequest $request,DeliveryFee $delivery_fee)
    {
        $result = $this->deliveryfeeService->update($delivery_fee, $request->all());
        return redirect('admin/delivery_fees')->withStatus(__('Delivery Fee successfully updated.'));
    }
}
