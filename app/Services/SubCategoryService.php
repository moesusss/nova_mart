<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Backend\ItemRepository;
use App\Repositories\Backend\CategoryRepository;
use App\Repositories\Backend\SubCategoryRepository;
use App\Services\Interfaces\SubCategoryServiceInterface;
use App\Http\Resources\api\v1\Customer\SubCategory\SubCategoryCollection;

class SubCategoryService implements SubCategoryServiceInterface
{
    protected $subcategoryRepository;
    protected $itemRepository;

    public function __construct(SubCategoryRepository $subcategoryRepository,
                            ItemRepository $itemRepository
                            )
    {
        $this->subcategoryRepository = $subcategoryRepository;
        $this->itemRepository = $itemRepository;
    }

    public function getAuthenticatedUser()
    {
        return Auth::user();
    }

    public function getSubCategories()
    {
        if( request()->is('api/*')){
            return $this->subcategoryRepository->getSubCategories();
        }
        return $this->subcategoryRepository->orderBy('created_at','desc')->get();
        
    }

    public function getSubCategoriesWithItems()
    {
        return $this->itemRepository->getItemsGroupBySubCategory();
    }
    
    public function getSubCategoriesWithHighlightItems($vendor)
    {
        return $this->itemRepository->getHilightedItemsGroupBySubCategory($vendor);
    }

    public function getSubCategory($id)
    {
        return $this->subcategoryRepository->getCategory($id);
    }
    
    public function getSubCategoryCategoryPluckName($sub_category)
    {
        return $sub_category->categories->pluck('name','name')->all();
    }

    public function create(array $data)
    {        
        $result = $this->subcategoryRepository->create($data);
        return $result;
    }

    public function update(SubCategory $sub_category,array $data)
    {
        DB::beginTransaction();
        try {
            $result = $this->subcategoryRepository->update($sub_category, $data);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to update sub category');
        }
        DB::commit();

        return $result;
    }

    public function destroy(SubCategory $sub_category)
    {
        DB::beginTransaction();
        try {
            $result = $this->subcategoryRepository->destroy($sub_category);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to delete sub category');
        }
        DB::commit();
        
        return $result;
    }

    // change Status
    public function changeStatus(SubCategory $sub_category)
    {

        DB::beginTransaction();
        try {
            $result = $this->subcategoryRepository->changeStatus($sub_category);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to active main service');
        }
        DB::commit();

        return $result;
    }

    public function getDataByCategoryID($id){
        $result = $this->subcategoryRepository->findbyValue('category_id',$id);
        return $result;
    }

}