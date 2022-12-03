<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Models\HubVendor;
use App\Models\MainService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory,Uuids,SoftDeletes;

    protected $fillable = [
        'name',
        'mm_name',
        'email',
        'username',
        'mobile',
        'password',
        'main_service_id',
        'hub_vendor_id',
        'address',
        'opening_time',
        'closing_time',
        'is_active',
        'lat',
        'lng',
        'min_order_time',
    ];
    
    public function main_service()
    {
        return $this->belongsTo(MainService::class);
    }

    public function hub_vendor()
    {
        return $this->belongsTo(HubVendor::class);
    }

    public function scopeFilter($query, $filter)
    {
        if (isset($filter['search']) && $search = $filter['search']) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('mm_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('mobile', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
        }
        if (isset($filter['name']) && $name = $filter['name']) {
            $query->where('name', $name );
        }
        if (isset($filter['mm_name']) && $mm_name = $filter['mm_name']) {
            $query->where('mm_name', $mm_name );
        }
        if (isset($filter['email']) && $email = $filter['email']) {
            $query->where('email', $email );
        }
        if (isset($filter['mobile']) && $mobile = $filter['mobile']) {
            $query->where('mobile', $mobile );
        }
        if (isset($filter['address']) && $address = $filter['address']) {
            $query->where('address', $address );
        }
        
    }
}

