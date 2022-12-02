<?php

namespace App\Http\Controllers\api\v1\Customer;

use App\Models\MainService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MainServiceService;
use App\Http\Resources\api\v1\Customer\MainService\MainServiceResource;
use App\Http\Resources\api\v1\Customer\MainService\MainServiceCollection;

class MainServiceController extends Controller
{
 /**
     * @var MainServiceService
     */
    protected $mainServiceService;

    /**
     * MainServiceController constructor.
     *
     * @param MainServiceService $mainServiceService
     */
    public function __construct(MainServiceService $mainServiceService)
    {
        $this->mainServiceService = $mainServiceService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request['is_active'] = true;
        $mainServices = $this->mainServiceService->getMainServices();
        return new MainServiceCollection($mainServices);
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MainService $mainService)
    {
        return new MainServiceResource($mainService->load(['categories']));
    }

    
}
