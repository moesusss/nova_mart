<?php

namespace App\Repositories\api\v1\Customer;

use App\Models\City;
use App\Models\Country;
use App\Models\Transaction;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class TransactionRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Transaction::class;
    }

     public function getTransactions()
    {
        $result = Transaction::filter(request()->all())
                        ->orderBy('id','desc');
         if (request()->has('paginate')) {
            $result = $result->paginate(request()->get('paginate'));
        } else {
            $result = $result->get();
        }
        return $result;
    }


    public function getTransaction($id){
        return Transaction::find($id);
    }

    /**
     * @param array $data
     *
     * @return CustomerAddress
     */
    public function create(array $data) : Transaction
    {
        $customer_address = Transaction::create([
            'customer_id'  => $data['customer_id'],
            'customer_address_id'  => $data['customer_address_id'],
            'is_coupon'  => isset($data['is_coupon'])? $data['is_coupon']: false,
            'coupon_code'  => isset($data['coupon_code'])? $data['coupon_code']: null,
            'payment_method_id'  => $data['payment_method_id'],
            'description'  => isset($data['description'])? $data['description']: null,
            'tax_amount'  => isset($data['tax_amount'])? $data['tax_amount']: 0,
            
        ]);
        return $customer_address;
    }

}
