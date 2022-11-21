<?php

namespace App\Repositories\Backend;

use Spatie\Permission\Models\Role;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class RoleRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * @param array $data
     *
     * @return Role
     */
    public function create(array $data) : Role
    {
        $role = Role::create([
            'name'   => $data['name'],
        ]);
        $role->syncPermissions($data['permission']);
        return $role;
    }

    /**
     * @param Agent  $agent
     * @param array $data
     *
     * @return mixed
     */
    public function update(Role $role, array $data) : Role
    {
        $role->name = isset($data['name']) ? $data['name'] : $role->name ;
       
        if ($role->isDirty()) {
            $role->save();
        }

        $role->syncPermissions($data['permission']);

        return $role->refresh();
    }

    /**
     * @param Role $role
     */
    public function destroy(Role $role)
    {
        $deleted = $this->deleteById($role->id);

        if ($deleted) {
            $role->save();
        }
    }
}
