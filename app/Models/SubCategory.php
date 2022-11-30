<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $fillable = [
        'code', 'name', 'mm_name', 'is_active','category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, $filter)
    {
        if (isset($filter['search']) && $search = $filter['search']) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('mm_name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
        }
    }
}
