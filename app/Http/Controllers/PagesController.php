<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;

class PagesController extends Controller
{
    //
    public function login(Request $req){
        
        $man = Manager::where('MEMAIL',$req->MEMAIL)
        ->where('MPASSWORD',md5($req->MPASSWORD))
        ->first();
     
       
        if($man){
           
            return response()->json(["msg"=>"Login Successfully"],200);
             
        }
         return response()->json(["msg"=>"Login Failed"],404);
  
    }
}
