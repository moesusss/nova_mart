<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Models\MainService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,Uuids,SoftDeletes;

    protected $fillable = [
        'code', 'name', 'mm_name', 'is_active','main_service_id'
    ];

    public function main_service()
    {
        return $this->belongsTo(MainService::class);
    }
}
