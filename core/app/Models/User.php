<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\Searchable;
use App\Traits\UserNotify;

class User extends Authenticatable
{
    use HasApiTokens, Searchable, UserNotify;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','ver_code','balance','kyc_data'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'address' => 'object',
        'kyc_data' => 'object',
        'ver_code_send_at' => 'datetime'
    ];

    public function domains(){
        return $this->hasMany(Domain::class);
    }

    public function hostings(){
        return $this->hasMany(Hosting::class);
    }

    public function loginLogs()
    {
        return $this->hasMany(UserLogin::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->orderBy('id','desc');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class)->where('status','!=',0);
    }

    public function fullname(): Attribute
    {
        return new Attribute(
            get: fn () => $this->firstname . ' ' . $this->lastname,
        );
    }

    // SCOPES
    public function scopeActive($query)
    {
        return $query->where('status', 1)->where('ev', 1)->where('sv', 1);
    }

    public function scopeBanned($query)
    {
        return $query->where('status', 0);
    }

    public function scopeEmailUnverified($query)
    {
        return $query->where('ev', 0);
    }

    public function scopeMobileUnverified($query)
    {
        return $query->where('sv', 0);
    }

    public function scopeKycVerified($query)
    {
        return $query->where('kv', 1);
    }

    public function scopeKycUnverified($query)
    {
        return $query->where('kv', 0);
    }

    public function scopeKycPending($query)
    {
        return $query->where('kv', 2);
    }

    public function scopeEmailVerified($query)
    {
        return $query->where('ev', 1);
    }

    public function scopeMobileVerified($query)
    {
        return $query->where('sv', 1);
    }

    public function scopeWithBalance($query)
    {
        return $query->where('balance','>', 0);
    }

}
