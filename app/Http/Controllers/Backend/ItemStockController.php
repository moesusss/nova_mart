<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Services\ItemStockService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemStock\CreateItemStockRequest;
use App\Services\ItemService;
use App\Services\VendorService;

class ItemStockController extends Controller
{
    protected $itemstockService;
    protected $itemService;
    protected $vendorService;

    public function __construct(ItemStockService $itemstockService,ItemService $itemService,VendorService $vendorService)
    {
        $this->itemstockService=$itemstockService;
        $this->itemService=$itemService;
        $this->vendorService=$vendorService;
        $this->middleware('permission:stock-list|stock-create', ['only' => ['index','store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stock = $this->itemstockService->getItemStocks($request);
        if($request->ajax()){        
            return DataTables::of($stock)
                            ->addIndexColumn()
                            ->addColumn('item_name', function ($stock) {
                                return $stock->item->name;

                            })->addColumn('created_by', function ($stock) {
                                return $stock->item->name;

                            })
                            ->make(true);
        }
        return view('backend.item_stocks.index', ['stocks' => $stock]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items= $this->itemService->getItems();
        $vendors = $this->vendorService->getVendors();
        return view('backend.item_stocks.create',['items'=>$items,'vendors'=>$vendors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateItemStockRequest $request)
    {
        $this->itemstockService->create($request->all());
       
        return redirect()->route('item_stocks.index')->with('status', 'Stock has been added successfully');
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
}
