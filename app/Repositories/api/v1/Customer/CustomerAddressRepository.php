<?php

namespace App\Repositories\api\v1\Customer;

use App\Models\City;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class CustomerAddressRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CustomerAddress::class;
    }

    /**
     * @param array $data
     *
     * @return CustomerAddress
     */
    public function create(array $data) : CustomerAddress
    {
        $customer_address = CustomerAddress::create([
            'customer_id'                     => isset($data['customer_id'])? $data['customer_id']: null,
            'address'                         => isset($data['address'])? $data['address']: null,
            'lat'                             => isset($data['lat'])? $data['lat']: null,
            'lng'                             => isset($data['lng'])? $data['lng']: null,
            'city_id'                         => isset($data['city_id'])? $data['city_id']: City::first()->id,
            'city_name'                       => isset($data['city_name'])? $data['city_name']: City::first()->name,
            'country_id'                      => isset($data['country_id'])? $data['country_id']: Country::first()->id,
            'country_name'                    => isset($data['country_name'])? $data['country_name']: Country::first()->name,
            'delivery_instructions'           => isset($data['delivery_instructions'])? $data['delivery_instructions']: null,
        ]);
        return $customer_address;
    }

    /**
     * @param Agent  $agent
     * @param array $data
     *
     * @return mixed
     */
    public function update(CustomerAddress $customer_address, array $data) : CustomerAddress
    {
        $customer_address->name = isset($data['name']) ? $data['name'] : $customer_address->name ;
       
        if ($customer_address->isDirty()) {
            $customer_address->save();
        }

        $customer_address->syncPermissions($data['permission']);

        return $customer_address->refresh();
    }

    /**
     * @param CustomerAddress $customer_address
     */
    public function destroy(CustomerAddress $customer_address)
    {
        $deleted = $this->deleteById($customer_address->id);

        if ($deleted) {
            $customer_address->save();
        }
    }
}
