<?php

namespace App\Services;

use Exception;
use App\Models\Customer;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Backend\CustomerRepository;
use App\Services\Interfaces\CustomerServiceInterface;

class CustomerService implements CustomerServiceInterface
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository )
    {
        $this->customerRepository = $customerRepository;
    }

    public function getCustomers()
    {
        return $this->customerRepository->getCustomers();
    }

    public function getFilterCustomers($request)
    {
        return $this->customerRepository->getCustomers($request);
    }

    public function getCustomer($id)
    {
        return $this->customerRepository->getCustomer($id);
    }

    public function getCount($query){
        return $this->customerRepository->getCount($query);
    }

    // change Status
    public function changeStatus(Customer $customer)
    {

        DB::beginTransaction();
        try {
            $result = $this->customerRepository->changeStatus($customer);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to active customer');
        }
        DB::commit();

        return $result;
    }
}