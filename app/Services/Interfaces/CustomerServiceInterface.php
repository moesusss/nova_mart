<?php
namespace App\Services\Interfaces;

interface CustomerServiceInterface
{
    public function getCustomer($id);
    public function getCustomers();
    public function getFilterCustomers($request);
    public function getCount($query);
}