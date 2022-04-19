<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

use App\Models\Pending_user;

class CustomerController extends Controller
{
    //
    public function getAll(){
        return Customer::all();
    }

    public function get(Request $req){
        $customer=Customer::where('CID',$req->id)->first();
        if($customer){
            return response()->json($customer,200);
        }
        return response()->json(["msg"=>"Customer Not Found"],404);
    }

    public function deleteCustomer($id){
        $customer=Customer::where('CID',$id)->first();
          if($customer){ 
            $customer= $customer->delete();
            if ($customer){
                return response()->json(["msg"=>"Customer Delete Successfully"],200);
               }
               return response()->json(["msg"=>"Customer Delete Failed"],500);
           }
           return response()->json(["msg"=>"Customer Not Found"],404);
     }


    public function Registration(Request $req){
         try{
            // Pending_user

            $customer=new Pending_user();
            $customer->CNAME = $req->CNAME;
            $customer->CEMAIL= $req->CEMAIL;
            $customer->CPASSWORD = md5($req->CPASSWORD);
         
            $customer->CPHONE = $req->CPHONE;
          
           
            $customer->save();
           if( $customer->save()){

               return response()->json(["msg"=>" Registration Successfully"],200);
           }
       }
       catch(\Exception $ex){
           return response()->json(["msg"=>"Registration Failed"],500);
       }
    }
                   

}
