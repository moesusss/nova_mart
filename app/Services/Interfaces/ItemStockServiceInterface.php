<?php

namespace App\Services\Interfaces;

use App\Models\ItemStock;

interface ItemStockServiceInterface
{
    public function getItemStocks();
    public function getItemStock($id);
    public function create(array $data);
    
}