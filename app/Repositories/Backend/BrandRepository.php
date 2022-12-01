<?php

namespace App\Repositories\Backend;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class BrandRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Brand::class;
    }

    public function getSubCategories()
    {
        $sub_categories = Brand::with(['category'])
                        ->filter(request()->all())
                        ->orderBy('id','desc');
         if (request()->has('paginate')) {
            $sub_categories = $sub_categories->paginate(request()->get('paginate'));
        } else {
            $sub_categories = $sub_categories->get();
        }
        return $sub_categories;
    }
    /**
     * @param array $data
     *
     * @return Brand
     */
    public function create(array $data) : Brand
    {
        $brand = Brand::create([
            'code'              => $data['code'],
            'name'              => $data['name'],
            'mm_name'           => $data['mm_name'],
            'sub_category_id'       => $data['sub_category_id'],
            'is_active'         => 1,
        ]);
        return $brand;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function update(Brand $brand, array $data) : Brand
    {
        $brand->name = isset($data['name']) ? $data['name'] : $brand->name ;
        $brand->mm_name = isset($data['mm_name']) ? $data['mm_name']: $brand->mm_name;
        $brand->code = isset($data['code']) ? $data['code'] : $brand->code;
        $brand->sub_category_id = isset($data['sub_category_id']) ? $data['sub_category_id'] : $brand->sub_category_id;

        if ($brand->isDirty()) {
            $brand->save();
        }

        return $brand->refresh();
    }

    /**
     * @param Brand $brand
     */
    public function destroy(Brand $brand)
    {
        $deleted = $this->deleteById($brand->id);

        if ($deleted) {
            $brand->save();
        }
    }

    /**
     * @param Brand  $brand
     * @param array $data
     *
     * @return mixed
     */
    public function changeStatus(Brand $brand)
    {
       if($brand->is_active==0){
            $brand->is_active=1;
       }else{
            $brand->is_active=0;
       }
       if($brand->isDirty()){
           $brand->save();
       }
       return $brand->refresh();
    }
}
