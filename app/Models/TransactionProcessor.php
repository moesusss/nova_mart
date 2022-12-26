<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionProcessor extends Model
{
    use HasFactory,Uuids;
    
    protected $fillable = [
        'receipt_no',
        'total_amount',
        'customer_id',
        'token',
        'is_complete'
    ];

}
