<?php

namespace App\Services;

use Exception;
use App\Models\Transaction;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\TransactionServiceInterface;
use App\Repositories\api\v1\Customer\TransactionRepository;

class TransactionService implements TransactionServiceInterface
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getTransactions()
    {
    return $this->transactionRepository->getTransactions();
        
    }

    public function getTransaction($id)
    {
        return $this->transactionRepository->getTransaction($id);
    }
    
   
    public function create(array $data)
    {        
        $result = $this->transactionRepository->create($data);
        return $result;
    }

}