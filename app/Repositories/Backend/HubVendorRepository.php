<?php

namespace App\Repositories\Backend;

use App\Models\HubVendor;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class HubVendorRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return HubVendor::class;
    }

    public function getHubVendors($request)
    {
        return HubVendor::filter(request()->only(['search']))->orderBy('id','desc')->paginate(25);
    }
    /**
     * @param array $data
     *
     * @return HubVendor
     */
    public function create(array $data) : HubVendor
    {
        $hub_vendor = HubVendor::create([
            'name'                  => $data['name'],
            'password'              => Hash::make($data['password']),
            'email'                 => $data['email'],
            'address'               => isset($data['address']) ? $data['address'] : null,
            'main_service_id'       => $data['main_service_id'],
            'mobile'                => isset($data['mobile']) ? $data['mobile'] : null,
            'is_active'         => 1,
        ]);
        return $hub_vendor;
    }

    /**
     * @param HubVendor  $hub_vendor
     * @param array $data
     *
     * @return mixed
     */
    public function update(HubVendor $hub_vendor, array $data) : HubVendor
    {
        $hub_vendor->name = isset($data['name']) ? $data['name'] : $hub_vendor->name ;
        $hub_vendor->email = isset($data['email']) ? $data['email']: $hub_vendor->email;
        $hub_vendor->mobile = isset($data['mobile']) ? $data['mobile'] : $hub_vendor->mobile;
        $hub_vendor->password = isset($data['password'])? Hash::make($data['password']) : $hub_vendor->password;
        $hub_vendor->main_service_id = isset($data['main_service_id'])? $data['main_service_id'] : $hub_vendor->main_service_id;
        $hub_vendor->address = isset($data['address'])? $data['address'] : $hub_vendor->address;

        if ($hub_vendor->isDirty()) {
            $hub_vendor->save();
        }
    

        return $hub_vendor->refresh();
    }

    /**
     * @param HubVendor $agent
     */
    public function destroy(HubVendor $hub_vendor)
    {
        $deleted = $this->deleteById($hub_vendor->id);

        if ($deleted) {
            $hub_vendor->save();
        }
    }

    /**
     * @param HubVendor  $hub_vendor
     * @param array $data
     *
     * @return mixed
     */
    public function changeStatus(HubVendor $hub_vendor)
    {
       if($hub_vendor->is_active==0){
            $hub_vendor->is_active=1;
       }else{
            $hub_vendor->is_active=0;
       }
       if($hub_vendor->isDirty()){
        //    $main_service->updated_by = $data['updatedBy'];
           $hub_vendor->save();
       }
       return $hub_vendor->refresh();
    }
}
