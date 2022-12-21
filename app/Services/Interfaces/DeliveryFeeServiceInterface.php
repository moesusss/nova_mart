<?php

namespace App\Services\Interfaces;

use App\Models\DeliveryFee;

interface DeliveryFeeServiceInterface
{
    public function getDeliveryFees();
    public function changeStatus(DeliveryFee $delivery_fee);
    public function getDeliveryFee(DeliveryFee $delivery_fee);
    public function create(array $data);
    public function update(DeliveryFee $delivery_fee,array $data);
    public function destroy(DeliveryFee $delivery_fee);
}