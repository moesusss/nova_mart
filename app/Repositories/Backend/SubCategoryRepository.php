<?php

namespace App\Repositories\Backend;

use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class SubCategoryRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return SubCategory::class;
    }

    public function getSubCategories()
    {
        $sub_categories = SubCategory::with(['category'])
                        ->filter(request()->all())
                        ->orderBy('id','desc');
         if (request()->has('paginate')) {
            $sub_categories = $sub_categories->where("is_active",1)->paginate(request()->get('paginate'));
        } else {
            $sub_categories = $sub_categories->get();
        }
        return $sub_categories;
    }

    public function findbyValue($field,$value)
    {
        $data = SubCategory::where($field,$value)->get();
        return $data;
    }
    /**
     * @param array $data
     *
     * @return SubCategory
     */
    public function create(array $data) : SubCategory
    {
        $sub_category = SubCategory::create([
            'code'              => $data['code'],
            'name'              => $data['name'],
            'mm_name'           => $data['mm_name'],
            'category_id'       => $data['category_id'],
            'is_active'         => 1,
        ]);
        return $sub_category;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function update(SubCategory $sub_category, array $data) : SubCategory
    {
        $sub_category->name = isset($data['name']) ? $data['name'] : $sub_category->name ;
        $sub_category->mm_name = isset($data['mm_name']) ? $data['mm_name']: $sub_category->mm_name;
        $sub_category->code = isset($data['code']) ? $data['code'] : $sub_category->code;
        $sub_category->category_id = isset($data['category_id']) ? $data['category_id'] : $sub_category->category_id;

        if ($sub_category->isDirty()) {
            $sub_category->save();
        }

        return $sub_category->refresh();
    }

    /**
     * @param SubCategory $sub_category
     */
    public function destroy(SubCategory $sub_category)
    {
        $deleted = $this->deleteById($sub_category->id);

        if ($deleted) {
            $sub_category->save();
        }
    }

    /**
     * @param SubCategory  $sub_category
     * @param array $data
     *
     * @return mixed
     */
    public function changeStatus(SubCategory $sub_category)
    {
       if($sub_category->is_active==0){
            $sub_category->is_active=1;
       }else{
            $sub_category->is_active=0;
       }
       if($sub_category->isDirty()){
           $sub_category->save();
       }
       return $sub_category->refresh();
    }
}
