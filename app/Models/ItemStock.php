<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemStock extends Model
{
    use HasFactory,Uuids,SoftDeletes;

    protected $fillable = [
        'qty',
        'item_id',
        'vendor_id',
        'created_by_id',
        'updated_by_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by_id');
    }
}
