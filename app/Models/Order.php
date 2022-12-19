<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Models\Vendor;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory,Uuids,SoftDeletes;

    protected $fillable = [
        'transaction_id',
        'transaction_ref',
        'vendor_id',
        'customer_id',
        'customer_address_id',
        'is_coupon',
        'total_discount_amount',
        'delivery_id',
        'delivery_amount',
        'tax_amount',
        'sub_total',
        'grand_total',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function customer_address()
    {
        return $this->belongsTo(CustomerAddress::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

   

    public function scopeFilter($query, $filter)
    {
        
    }

}
