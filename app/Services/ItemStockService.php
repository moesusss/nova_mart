<?php

namespace App\Services;

use Exception;
use App\Models\Brand;
use App\Repositories\Backend\ItemRepository;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Backend\ItemStockRepository;
use App\Services\Interfaces\ItemStockServiceInterface;

class ItemStockService implements ItemStockServiceInterface
{
    protected $itemstockRepository;
    protected $itemRepository;

    public function __construct(ItemStockRepository $itemstockRepository,ItemRepository $itemRepository)
    {
        $this->itemstockRepository = $itemstockRepository;
        $this->itemRepository = $itemRepository;
    }

    public function getItemStocks()
    {
        return $this->itemstockRepository->orderBy('created_at','desc')->get();
        
    }

    public function getItemStock($id)
    {
        return $this->itemstockRepository->getCategory($id);
    }

    public function create(array $data)
    {   
        $stock = $this->itemstockRepository->create($data);
        $item = $this->itemRepository->getItem($data['item_id']);
        $data['qty'] = $item->qty + $data['qty'];
        $data['is_instock']= true;
        $result = $this->itemRepository->update($item,$data);

        return $result;
    }

}