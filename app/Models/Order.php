<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $primaryKey = 'OID';
    
    public function customer()
    {
        return $this->belongsTo(Customer::class,'CID');
    }
}
