<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Image;
use App\Traits\Uuids;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory,Uuids,SoftDeletes;

    protected $fillable = [
        'name',
        'mm_name',
        'vendor_id',
        'category_id',
        'sub_category_id',
        'brand_id',
        'sku',
        'barcode',
        'qty',
        'price',
        'weight',
        'is_active',
        'is_instock',
        'is_package',
        'description',
        'item_type',
        'unit_type',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_by_type',
        'updated_by_type',
        'deleted_by_type',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function item_stocks()
    {
        return $this->hasMany(ItemStock::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function  scopeGetRelatedItem($query, $filter)
    {
        $query->with(['images'])->where('id', '!=', $filter['id'])
            ->where('vendor_id', $filter['vendor_id'])
            ->where(function ($q) use($filter) {
            $q->where('sub_category_id', $filter['sub_category_id'])
                ->orWhere('category_id', $filter['category_id']);
            });
    }

    public function images()
    {
        return $this->morphMany( Image::class, 'resourceable', 'resourceable_type', 'resourceable_id' );
    }


    public function scopeFilter($query, $filter)
    {
        if (isset($filter['search']) && $search = $filter['search']) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('mm_name', 'like', "%{$search}%");
                
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
        if (isset($filter['vendor_id']) && $vendor_id = $filter['vendor_id']) {
            $query->where('vendor_id', $vendor_id );
        }
        if (isset($filter['category_id']) && $category_id = $filter['category_id']) {
            $query->where('category_id', $category_id );
        }
        if (isset($filter['item_type']) && $item_type = $filter['item_type']) {
            $query->where('item_type', $item_type );
        }

        $sortBy = isset($order['sortBy']) ? $order['sortBy'] : 'created_at';
        $orderBy = isset($order['orderBy']) ? $order['orderBy'] : 'desc';

        $query->orderBy($sortBy, $orderBy);
    }
}


