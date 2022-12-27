<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory,Uuids,SoftDeletes;

    protected $fillable = [
        'name',
        'is_active',
    ];

   
    public function scopeFilter($query, $filter)
    {
        if (isset($filter['name']) && $name = $filter['name']) {
            $query->where('name', $name );
        }
        if (isset($filter['is_active']) && $is_active = $filter['is_active']) {
            $query->where('is_active', $is_active );
        }

        $sortBy = isset($order['sortBy']) ? $order['sortBy'] : 'created_at';
        $orderBy = isset($order['orderBy']) ? $order['orderBy'] : 'desc';

        $query->orderBy($sortBy, $orderBy);
    }
}
