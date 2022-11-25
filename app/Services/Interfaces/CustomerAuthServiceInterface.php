<?php
/*
 * @Author: Moe Su 
 * @Date: 2020-09-27 21:13:24 
 * @Last Modified by: Moe SU
 * @Last Modified time: 2020-09-27 21:31:05
 */

namespace App\Services\Interfaces;

use App\Models\Customer;

interface CustomerAuthServiceInterface
{
    public function create(array $data);
    public function requestOTP(array $data);
    public function verifyOTP(array $data);
    public function login($request);
    public function checkMemberValid($email);
    public function updatePassword($user,$password);
}