<?php

namespace App\Http\Controllers\api\v1\Customer;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use App\Http\Resources\api\v1\Customer\Transaction\TransactionResource;
use App\Http\Requests\api\Customer\Transaction\CreateTransactionRequest;
use App\Http\Resources\api\v1\Customer\Transaction\TransactionCollection;

class TransactionController extends Controller
{
 /**
     * @var TransactionService
     */
    protected $transactionService;

    /**
     * TransactionController constructor.
     *
     * @param TransactionService $transactionService
     */
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transactions = $this->transactionService->getTransactions();
        return new TransactionCollection($transactions);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTransactionRequest $request)
    {
        $transaction = $this->transactionService->create($request->all());
        return new TransactionResource($transaction);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction->load(['categories']));
    }

    
}
