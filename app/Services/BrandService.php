<?php

namespace App\Services;

use Exception;
use App\Models\Brand;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Backend\brandRepository;
use App\Services\Interfaces\BrandServiceInterface;

class BrandService implements BrandServiceInterface
{
    protected $brandRepository;

    public function __construct(brandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function getAuthenticatedUser()
    {
        return Auth::user();
    }

    public function getBrands()
    {
        if( request()->is('api/*')){
            return $this->brandRepository->getSubCategories();
        }
        return $this->brandRepository->orderBy('created_at','desc')->get();
        
    }

    public function getBrand($id)
    {
        return $this->brandRepository->getCategory($id);
    }
    
    public function getBrandSubCategoryPluckName($brand)
    {
        return $brand->categories->pluck('name','name')->all();
    }

    public function create(array $data)
    {        
        $result = $this->brandRepository->create($data);
        return $result;
    }

    public function update(Brand $brand,array $data)
    {
        DB::beginTransaction();
        try {
            $result = $this->brandRepository->update($brand, $data);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to update user');
        }
        DB::commit();

        return $result;
    }

    public function destroy(Brand $brand)
    {
        DB::beginTransaction();
        try {
            $result = $this->brandRepository->destroy($brand);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to delete user');
        }
        DB::commit();
        
        return $result;
    }

    // change Status
    public function changeStatus(Brand $brand)
    {

        DB::beginTransaction();
        try {
            $result = $this->brandRepository->changeStatus($brand);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to active brand service');
        }
        DB::commit();

        return $result;
    }

    public function getDataBySubCategoryID($id){
        $result = $this->brandRepository->findbyValue('sub_category_id',$id);
        return $result;
    }

}