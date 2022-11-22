<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory,Uuids,SoftDeletes;

    protected $fillable = [
        'name', 'email', 'mobile', 'is_active', 'password'
    ];

    /**
     * Get the addresses for customer.
     */

    public function customer_addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }
}
