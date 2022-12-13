<?php

namespace App\Repositories\Backend;

use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class VendorRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Vendor::class;
    }

    public function getVendors()
    {
        if(request()->has('lat') && request()->has('lng')){
            $vendors = Vendor::selectRaw("*, 
                     ( 6371000 * acos( cos( radians(?) ) *
                       cos( radians( lat) )
                       * cos( radians( lng ) - radians(?)
                       ) + sin( radians(?) ) *
                       sin( radians( lat ) ) )
                     ) AS distance", [request()->lat, request()->lng, request()->lat])
        ->having("distance", "<", env('RADIUS'))
        ->orderBy("distance",'desc');
        }else{
            $vendors = Vendor::filter(request()->all())->orderBy('id','desc');
        }
        if (request()->has('paginate')) {
            
            $vendors = $vendors->paginate(request()->get('paginate'));
        } else {
            
            $vendors = $vendors->paginate(25);
        }
        return $vendors;
    }
    /**
     * @param array $data
     *
     * @return Vendor
     */
    public function create(array $data) : Vendor
    {
        $cover_image = null;
        if (isset($data['cover_image']) && $data['cover_image']) {
            $imageRepository = new ImageRepository();
            $path_name = 'vendors';
            $cover_image = $imageRepository->create_file($data['cover_image'], $path_name);
        }
        $vendor = Vendor::create([
            'name' => $data['name'],
            'mm_name' => $data['mm_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'cover_image' => $cover_image,
            'mobile' => isset($data['mobile']) ? $data['mobile'] : null,
            'password' => Hash::make($data['password']),
            'main_service_id' => $data['main_service_id'],
            'sub_categories_id' => $data['sub_categories_id'],
            'hub_vendor_id' => $data['hub_vendor_id'],
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
        return $vendor;
    }

    /**
     * @param Vendor  $vendor
     * @param array $data
     *
     * @return mixed
     */
    public function update(Vendor $vendor, array $data) : Vendor
    {
        $cover_image = null;
        if (isset($data['cover_image']) && $data['cover_image']) {
            $imageRepository = new ImageRepository();
            $path_name = 'vendors';
            $cover_image = $imageRepository->create_file($data['cover_image'], $path_name);
        }
        
        $vendor->name = isset($data['name']) ? $data['name'] : $vendor->name ;
        $vendor->mm_name = isset($data['mm_name']) ? $data['mm_name'] : $vendor->mm_name ;
        $vendor->email = isset($data['email']) ? $data['email'] : $vendor->email ;
        $vendor->username = isset($data['username']) ? $data['username'] : $vendor->username ;
        $vendor->mobile = isset($data['mobile']) ? $data['mobile'] : $vendor->mobile ;
        $vendor->password = isset($data['password']) ? Hash::make($data['password']) : $vendor->password ;
        $vendor->main_service_id = isset($data['main_service_id']) ? $data['main_service_id'] : $vendor->main_service_id ;
        $vendor->sub_categories_id = isset($data['sub_categories_id']) ? $data['sub_categories_id'] : $vendor->sub_categories_id;
        $vendor->hub_vendor_id = isset($data['hub_vendor_id']) ? $data['hub_vendor_id'] : $vendor->hub_vendor_id ;
        $vendor->address = isset($data['address']) ? $data['address'] : $vendor->address ;
        $vendor->opening_time = isset($data['opening_time']) ? $data['opening_time'] : $vendor->opening_time ;
        $vendor->closing_time = isset($data['closing_time']) ? $data['closing_time'] : $vendor->closing_time ;
        $vendor->is_active = isset($data['is_active']) ? $data['is_active'] : $vendor->is_active ;
        $vendor->is_closed = isset($data['is_closed']) ? $data['is_closed'] : $vendor->is_closed ;
        $vendor->lat = isset($data['lat']) ? $data['lat'] : $vendor->lat ;
        $vendor->lng = isset($data['lng']) ? $data['lng'] : $vendor->lng ;
        $vendor->min_order_time = isset($data['min_order_time']) ? $data['min_order_time'] : $vendor->min_order_time ;
        
        if (isset($data['cover_image']) && $data['cover_image']) {
           $imageRepository = new ImageRepository();
           $path_name = 'vendors';
           $cover_image = $imageRepository->create_file($data['cover_image'], $path_name);
            if ($vendor->cover_image && $cover_image) {
                Storage::disk('public')->delete($path_name.'/'.$vendor->cover_image);
            }
            $vendor->cover_image = $cover_image;
        }


        if ($vendor->isDirty()) {
            $vendor->updated_by = auth()->user()->id;
            $vendor->save();
        }
    
        return $vendor->refresh();
    }

    /**
     * @param Vendor $vendor
     */
    public function destroy(Vendor $vendor)
    {
        $deleted = $this->deleteById($vendor->id);

        if ($deleted) {
            $vendor->deleted_by = auth()->user()->id;
            $vendor->save();
        }
    }

    /**
     * @param Vendor  $vendor
     * @param array $data
     *
     * @return mixed
     */
    public function changeStatus(Vendor $vendor)
    {
       if($vendor->is_active==0){
            $vendor->is_active=1;
       }else{
            $vendor->is_active=0;
       }
       if($vendor->isDirty()){
        //    $main_service->updated_by = $data['updatedBy'];
           $vendor->save();
       }
       return $vendor->refresh();
    }



   
}
