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
        $vendors = Vendor::filter(request()->all())->orderBy('id','desc');
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
            'hub_vendor_id' => $data['hub_vendor_id'],
            'address' => $data['address'],
            'opening_time' => $data['opening_time'],
            'closing_time' => $data['closing_time'],
            'is_active' => isset($data['is_active']) ? $data['is_active'] : false,
            'is_closed' => isset($data['is_closed']) ? $data['is_closed'] : false,
            'lat' => $data['lat'],
            'lng' => $data['lng'],
            'min_order_time' => isset($data['min_order_time']) ? $data['min_order_time'] : null,
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
        
        $vendor->name = isset($data['name']) ? $data['name'] : $vendor->name ;
        $vendor->mm_name = isset($data['mm_name']) ? $data['mm_name'] : $vendor->mm_name ;
        $vendor->email = isset($data['email']) ? $data['email'] : $vendor->email ;
        $vendor->username = isset($data['username']) ? $data['username'] : $vendor->username ;
        $vendor->mobile = isset($data['mobile']) ? $data['mobile'] : $vendor->mobile ;
        $vendor->password = isset($data['password']) ? Hash::make($data['password']) : $vendor->password ;
        $vendor->main_service_id = isset($data['main_service_id']) ? $data['main_service_id'] : $vendor->main_service_id ;
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
            $cover_image = $imageRepository->create($data['cover_image']);
            if ($vendor->cover_image && $cover_image) {
                Storage::disk('dospace')->delete($path_name.'/'.$vendor->cover_image);
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
     * @param Vendor $agent
     */
    public function destroy(Vendor $vendor)
    {
        $deleted = $this->deleteById($vendor->id);

        if ($deleted) {
            $vendor->deleted_by = auth()->user()->id;
            $vendor->save();
        }
    }

   
}
