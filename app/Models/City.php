<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory,Uuids,SoftDeletes;
    /**
     * Get the country that owns the cities.
     */
    
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
