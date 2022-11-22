<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, Uuids,SoftDeletes;

    /**
     * Get the cities for country.
     */

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
