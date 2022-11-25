<?php

namespace App\Repositories\Backend;

use App\Models\MainService;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;

class MainServiceRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return MainService::class;
    }
    
    /**
     * @param string $id
     *
     * @return MainService
     */
    public function getMainService($id)
    {
        return $this->getById($id);
    }

    /**
     * @param array $data
     *
     * @return MainService
     */
    public function create(array $data)
    {
        return MainService::create([
            'code' => $data['code'],
            'name' => $data['name'],
            'mm_name' => $data['mm_name']
        ]);
    }

    /**
     * @param MainService  $main_service
     * @param array $data
     *
     * @return mixed
     */
    public function update(MainService $main_service, array $data)
    {
       $main_service->code = $data['code'];
       $main_service->name = $data['name'];
       $main_service->mm_name = $data['mm_name'];
       if($main_service->isDirty()){
        //    $main_service->updated_by = $data['updatedBy'];
           $main_service->save();
       }
       return $main_service->refresh();
    }

    /**
     * @param MainService  $main_service
     * @param array $data
     *
     * @return mixed
     */
    public function changeStatus(MainService $main_service)
    {
       if($main_service->is_active==0){
            $main_service->is_active=1;
       }else{
            $main_service->is_active=0;
       }
       if($main_service->isDirty()){
        //    $main_service->updated_by = $data['updatedBy'];
           $main_service->save();
       }
       return $main_service->refresh();
    }

    /**
     * @param MainService $main_service
     */
    public function destroy(MainService $main_service)
    {   
        $this->deleteById($main_service->id);
    }
}
