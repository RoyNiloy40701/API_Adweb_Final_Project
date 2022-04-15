<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryman extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $primaryKey = 'DID';

    public function orders(){
        return $this->hasMany(Order::class,'DID');
    }
   

   
}
