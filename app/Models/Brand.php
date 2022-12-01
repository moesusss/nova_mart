<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, Uuids,SoftDeletes;

    protected $fillable = [
        'code', 'name', 'mm_name', 'is_active','sub_category_id'
    ];

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function scopeFilter($query, $filter)
    {
        if (isset($filter['search']) && $search = $filter['search']) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('mm_name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
        }
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
