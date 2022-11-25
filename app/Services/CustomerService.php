<?php

namespace App\Services;

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
}