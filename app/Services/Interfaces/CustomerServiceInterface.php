<?php
namespace App\Services\Interfaces;

use App\Models\Category;
use App\Models\Customer;

interface CustomerServiceInterface
{
    public function getCustomer($id);
    public function getCustomers();
    public function getFilterCustomers($request);
    public function getCount($query);
    public function changeStatus(Customer $customer);
}