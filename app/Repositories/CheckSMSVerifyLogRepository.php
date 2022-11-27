<?php

namespace App\Repositories;

use App\Models\CheckSMSVerifyLog;
use App\Repositories\BaseRepository;

class CheckSMSVerifyLogRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CheckSMSVerifyLog::class;
    }

    /**
     * @param array $data
     *
     * @return CheckSMSVerifyLog
     */
    public function create(array $data) : CheckSMSVerifyLog
    {
        $check_sms_verify_log = CheckSMSVerifyLog::create([
            'request_id'    => $data['request_id'],
            'to'            => $data['to'],
            'sms_created_at'=> $data['created_at'],
            'expired_at'    => $data['expire_at'],
        ]);
        return $check_sms_verify_log;
    }

    /**
     * @param string $id
     *
     * @return CheckSMSVerifyLog
     */
    public function getCheckSMSVerifyLog($id)
    {
        return $this->getById($id);
    }
}
