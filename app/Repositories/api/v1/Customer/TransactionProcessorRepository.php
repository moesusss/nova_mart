<?php

namespace App\Repositories\api\v1\Customer;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\TransactionProcessor;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class TransactionProcessorRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return TransactionProcessor::class;
    }

    public function getTransactionProcessor($token)
    {
        $customer_id = auth()->user()->id;
        $transPro = TransactionProcessor::where('customer_id', $customer_id)
                                  ->where('token', $token)
                                  ->where('is_complete', false)
                                  ->first();

        if ($transPro) {
            $transPro->is_complete = true;
            $transPro->save();
            $transPro->refresh();
        }

        return $transPro;
    }

    public function check($data)
    {
        $responses = ['status' => false,'token' => null];
        $customer_id = auth()->user()->id;
        $result = TransactionProcessor::where('customer_id', $customer_id)
                                  ->where('total_amount', $data['total_amount'])
                                  ->where('created_at', '>',  Carbon::now()->subMinutes(1)->toDateTimeString() )
                                  ->first();

        $data['customer_id'] = $customer_id;
        if ($result) {
           $responses['message'] = 'Duplicate transaction';
           return $responses;
        }else{
            $token = Str::random(32);
           
            $data['token'] = $token;
            $transaction_processor = $this->create($data);

            $responses['status'] = true;
            $responses['message'] = 'Success';
            $responses['token']  = $transaction_processor->token;
            return $responses;
        }
    }

    /**
     * @param array $data
     *
     * @return CustomerAddress
     */
    public function create(array $data) : TransactionProcessor
    {
        $transaction_processor = TransactionProcessor::create([
            'customer_id'  => $data['customer_id'],
            'token'  => $data['token'],
            'total_amount'  => $data['total_amount'],
        ]);

        
        return $transaction_processor->refresh();
    }

}
