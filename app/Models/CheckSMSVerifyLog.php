<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckSMSVerifyLog extends Model
{
    use HasFactory,Uuids;

    protected $table = "check_sms_verify_logs";

    protected $fillable = [
        'request_id', 'to', 'sms_created_at', 'expired_at'
    ];
}
