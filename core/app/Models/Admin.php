<?php

namespace App\Models;

use App\Traits\Searchable;
use App\Traits\GlobalStatus;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Searchable, GlobalStatus;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $guarded = ['id'];

    protected $casts = [
        'address' => 'object',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function role(){
        return $this->belongsTo(Role::class);
    }
    
}
