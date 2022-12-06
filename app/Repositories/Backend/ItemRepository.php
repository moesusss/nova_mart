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
        $items = Item::filter(request()->all())->orderBy('id','desc');
        if (request()->has('paginate')) {
            $items = $items->paginate(request()->get('paginate'));
        } else {
            $items = $items->paginate(25);
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

    public function getBestSellerItems($id)
    {
        $result = Item::where('vendor_id',$id)
                    ->where('item_type', 'best_seller')
                    ->get();
        return $result;
    }
    public function getBestDealItems($id)
    {
        $result = Item::where('vendor_id',$id)
                    ->where('item_type', 'best_deal')
                    ->get();
        return $result;
    }
    public function getNewItems($id)
    {
        $result = Item::where('vendor_id',$id)
                         ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();
        return $result;
    }
    /**
     * @param array $data
     *
     * @return Item
     */
    public function create(array $data) : Item
    {
        $cover_image = null;
        if (isset($data['cover_image']) && $data['cover_image']) {
            $imageRepository = new ImageRepository();
            $path_name = 'items';
            $cover_image = $imageRepository->create_file($data['cover_image'], $path_name);
        }
        $item = Item::create([
            'name' => $data['name'],
            'mm_name' => $data['mm_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'cover_image' => $cover_image,
            'mobile' => isset($data['mobile']) ? $data['mobile'] : null,
            'password' => Hash::make($data['password']),
            'main_service_id' => $data['main_service_id'],
            'hub_Item_id' => $data['hub_Item_id'],
            'address' => $data['address'],
            'opening_time' => $data['opening_time'],
            'closing_time' => $data['closing_time'],
            'is_active' => isset($data['is_active']) ? $data['is_active'] : false,
            'is_closed' => isset($data['is_closed']) ? $data['is_closed'] : false,
            'lat' => $data['lat'],
            'lng' => $data['lng'],
            'min_order_time' => isset($data['min_order_time']) ? $data['min_order_time'] : 0,
            'min_order_amount' => isset($data['min_order_amount']) ? $data['min_order_amount'] : 0,
            'created_by' => auth()->user()->id,
        ]);
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
        $cover_image = null;
        if (isset($data['cover_image']) && $data['cover_image']) {
            $imageRepository = new ImageRepository();
            $path_name = 'items';
            $cover_image = $imageRepository->create_file($data['cover_image'], $path_name);
        }
        
        $item->name = isset($data['name']) ? $data['name'] : $item->name ;
        $item->mm_name = isset($data['mm_name']) ? $data['mm_name'] : $item->mm_name ;
        $item->email = isset($data['email']) ? $data['email'] : $item->email ;
        $item->username = isset($data['username']) ? $data['username'] : $item->username ;
        $item->mobile = isset($data['mobile']) ? $data['mobile'] : $item->mobile ;
        $item->password = isset($data['password']) ? Hash::make($data['password']) : $item->password ;
        $item->main_service_id = isset($data['main_service_id']) ? $data['main_service_id'] : $item->main_service_id ;
        $item->hub_Item_id = isset($data['hub_Item_id']) ? $data['hub_Item_id'] : $item->hub_Item_id ;
        $item->address = isset($data['address']) ? $data['address'] : $item->address ;
        $item->opening_time = isset($data['opening_time']) ? $data['opening_time'] : $item->opening_time ;
        $item->closing_time = isset($data['closing_time']) ? $data['closing_time'] : $item->closing_time ;
        $item->is_active = isset($data['is_active']) ? $data['is_active'] : $item->is_active ;
        $item->is_closed = isset($data['is_closed']) ? $data['is_closed'] : $item->is_closed ;
        $item->lat = isset($data['lat']) ? $data['lat'] : $item->lat ;
        $item->lng = isset($data['lng']) ? $data['lng'] : $item->lng ;
        $item->min_order_time = isset($data['min_order_time']) ? $data['min_order_time'] : $item->min_order_time ;
        
        if (isset($data['cover_image']) && $data['cover_image']) {
           $imageRepository = new ImageRepository();
           $path_name = 'items';
           $cover_image = $imageRepository->create_file($data['cover_image'], $path_name);
            if ($item->cover_image && $cover_image) {
                Storage::disk('public')->delete($path_name.'/'.$item->cover_image);
            }
            $item->cover_image = $cover_image;
        }


        if ($item->isDirty()) {
            $item->updated_by = auth()->user()->id;
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
   
}
