<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainService\CreateMainServiceRequest;
use App\Http\Requests\MainService\UpdateMainServiceRequest;
use App\Models\MainService;
use App\Services\MainServiceService;

class MainServiceController extends Controller
{
    protected $mainserviceService;

    public function __construct(MainServiceService $mainserviceService)
    {
        $this->mainserviceService = $mainserviceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $main_services = $this->mainserviceService->getMainServices();
        if($request->ajax()){            
            return DataTables::of($main_services)
                            ->addIndexColumn()
                            ->addColumn('action',function($row){
                                $btn ='<a rel="tooltip" class="btn btn-success" href="'. route('main_services.edit', $row->id) .'"
                                data-original-title="" title="">
                                <i class="fas fa-edit"> Edit</i>
                                <div class="ripple-container"></div>
                                </a>';
                                $btn = $btn.'<form action="'. route('main_services.destroy',$row->id) .'" method="POST" id="del-role-'.$row->id.'" class="d-inline">
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
        return view('backend.main_services.index',compact('main_services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.main_services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMainServiceRequest $request)
    {
        $result = $this->mainserviceService->create($request->all());
        return redirect('admin/main_services')->withStatus(__('Main service successfully created.'));
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
    public function edit(MainService $main_service)
    {
        $artist_types = $this->mainserviceService->getMainService($main_service);
        return view('backend.main_services.edit',compact('main_service'));
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMainServiceRequest $request,MainService $main_service)
    {
        $result = $this->mainserviceService->update($main_service, $request->all());
        return redirect('admin/main_services')->withStatus(__('Main service successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainService $main_service)
    {
        $result = $this->mainserviceService->destroy($main_service);
        return redirect('admin/main_services')->withStatus(__('Main service successfully deleted.'));
    }
}
