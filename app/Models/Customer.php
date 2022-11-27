<?php


  
namespace App\Models;

use App\Traits\Uuids;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
  
class Customer extends Authenticatable
{
    use  HasFactory, Notifiable, HasRoles, Uuids, HasApiTokens;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [
        'name', 'email', 'mobile', 'is_active', 'password'
    ];
  
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array

     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
  
    /**
     * The attributes that should be cast.
     *
     * @var array

     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the address for customer.
     */

    public function customer_addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }
}
