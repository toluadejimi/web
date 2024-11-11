<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'amount'];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }

    public function domain(){
        return $this->belongsTo(Domain::class, 'domain_id');
    }

    public function hosting(){
        return $this->belongsTo(Hosting::class, 'hosting_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}


