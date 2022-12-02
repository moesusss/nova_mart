<?php

namespace App\Services;

use App\Models\User;
use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Backend\UserRepository;
use App\Services\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAuthenticatedUser()
    {
        return Auth::user();
    }

    public function getUsers($request)
    {
        return $this->userRepository->orderBy('created_at','desc')->get();
        // return $this->userRepository->getUsers($request);
    }

    public function getUser($id)
    {
        return $this->userRepository->getUser($id);
    }
    
    public function getUserRolesPluckName($user)
    {
        return $user->roles->pluck('name','name')->all();
    }

    public function create(array $data)
    {        
        $result = $this->userRepository->create($data);
        return $result;
    }

    public function update(User $user,array $data)
    {
        DB::beginTransaction();
        try {
            $result = $this->userRepository->update($user, $data);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to update user');
        }
        DB::commit();

        return $result;
    }

    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $result = $this->userRepository->destroy($user);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to delete user');
        }
        DB::commit();
        
        return $result;
    }

    // change Status
    public function changeStatus(User $user)
    {

        DB::beginTransaction();
        try {
            $result = $this->userRepository->changeStatus($user);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to active user');
        }
        DB::commit();

        return $result;
    }

}