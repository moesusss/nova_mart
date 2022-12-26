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
use App\Repositories\api\v1\Customer\TransactionProcessorRepository;

class TransactionService implements TransactionServiceInterface
{
    protected $transactionRepository;
    protected $transactionProcessorRepository;

    public function __construct(TransactionRepository $transactionRepository,
                    TransactionProcessorRepository $transactionProcessorRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->transactionProcessorRepository = $transactionProcessorRepository;
    }

    public function getTransactions()
    {
        return $this->transactionRepository->getTransactions();
    }

    public function getTransactionsByAuthUser()
    {
        return $this->transactionRepository->getTransactionsByAuthUser();
    }

    public function getTransaction($id)
    {
        return $this->transactionRepository->getTransaction($id);
    }
    
   
    public function create(array $data)
    {       
        DB::beginTransaction();
        try {
            $result = $this->transactionRepository->create($data);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to update transaction');
        }
        DB::commit(); 
        
        return $result;
    }

    public function check_transaction(array $data)
    {       
        DB::beginTransaction();
        try {
            $result = $this->transactionProcessorRepository->check($data);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to check transaction');
        }
        DB::commit(); 
        
        return $result;
    }

    public function getTransactionProcessor($token)
    {
        return $this->transactionProcessorRepository->getTransactionProcessor($token);
    }

}


