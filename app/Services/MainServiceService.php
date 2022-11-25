<?php
 
namespace App\Services;

use Exception;
use App\Models\MainService;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Services\Interfaces\MainServiceInterface;
use App\Repositories\Backend\MainServiceRepository;

class MainServiceService implements MainServiceInterface
{
    protected $mainserviceRepository;
    protected $userService;

    public function __construct(MainServiceRepository $mainserviceRepository, UserService $userService)
    {
        $this->mainserviceRepository = $mainserviceRepository;
        $this->userService = $userService;
    }

    public function getMainServices()
    {
        return $this->mainserviceRepository->orderBy('created_at','desc')->get();
    }

    public function getMainService(MainService $main_service)
    {
        return $this->mainserviceRepository->getMainService($main_service->id);
    }

    public function create(array $data)
    { 

        $data['createdBy'] = $this->userService->getAuthenticatedUser()->id;

        $result = $this->mainserviceRepository->create($data);
        return $result;
    }

    public function update(MainService $main_service,array $data)
    {
        // $data['updatedBy'] = $this->userService->getAuthenticatedUser()->id;

        DB::beginTransaction();
        try {
            $result = $this->mainserviceRepository->update($main_service, $data);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to update main service');
        }
        DB::commit();

        return $result;
    }

    public function destroy(MainService $main_service)
    {
        DB::beginTransaction();
        try {
            $result = $this->mainserviceRepository->destroy($main_service);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to delete main service');
        }
        DB::commit();
        
        return $result;
    }
}