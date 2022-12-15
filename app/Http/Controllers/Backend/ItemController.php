<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Services\ItemService;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\CreateItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Http\Resources\api\v1\Customer\Item\ItemCollection;
use App\Models\Item;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\LookUpService;
use App\Services\SubCategoryService;
use App\Services\VendorService;

class ItemController extends Controller
{
    protected $itemService;
    protected $vendorService;
    protected $categoryService;
    protected $subCategoryService;
    protected $brandService;
    protected $lookupService;

    public function __construct(ItemService $itemService,VendorService $vendorService,CategoryService $categoryService,SubCategoryService $subCategoryService, BrandService $brandService, LookUpService $lookupService )
    {
        $this->itemService = $itemService;
        $this->vendorService = $vendorService;
        $this->categoryService = $categoryService;
        $this->subCategoryService = $subCategoryService;
        $this->brandService = $brandService;
        $this->lookupService = $lookupService;
        $this->middleware('permission:item-list|item-create|item-edit|item-delete', ['only' => ['index','store']]);
        $this->middleware('permission:item-create', ['only' => ['create','store']]);
        $this->middleware('permission:item-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:item-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = $this->itemService->getItems($request);
        if($request->ajax()){            
            return DataTables::of($items)
                            ->addIndexColumn()
                            ->addColumn('sub_category', function ($items) {
                                return $items->sub_category->name;

                            })
                            ->editColumn('is_active', function ($items) {
                                if($items->is_active == 0){
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
                                $btn = '<a rel="tooltip" class="btn btn-success" href="'. url('admin/items/'.$row->id.'/change_status') .'"
                                data-original-title="" title="">
                                '.$status.'
                                <div class="ripple-container"></div>
                                </a> &nbsp;';

                                $btn = $btn.'<a rel="tooltip" class="btn btn-warning" href="'. url('admin/items/'.$row->id.'/') .'"
                                data-original-title="" title="" style="color:#FFF">
                                <i class="fas fa-eye"> View</i>
                                <div class="ripple-container"></div>
                                </a> &nbsp;';
                                
                                $btn = $btn. '<a rel="tooltip" class="btn btn-primary" href="'. url('admin/items/'.$row->id.'/edit') .'"
                                data-original-title="" title="">
                                <i class="fas fa-edit"> Edit</i>
                                <div class="ripple-container"></div>
                                </a>';
                                $btn = $btn.'<form action="'. route('items.destroy',$row->id) .'" method="POST" id="del-role-'.$row->id.'" class="d-inline">
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
        return view('backend.items.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = $this->vendorService->getVendors();
        $categories = $this->categoryService->getCategories();
        $item_types = $this->lookupService->getLookupByType('item_type');
        $unit_types = $this->lookupService->getLookupByType('unit_type');
        return view('backend.items.create',compact('vendors','categories','item_types','unit_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->itemService->create($request->all());
        return redirect()->route('items.index')->with('status', 'Item has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('backend.items.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $vendors = $this->vendorService->getVendors();
        $categories = $this->categoryService->getCategories();
        $item_types = $this->lookupService->getLookupByType('item_type');
        $unit_types = $this->lookupService->getLookupByType('unit_type');
        $sub_categories = $this->subCategoryService->getDataByCategoryID($item->category_id);
        $brands = $this->brandService->getDataBySubCategoryID($item->sub_category_id);
        return view('backend.items.edit',compact('vendors','categories','item_types','unit_types','item','sub_categories','brands'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $this->itemService->update($item, $request->all());
        return redirect()->route('items.index')->with('status', 'Item has been updated successfully');
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
    public function changeStatus(Item $item)
    {
        $result = $this->itemService->changeStatus($item);
        return redirect('admin/items')->withStatus(__('Item successfully updated.'));
    }

    public function getDataByVendorID($id){
        $result = $this->itemService->getDataByVendorID($id);
        return new ItemCollection($result);
    }
}
