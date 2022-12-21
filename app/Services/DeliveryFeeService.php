<?php
 
namespace App\Services;

use Exception;
use App\Models\DeliveryFee;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Backend\DeliveryFeeRepository;
use App\Services\Interfaces\DeliveryFeeServiceInterface;

class DeliveryFeeService implements DeliveryFeeServiceInterface
{
    protected $deliveryfeeRepository;
    protected $userService;

    public function __construct(DeliveryFeeRepository $deliveryfeeRepository, UserService $userService)
    {
        $this->deliveryfeeRepository = $deliveryfeeRepository;
        $this->userService = $userService;
    }

    public function getDeliveryFees()
    {
        if( request()->is('api/*')){
            return $this->deliveryfeeRepository->getDeliveryFees();
        }
        return $this->deliveryfeeRepository->orderBy('created_at','desc')->get();
    }

    public function getDeliveryFee(DeliveryFee $delivery_fee)
    {
        return $this->deliveryfeeRepository->getDeliveryFee($delivery_fee->id);
    }

    public function create(array $data)
    { 
        $result = $this->deliveryfeeRepository->create($data);
        return $result;
    }

    public function update(DeliveryFee $delivery_fee,array $data)
    {
        // $data['updatedBy'] = $this->userService->getAuthenticatedUser()->id;

        DB::beginTransaction();
        try {
            $result = $this->deliveryfeeRepository->update($delivery_fee, $data);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to update delivery fee');
        }
        DB::commit();

        return $result;
    }

    public function destroy(DeliveryFee $delivery_fee)
    {
        DB::beginTransaction();
        try {
            $result = $this->deliveryfeeRepository->destroy($delivery_fee);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to delete delivery fee');
        }
        DB::commit();
        
        return $result;
    }

    // change Status
    public function changeStatus(DeliveryFee $delivery_fee)
    {

        DB::beginTransaction();
        try {
            $result = $this->deliveryfeeRepository->changeStatus($delivery_fee);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to active delivery fee');
        }
        DB::commit();

        return $result;
    }
}