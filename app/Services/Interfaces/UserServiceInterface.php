<?php

namespace App\Services\Interfaces;

use App\User;

interface UserServiceInterface
{
    public function getUsers($request);
    public function getUser($id);
    public function create(array $data);
    public function update(User $user,array $data);
    public function destroy(User $user);
    public function getUserRolesPluckName(User $user);
}