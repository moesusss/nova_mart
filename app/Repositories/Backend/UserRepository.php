<?php

namespace App\Repositories\Backend;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function getUsers($request)
    {
        return User::filter(request()->only(['search']))->orderBy('id','desc')->paginate(25);
    }
    /**
     * @param array $data
     *
     * @return User
     */
    public function create(array $data) : User
    {
        $user = User::create([
            'name'              => $data['name'],
            'password'          => Hash::make($data['password']),
            'email'             => $data['email'],
            'phone'             => isset($data['phone']) ? $data['phone'] : null,
            'address'           => isset($data['address']) ? $data['address'] : null,
        ]);
        $user->assignRole($data['roles']);
        return $user;
    }

    /**
     * @param Agent  $agent
     * @param array $data
     *
     * @return mixed
     */
    public function update(User $user, array $data) : User
    {
        $user->name = isset($data['name']) ? $data['name'] : $user->name ;
        $user->email = isset($data['email']) ? $data['email']: $user->email;
        $user->phone = isset($data['phone']) ? $data['phone'] : $user->phone;
        $user->address = isset($data['address']) ? $data['address'] : $user->address;
        $user->password = isset($data['password'])? Hash::make($data['password']) : $user->password;

        if ($user->isDirty()) {
            $user->save();
        }

        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
    
        $user->assignRole($data['roles']);

        return $user->refresh();
    }

    /**
     * @param User $agent
     */
    public function destroy(User $user)
    {
        $deleted = $this->deleteById($user->id);

        if ($deleted) {
            $user->save();
        }
    }
}
