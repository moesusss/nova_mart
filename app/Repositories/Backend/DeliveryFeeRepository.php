<?php

namespace App\Repositories\Backend;

use App\Models\DeliveryFee;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;

class DeliveryFeeRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return DeliveryFee::class;
    }

    public function getDeliveryFees()
    {
        $delivery_fees = DeliveryFee::filter(request()->all())->orderBy('id','desc');
         if (request()->has('paginate')) {
            $delivery_fees = $delivery_fees->paginate(request()->get('paginate'));
        } else {
            $delivery_fees = $delivery_fees->get();
        }
        return $delivery_fees;
    }
    
    /**
     * @param string $id
     *
     * @return DeliveryFee
     */
    public function getDeliveryFee($id)
    {
        return $this->getById($id);
    }

    /**
     * @param array $data
     *
     * @return DeliveryFee
     */
    public function create(array $data)
    {
        return DeliveryFee::create([
            'delivery_type' => $data['delivery_type'],
            'from' => $data['from'],
            'to' => $data['to'],
            'amount' => $data['amount'],
        ]);
    }

    /**
     * @param DeliveryFee  $delivery_fee
     * @param array $data
     *
     * @return mixed
     */
    public function update(DeliveryFee $delivery_fee, array $data)
    {
       $delivery_fee->delivery_type = ($data['delivery_type'])?$data['delivery_type']:$delivery_fee->delivery_type;
       $delivery_fee->from = ($data['from'])?$data['from']:$delivery_fee->from;
       $delivery_fee->to = ($data['to'])?$data['to']:$delivery_fee->to;
       $delivery_fee->amount = ($data['amount'])?$data['amount']:$delivery_fee->amount;
       if($delivery_fee->isDirty()){
        //    $delivery_fee->updated_by = $data['updatedBy'];
           $delivery_fee->save();
       }
       return $delivery_fee->refresh();
    }

    /**
     * @param DeliveryFee  $delivery_fee
     * @param array $data
     *
     * @return mixed
     */
    public function changeStatus(DeliveryFee $delivery_fee)
    {
       if($delivery_fee->is_active==0){
            $delivery_fee->is_active=1;
       }else{
            $delivery_fee->is_active=0;
       }
       if($delivery_fee->isDirty()){
        //    $delivery_fee->updated_by = $data['updatedBy'];
           $delivery_fee->save();
       }
       return $delivery_fee->refresh();
    }

    /**
     * @param DeliveryFee $delivery_fee
     */
    public function destroy(DeliveryFee $delivery_fee)
    {   
        $this->deleteById($delivery_fee->id);
    }
}
