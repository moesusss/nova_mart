<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerAddress extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $fillable = [
        'customer_id', 'city_id', 'city_name', 'country_id', 'country_name','address','lat','lng','delivery_instructions','is_delivery_available',
    ];

    /**
     * Get the customer that owns the addresses.
    */

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
