<?php

namespace App\Repositories\api\v1\Customer;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class CustomerAuthRepository extends BaseRepository
{
        /**
     * @return string
     */
    public function model()
    {
        return Customer::class;
    }

    /**
     * @param array $data
     *
     * @return Customer
     */
    public function create(array $data)
    {
        if(isset($data['avatar']))
        {
            $image = base64_encode(file_get_contents($data['avatar']));
        }
        
        return Customer::create([
            'name' => $data['name'],
            'mobile' => isset($data['mobile'])? $data['mobile']: null,
            'sms_verified_at' => 1,
            'is_active' => 1
        ]);
    }

    /**
     * @param Customer  $customer
     * @param array $data
     *
     * @return mixed
     */
    public function update(Customer $customer, array $data)
    {
        $customer->name = isset($data['name'])? $data['name']: $customer->name;
        $customer->email = isset($data['email'])? $data['email']: $customer->email;
        $customer->mobile = isset($data['mobile'])? $data['mobile']: $customer->mobile;
        $customer->password = isset($data['password'])? Hash::make($data['password']): $customer->password;
        $customer->is_active = isset($data['is_active'])? $data['is_active']: $customer->is_active;
        if($customer->isDirty()){
           $customer->updated_by = $customer->id;
           $customer->save();
        }
       return $customer->refresh();
    }

    /**
     * @param Customer $customer
     */
    public function destroy(Customer $customer)
    {   
    }

    public function verifyAccount(Customer $customer){
        $customer->email_verified_at = Carbon::now();
        $customer->is_verified = 1;
        $customer->status = 1;
        if($customer->isDirty()){
            $customer->updated_by = $customer->id;
            $customer->save();
        }
        return $customer->refresh();
        
    }

    public function smsVerifyAccount(Customer $customer){
        $customer->sms_verified_at = Carbon::now();
        $customer->is_active = 1;
        if($customer->isDirty()){
            $customer->updated_by = $customer->id;
            $customer->save();
        }
        return $customer->refresh();
        
    }

    public function smsResetPassword(Customer $customer,$password){
        $customer->password = Hash::make($password);
        if($customer->isDirty()){
            $customer->updated_by = $customer->id;
            $customer->save();
        }
        return $customer->refresh();
    }

    public function checkField($field,$value){
        return Customer::where($field,$value)->first();
    }

    public function update_password($customer,$password){
        $customer->password = Hash::make($password);
        $customer->save();
        return $customer;
    }

}
?>