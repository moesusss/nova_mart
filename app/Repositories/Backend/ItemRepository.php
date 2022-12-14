<?php

namespace App\Repositories\Backend;

use App\Models\Item;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ItemRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Item::class;
    }

    public function getItems()
    {
        $items = Item::with(['images'])->filter(request()->all());
        if (request()->has('paginate')) {
            $items = $items->paginate(request()->get('paginate'));
        } else {
            $items = $items->get();
        }
        return $items;
    }

    public function getRelatedItems($item)
    {
        $items = Item::with(['images'])->getRelatedItem($item);
        if (request()->has('paginate')) {
            $items = $items->paginate(request()->get('paginate'));
        } else {
            $items = $items->get();
        }
        return $items;
    }

    public function getCategoryByVendor($id)
    {
        $result = Item::where('vendor_id',$id)
                    ->join('categories', 'categories.id', '=', 'items.category_id')
                     ->selectRaw("
                     categories.*,
                      categories.id as cat_id
                      ")
                ->groupBy('cat_id')
                ->get();
        return $result;
    }

    public function getItemsGroupBySubCategory()
    {
        $items = Item::with(['images'])->filter(request()->all())
                ->orderBy('id','desc')
                ->get();
                // ->groupBy('sub_category.name')
                // ->map(function ($deal) {
                //     return $deal->take(4);
                // });
        // $result = DB::table('a16s')
        //     ->select('p_id', 'u_id', 'time')
        //     ->orderBy('time', 'desc')
        //     ->get()
        //     ->groupBy('p_id')
        //     ->map(function ($deal) {
        //         return $deal->take(2);
        //     });\
        return $items;
    }

    /**
     * @param array $data
     *
     * @return Item
     */
    public function create(array $data) : Item
    {
        $item = Item::create([
            'name' => $data['name'],
            'mm_name' => $data['mm_name'],
            'vendor_id' => $data['vendor_id'],
            // 'main_service_id' => $data['main_service_id'],
            'category_id' => $data['category_id'],
            'sub_category_id' => $data['sub_category_id'],
            'brand_id' => $data['brand_id'],
            'sku' => $data['sku'],
            'barcode' => isset($data['barcode']) ? $data['barcode'] : null,
            'qty' => $data['qty'],
            'price' => $data['price'],
            'weight' => $data['weight'],
            'is_active' => 1,
            'is_instock' => ($data['qty']>0)?1:0,
            'is_package' => isset($data['is_package']) ? $data['is_package'] : false,
            'description' => $data['description'],
            'item_type' => $data['item_type'],
            'unit_type' => $data['unit_type'],
            'created_by' => auth()->user()->id,
        ]);

        if(isset($data['images']))
         {
            foreach($data['images'] as $key => $file)
            {
                $imageRepository = new ImageRepository();
                $path_name = 'items';
                $image_path = $imageRepository->create_file($file, $path_name);
                $image_data['resourceable_type']='Item';
                $image_data['resourceable_id']=$item->id;
                $image_data['image_url']=$image_path;
                $image_data['is_default'] = ($key==0)?true:false;
                $image = $imageRepository->create($image_data);
            }
         }
        return $item;
    }

    /**
     * @param Item  $item
     * @param array $data
     *
     * @return mixed
     */
    public function update(Item $item, array $data) : Item
    {
        // $cover_image = null;
        // if (isset($data['cover_image']) && $data['cover_image']) {
        //     $imageRepository = new ImageRepository();
        //     $path_name = 'items';
        //     $cover_image = $imageRepository->create_file($data['cover_image'], $path_name);
        // }
        
        $item->name = isset($data['name']) ? $data['name'] : $item->name ;
        $item->mm_name = isset($data['mm_name']) ? $data['mm_name'] : $item->mm_name ;
        $item->vendor_id = isset($data['vendor_id']) ? $data['vendor_id'] : $item->vendor_id ;
        $item->category_id = isset($data['category_id']) ? $data['category_id'] : $item->category_id ;
        $item->sub_category_id = isset($data['sub_category_id']) ? $data['sub_category_id'] : $item->sub_category_id ;
        $item->brand_id = isset($data['brand_id']) ? $data['brand_id'] : $item->brand_id ;
        $item->sku = isset($data['sku']) ? $data['sku'] : $item->sku ;
        $item->barcode = isset($data['barcode']) ? $data['barcode'] : $item->barcode ;
        $item->qty = isset($data['qty']) ? $data['qty'] : $item->qty ;
        $item->price = isset($data['price']) ? $data['price'] : $item->price ;
        $item->weight = isset($data['weight']) ? $data['weight'] : $item->weight ;
        $item->is_active = isset($data['is_active']) ? $data['is_active'] : $item->is_active ;
        $item->is_instock = isset($data['is_instock']) ? $data['is_instock'] : $item->is_instock ;
        $item->is_package = isset($data['is_package']) ? $data['is_package'] : $item->is_package ;
        $item->description = isset($data['description']) ? $data['description'] : $item->description ;
        $item->item_type = isset($data['item_type']) ? $data['item_type'] : $item->item_type ;
        $item->unit_type = isset($data['unit_type']) ? $data['unit_type'] : $item->unit_type ;

        if(isset($data['images']))
         {
            $imageRepository = new ImageRepository();
            $item_images = $item->images()->get();
            if(isset($item_images)){
                $path_name = 'items';
                foreach($item_images as $key => $file){
                    Storage::disk('public')->delete($path_name.'/'.$file->image_url);
                    $item_images = $imageRepository->destroy($file);
                }
            }
            
            foreach($data['images'] as $key => $file)
            {
                $imageRepository = new ImageRepository();
                $path_name = 'items';
                $image_path = $imageRepository->create_file($file, $path_name);
                $image_data['resourceable_type']='Item';
                $image_data['resourceable_id']=$item->id;
                $image_data['image_url']=$image_path;
                $image_data['is_default'] = ($key==0)?true:false;
                $image = $imageRepository->create($image_data);
            }
        }
        
        // if (isset($data['images']) && $data['cover_image']) {
        //    $imageRepository = new ImageRepository();
        //    $path_name = 'items';
        //    $cover_image = $imageRepository->create_file($data['cover_image'], $path_name);
        //     if ($item->cover_image && $cover_image) {
        //         Storage::disk('public')->delete($path_name.'/'.$item->cover_image);
        //     }
        //     $item->cover_image = $cover_image;
        // }


        if ($item->isDirty()) {
            // $item->updated_by = auth()->user()->id;
            $item->save();
        }
    
        return $item->refresh();
    }

    /**
     * @param Item $item
     */
    public function destroy(Item $item)
    {
        $deleted = $this->deleteById($item->id);

        if ($deleted) {
            $item->deleted_by = auth()->user()->id;
            $item->save();
        }
    }

    /**
     * @param Vendor  $vendor
     * @param array $data
     *
     * @return mixed
     */
    public function changeStatus(Item $item)
    {
       if($item->is_active==0){
            $item->is_active=1;
       }else{
            $item->is_active=0;
       }
       if($item->isDirty()){
        //    $main_service->updated_by = $data['updatedBy'];
           $item->save();
       }
       return $item->refresh();
    }
   
}
