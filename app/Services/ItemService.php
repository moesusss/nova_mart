<?php
 
namespace App\Services;

use Exception;
use App\Models\Item;
use App\Repositories\Backend\CategoryRepository;
use App\Repositories\Backend\HubItemRepository;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\ItemServiceInterface;
use App\Repositories\Backend\ItemRepository;
use App\Repositories\Backend\WeightConventionRepository;

class ItemService implements ItemServiceInterface
{
    protected $itemRepository;
    protected $categoryRepository;
    protected $weightconventionRepository;

    public function __construct(ItemRepository $itemRepository,CategoryRepository $categoryRepository, WeightConventionRepository $weightConventionRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->categoryRepository = $categoryRepository;
        $this->weightConventionRepository = $weightConventionRepository;
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

    public function getRelatedItems($item)
    {
        return $this->itemRepository->getRelatedItems($item);
    }

    public function getCategoryByVendor($id)
    {
        return $this->itemRepository->getCategoryByVendor($id);
    }

    public function create(array $data)
    { 
        // dd($data);
        $randomNumber = random_int(00000001, 99999999);
        $weight_convention = $this->weightConventionRepository->getWeightConvention($data['weight_convention_id']);
        $weight_by_kg = $data['weight']*$weight_convention->rate;
        DB::beginTransaction();
        try {
            $data['weight_by_kg']=$weight_by_kg;
            $data['sku'] = $randomNumber;
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
        $weight_convention = $this->weightConventionRepository->getWeightConvention($data['weight_convention_id']);
        $weight_by_kg = $data['weight']*$weight_convention->rate;
        DB::beginTransaction();
        try {
            $data['weight_by_kg']=$weight_by_kg;
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
    // change Status
    public function changeStatus(Item $item)
    {

        DB::beginTransaction();
        try {
            $result = $this->itemRepository->changeStatus($item);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to active item');
        }
        DB::commit();

        return $result;
    }

    public function getDataByVendorID($id){
        $result = $this->itemRepository->findbyValue('vendor_id',$id);
        return $result;
    }

}