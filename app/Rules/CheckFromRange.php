<?php

namespace App\Rules;

use App\Models\DeliveryFee;
use Illuminate\Contracts\Validation\Rule;

class CheckFromRange implements Rule
{
    public $to;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($to,$delivery_type)
    {
        $this->to = $to;
        $this->delivery_type = $delivery_type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $from = DeliveryFee::where(function($query) use ($value){
            $query->where('to', '>=', $value)
               ->where('from', '<=', $this->to);
            })->where('delivery_type',$this->delivery_type);
       if($from->count()==0){
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The from range is already specified';
    }
}
