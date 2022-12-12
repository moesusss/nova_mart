<?php

namespace App\Models;

use App\Models\Item;
use App\Models\User;
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
        'is_closed',
        'lat',
        'lng',
        'min_order_time',
        'cover_image',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    
    public function created_user()
    {
        return $this->belongsTo(User::class);
    }

    public function main_service()
    {
        return $this->belongsTo(MainService::class);
    }

    public function hub_vendor()
    {
        return $this->belongsTo(HubVendor::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function scopeFilter($query, $filter)
    {
        if (isset($filter['search_query']) && $search = $filter['search_query']) {
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
        if (isset($filter['main_service_id']) && $main_service_id = $filter['main_service_id']) {
            $query->where('main_service_id', $main_service_id );
        }
        if (isset($filter['hub_vendor_id']) && $hub_vendor_id = $filter['hub_vendor_id']) {
            $query->where('hub_vendor_id', $hub_vendor_id );
        }
        
    }

    public static function getDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) {
		// Calculate distance between latitude and longitude
		$distance_diff    = $longitudeFrom - $longitudeTo;
		$distance = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) + cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($distance_diff));
		$distance = acos($distance);
		$distance = rad2deg($distance);
		$miles    = $distance * 60 * 1.1515;

		// Convert KM and return distance
		return round($miles * 1.609344, 2);
	}
}


