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
        $result = Transaction::with(['customer','customer_address','payment_method'])->filter(request()->all())
                        ->orderBy('id','desc');
         if (request()->has('paginate')) {
            $result = $result->paginate(request()->get('paginate'));
        } else {
            $result = $result->get();
        }
        return $result;
    }

     public function getTransactionsByAuthUser()
    {
        $result = Transaction::where('customer_id', auth()->user()->id)
                        ->with(['customer','customer_address','payment_method'])
                        ->filter(request()->all())
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
        $transaction = Transaction::create([
            'customer_id'  => auth()->user()->id,
            'customer_address_id'  => $data['customer_address_id'],
            'is_coupon'  => isset($data['is_coupon'])? $data['is_coupon']: false,
            'coupon_code'  => isset($data['coupon_code'])? $data['coupon_code']: null,

            'payment_method_id'  => $data['payment_method_id'],
            'payment_ref'  => isset($data['payment_ref'])? $data['payment_ref']: null,
            'payment_status'  => isset($data['payment_status'])? $data['payment_status']: null,

            'total_discount_amount'  => isset($data['total_discount_amount'])? $data['total_discount_amount']: 0,
            'total_delivery_amount'  => isset($data['total_delivery_amount'])? $data['total_delivery_amount']: 0,
            'sub_total'  => isset($data['sub_total'])? $data['sub_total']: 0,
            'grand_total'  => isset($data['grand_total'])? $data['grand_total']: 0,

            'transaction_date'  => isset($data['transaction_date'])? $data['transaction_date']: now(),
            'description'  => isset($data['description'])? $data['description']: null,
            'tax_amount'  => isset($data['tax_amount'])? $data['tax_amount']: 0,
            
        ]);

        $orderRepo = new OrderRepository();
        $total_discount_amount = 0;
        $total_delivery_amount = 0;
        $sub_total = 0;
        $grand_total = 0;

        foreach ($data['orders'] as $order) {
            $order['transaction_id'] = $transaction->id;
            $order['transaction_ref'] = $transaction->transaction_ref;
            $order['customer_id'] = $transaction->customer_id;
            $order['customer_address_id'] = $transaction->customer_address_id;
            
            $result = $orderRepo->create($order);
            
            $total_discount_amount += $result->total_discount_amount;
            $total_delivery_amount += $result->delivery_amount;
            $sub_total += $result->sub_total;
            $grand_total += $result->grand_total;
        }

        $transaction->total_discount_amount = $total_discount_amount;
        $transaction->total_delivery_amount = $total_delivery_amount;
        $transaction->sub_total = $sub_total;
        $transaction->grand_total = $grand_total;
        $transaction->save();

        return $transaction->refresh();
    }

}
