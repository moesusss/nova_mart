<?php

namespace App\Repositories\Backend;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Backend\ImageRepository;

class CategoryRepository extends BaseRepository
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
        $categories = Category::with(['sub_categories'])
                            ->filter(request()->all())->orderBy('id','desc');
         if (request()->has('paginate')) {
            $categories = $categories->where("is_active",1)->paginate(request()->get('paginate'));
        } else {
            $categories = $categories->get();
        }
        return $categories;
    }

    public function getCategory($id){
        $category = Category::find($id);
        return $category;
    }
    /**
     * @param array $data
     *
     * @return Category
     */
    public function create(array $data) : Category
    {
        $cover_image = null;
        if (isset($data['cover_image']) && $data['cover_image']) {
            $imageRepository = new ImageRepository();
            $path_name = 'categories';
            $cover_image = $imageRepository->create_file($data['cover_image'], $path_name);
        }
        $category = Category::create([
            'code'              => $data['code'],
            'name'              => $data['name'],
            'mm_name'           => $data['mm_name'],
            'main_service_id'   => $data['main_service_id'],
            'cover_image'       => $cover_image,
            'is_active'         => 1,
        ]);
        return $category;
    }

    /**
     * @param Category  $category
     * @param array $data
     *
     * @return mixed
     */
    public function update(Category $category, array $data) : Category
    {
        $cover_image = null;
        $category->name = isset($data['name']) ? $data['name'] : $category->name ;
        $category->mm_name = isset($data['mm_name']) ? $data['mm_name']: $category->mm_name;
        $category->code = isset($data['code']) ? $data['code'] : $category->code;
        $category->main_service_id = isset($data['main_service_id']) ? $data['main_service_id'] : $category->main_service_id;
        $category->cover_image = $cover_image;

        if (isset($data['cover_image']) && $data['cover_image']) {
            $imageRepository = new ImageRepository();
            $path_name = 'categories';
            $cover_image = $imageRepository->create_file($data['cover_image'], $path_name);
             if ($category->cover_image && $cover_image) {
                 Storage::disk('public')->delete($path_name.'/'.$category->cover_image);
             }
            $category->cover_image = $cover_image;
         }

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
