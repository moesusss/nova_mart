<?php
 
namespace App\Services;

use Exception;
use App\Models\Item;
use App\Repositories\Backend\HubItemRepository;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\ItemServiceInterface;
use App\Repositories\Backend\ItemRepository;

class ItemService implements ItemServiceInterface
{
    protected $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function getItems()
    {
        if( request()->is('api/*')){
            return $this->itemRepository->getItems();
        }
        return $this->itemRepository->orderBy('created_at','desc')->get();
    }

    public function getItem($id)
    {
        return $this->itemRepository->getItem($id);
    }

    public function getCategoryByVendor($id)
    {
        return $this->itemRepository->getCategoryByVendor($id);
    }

    public function create(array $data)
    { 
        DB::beginTransaction();
        try {
            $result = $this->itemRepository->create($data);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to update Item');
        }
        DB::commit();

        return $result;
    }

    public function update(Item $item,array $data)
    {
        DB::beginTransaction();
        try {
            $result = $this->itemRepository->update($item, $data);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to update Item');
        }
        DB::commit();

        return $result;
    }

    public function destroy(Item $item)
    {
        DB::beginTransaction();
        try {
            $result = $this->itemRepository->destroy($item);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to delete Item');
        }
        DB::commit();
        
        return $result;
    }

}