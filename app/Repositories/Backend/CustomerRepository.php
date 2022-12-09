<?php

namespace App\Repositories\Backend;

use App\Models\Customer as AppCustomer;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;
use Illuminate\Foundation\Auth\User;

class CustomerRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return AppCustomer::class;
    }

    /**
     * @param string $id
     *
     * @return User
     */
    public function getCustomer($id)
    {
        return AppCustomer::getById($id);
    }

    /**
     * @return Customers
     */
    public function getCustomers()
    {
        return AppCustomer::orderBy('created_at','desc')->get();
    }

    public function getFilterCustomers($request)
    {
        if($request->is('api/*')){
            return AppCustomer::orderBy('created_at','desc')->get();
        }else{
            return AppCustomer::orderBy('created_at','desc')->get();
        }        
    }

    public function getCount($query){
        if($query == 'user'){
            return AppCustomer::whereNotNull('role_id')->get()->count();
        }else{
            return AppCustomer::whereNull('role_id')->get()->count();
        }
    }

    /**
     * @param Customer  $customer
     * @param array $data
     *
     * @return mixed
     */
    public function changeStatus(AppCustomer $customer)
    {
       if($customer->is_active==0){
            $customer->is_active=1;
       }else{
            $customer->is_active=0;
       }
       if($customer->isDirty()){
        //    $main_service->updated_by = $data['updatedBy'];
           $customer->save();
       }
       return $customer->refresh();
    }
}