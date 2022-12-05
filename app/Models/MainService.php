<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainService extends Model
{
    use HasFactory,Uuids,SoftDeletes;

    protected $fillable = [
        'code', 'name', 'mm_name', 'is_active'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function hub_vendors()
    {
        return $this->hasMany(HubVendor::class);
    }

    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }

    public function scopeFilter($query, $filter)
    {
        if (isset($filter['search']) && $search = $filter['search']) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('mm_name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
        }
        if (isset($filter['code']) && $code = $filter['code']) {
            $query->where('code', $code );
        }
        if (isset($filter['name']) && $name = $filter['name']) {
            $query->where('name', $name );
        }
        if (isset($filter['mm_name']) && $mm_name = $filter['mm_name']) {
            $query->where('mm_name', $mm_name );
        }
        if (isset($filter['is_active']) && $is_active = $filter['is_active']) {
            $query->where('is_active', $is_active );
        }
    }
}
