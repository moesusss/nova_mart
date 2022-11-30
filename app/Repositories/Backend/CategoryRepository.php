<?php

namespace App\Repositories\Backend;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class categoryRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    public function getCategories()
    {
        $categories = Category::filter(request()->all())->orderBy('id','desc');
         if (request()->has('paginate')) {
            $categories = $categories->paginate(request()->get('paginate'));
        } else {
            $categories = $categories->get();
        }
        return $categories;
    }
    /**
     * @param array $data
     *
     * @return Category
     */
    public function create(array $data) : Category
    {
        $category = Category::create([
            'code'              => $data['code'],
            'name'              => $data['name'],
            'mm_name'           => $data['mm_name'],
            'main_service_id'   => $data['main_service_id'],
            'is_active'         => 1,
        ]);
        return $category;
    }

    /**
     * @param Agent  $agent
     * @param array $data
     *
     * @return mixed
     */
    public function update(Category $category, array $data) : Category
    {
        $category->name = isset($data['name']) ? $data['name'] : $category->name ;
        $category->mm_name = isset($data['mm_name']) ? $data['mm_name']: $category->mm_name;
        $category->code = isset($data['code']) ? $data['code'] : $category->code;
        $category->main_service_id = isset($data['main_service_id']) ? $data['main_service_id'] : $category->main_service_id;

        if ($category->isDirty()) {
            $category->save();
        }

        return $category->refresh();
    }

    /**
     * @param Category $category
     */
    public function destroy(Category $category)
    {
        $deleted = $this->deleteById($category->id);

        if ($deleted) {
            $category->save();
        }
    }

    /**
     * @param Category  $category
     * @param array $data
     *
     * @return mixed
     */
    public function changeStatus(Category $category)
    {
       if($category->is_active==0){
            $category->is_active=1;
       }else{
            $category->is_active=0;
       }
       if($category->isDirty()){
           $category->save();
       }
       return $category->refresh();
    }
}
