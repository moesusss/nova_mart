<?php

namespace App\Services;

use App\Repositories\CheckSMSVerifyLogRepository;
use App\Services\Interfaces\RoleServiceInterface;
use App\Services\Interfaces\CheckSMSVerifyLogInterface;

class CheckSMSVerifyLogService implements CheckSMSVerifyLogInterface
{
    protected $check_sms_repository;

    public function __construct(CheckSMSVerifyLogRepository $check_sms_repository)
    {
        $this->check_sms_repository = $check_sms_repository;
    }

    public function getCheckSMSVerifyLog($id)
    {
        return $this->check_sms_repository->getCheckSMSVerifyLog($id);
    }

}