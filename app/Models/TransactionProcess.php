<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionProcess extends Model
{
    use HasFactory,Uuids;

    protected $fillable = [
        'receipt_no',
        'sub_total',
        'customer_id',
        'token',
    ];

}



