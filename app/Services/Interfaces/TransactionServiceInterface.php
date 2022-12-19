<?php

namespace App\Services\Interfaces;

use App\Models\Transaction;

interface TransactionServiceInterface
{
    public function getTransactions();
    public function getTransaction($id);
    public function create(array $data); 
}