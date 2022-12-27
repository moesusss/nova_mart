<?php

namespace App\Models;

use App\Models\Order;
use App\Traits\Uuids;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\CustomerAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory,Uuids,SoftDeletes;

    protected $fillable = [
        'transaction_ref',
        'customer_id',
        'customer_address_id',
        'is_coupon',
        'coupon_code',
        'total_discount_amount',
        'total_delivery_amount',
        'sub_total',
        'grand_total',
        'transaction_date',
        'payment_method_id',
        'payment_ref',
        'payment_status',
        'description',
        'tax_amount',
    ];

    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function customer_address()
    {
        return $this->belongsTo(CustomerAddress::class);
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeFilter($query, $filter)
    {
        
    }

    
}
