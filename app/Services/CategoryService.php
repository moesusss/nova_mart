<?php

namespace App\Services;

use App\Models\Category;
use App\Models\User;
use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Backend\CategoryRepository;
use App\Services\Interfaces\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAuthenticatedUser()
    {
        return Auth::user();
    }

    public function getCategories()
    {
        if( request()->is('api/*')){
            return $this->categoryRepository->getCategories();
        }
        return $this->categoryRepository->orderBy('created_at','desc')->get();
        
    }

    public function getCategory($id)
    {
        return $this->categoryRepository->getCategory($id);
    }
    
    public function getCategoryMainServicePluckName($category)
    {
        return $category->main_services->pluck('name','name')->all();
    }

    public function create(array $data)
    {        
        $result = $this->categoryRepository->create($data);
        return $result;
    }

    public function update(Category $category,array $data)
    {
        DB::beginTransaction();
        try {
            $result = $this->categoryRepository->update($category, $data);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to update category');
        }
        DB::commit();

        return $result;
    }

    public function destroy(Category $category)
    {
        DB::beginTransaction();
        try {
            $result = $this->categoryRepository->destroy($category);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to delete category');
        }
        DB::commit();
        
        return $result;
    }

    // change Status
    public function changeStatus(Category $category)
    {

        DB::beginTransaction();
        try {
            $result = $this->categoryRepository->changeStatus($category);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to active main service');
        }
        DB::commit();

        return $result;
    }

}