<?php

namespace App\Repositories\Backend;

use App\Models\ItemStock;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class ItemStockRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return ItemStock::class;
    }

    public function getStocks()
    {
        $stocks = ItemStock::filter(request()->all())
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
        $data = ItemStock::where($field,$value)->get();
        return $data;
    }
    /**
     * @param array $data
     *
     * @return ItemStock
     */
    public function create(array $data) : ItemStock
    {
        $stock = ItemStock::create([
            'item_id'               => $data['item_id'],
            'vendor_id'             => $data['vendor_id'],
            'qty'                   => $data['qty'],
            'created_by'            => auth()->user()->id
        ]);
        return $stock;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function update(ItemStock $stock, array $data) : ItemStock
    {
        $stock->item_id = isset($data['item_id']) ? $data['item_id'] : $stock->item_id ;
        $stock->vendor_id = isset($data['vendor_id']) ? $data['vendor_id'] : $stock->vendor_id ;
        $stock->qty = isset($data['qty']) ? $data['qty']: $stock->qty;
        $stock->updated_by_id = isset($data['updated_by_id']) ?  auth()->user()->id : $stock->updated_by_id;

        if ($stock->isDirty()) {
            $stock->save();
        }

        return $stock->refresh();
    }

    /**
     * @param ItemStock $stock
     */
    public function destroy(ItemStock $stock)
    {
       
    }

}
