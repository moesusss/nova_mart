<?php

namespace App\Repositories\Backend;

use App\Models\StockItem;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class StockItemRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return StockItem::class;
    }

    public function getStocks()
    {
        $stocks = StockItem::with(['item'])
                        ->filter(request()->all())
                        ->orderBy('id','desc');
         if (request()->has('paginate')) {
            $stocks = $stocks->paginate(request()->get('paginate'));
        } else {
            $stocks = $stocks->get();
        }
        return $stocks;
    }

    public function findbyValue($field,$value)
    {
        $data = StockItem::where($field,$value)->get();
        return $data;
    }
    /**
     * @param array $data
     *
     * @return StockItem
     */
    public function create(array $data) : StockItem
    {
        $stock = StockItem::create([
            'item_id'              => $data['item_id'],
            'qty'              => $data['qty'],
            'created_by'           => auth()->user()->id
        ]);
        return $stock;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function update(StockItem $stock, array $data) : StockItem
    {
        $stock->item_id = isset($data['item_id']) ? $data['item_id'] : $stock->item_id ;
        $stock->qty = isset($data['qty']) ? $data['qty']: $stock->qty;
        $stock->created_by = isset($data['created_by']) ?  auth()->user()->id : $stock->created_by;

        if ($stock->isDirty()) {
            $stock->save();
        }

        return $stock->refresh();
    }

    /**
     * @param StockItem $stock
     */
    public function destroy(StockItem $stock)
    {
        $deleted = $this->deleteById($stock->id);

        if ($deleted) {
            $stock->save();
        }
    }

    /**
     * @param StockItem  $stock
     * @param array $data
     *
     * @return mixed
     */
    public function changeStatus(StockItem $stock)
    {
       if($stock->is_active==0){
            $stock->is_active=1;
       }else{
            $stock->is_active=0;
       }
       if($stock->isDirty()){
           $stock->save();
       }
       return $stock->refresh();
    }
}
