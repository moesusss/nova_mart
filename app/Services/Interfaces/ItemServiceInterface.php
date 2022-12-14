<?php

namespace App\Services\Interfaces;

use App\Models\Item;

interface ItemServiceInterface
{
    public function getItems();
    public function getRelatedItems($item);
    public function getItem($id);
    public function create(array $data);
    public function update(Item $item,array $data);
    public function destroy(Item $item);
    
}