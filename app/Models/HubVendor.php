<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Models\MainService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HubVendor extends Model
{
    use HasFactory,Uuids,SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'is_active',
        'main_service_id',
        'address'
    ];
    public function main_service()
    {
        return $this->belongsTo(MainService::class);
    }
}
