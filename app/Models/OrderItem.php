<?php

namespace App\Models;

use App\Models\Item;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
     use HasFactory,Uuids,SoftDeletes;

    protected $fillable = [
        'order_id',
        'transaction_id',
        'item_id',
        'qty',
        'price',
        'total',
        'is_promotion',
        'discount_amount',
        'description',
        
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    
    public function order()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }


    public function scopeFilter($query, $filter)
    {
        
    }
}
