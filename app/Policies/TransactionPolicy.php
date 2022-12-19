<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\AuthorizationException;

class TransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the customer can view any models.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Customer $customer)
    {
        //
    }

    /**
     * Determine whether the customer can view the model.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Customer $customer, Transaction $transaction)
    {

        if (optional($transaction)->id) {
            return ($customer->id === $transaction->customer_id);
        } else {
            throw new AuthorizationException("This action is unauthorized.");
        }
    }

    /**
     * Determine whether the customer can create models.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Customer $customer)
    {
        //
    }

    /**
     * Determine whether the customer can update the model.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Customer $customer, Transaction $transaction)
    {
        //
    }

    /**
     * Determine whether the customer can delete the model.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Customer $customer, Transaction $transaction)
    {
        //
    }

    /**
     * Determine whether the customer can restore the model.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Customer $customer, Transaction $transaction)
    {
        //
    }

    /**
     * Determine whether the customer can permanently delete the model.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Customer $customer, Transaction $transaction)
    {
        //
    }
}
