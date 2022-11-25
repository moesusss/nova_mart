<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainService extends Model
{
    use HasFactory,Uuids,SoftDeletes;

    protected $fillable = [
        'code', 'name', 'mm_name', 'is_active'
    ];
}
