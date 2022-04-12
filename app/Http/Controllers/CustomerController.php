<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

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
            $customer=new Customer();
            $customer->CNAME = $req->CNAME;
            $customer->CEMAIL= $req->CEMAIL;
            $customer->CPASSWORD = md5($req->CPASSWORD);
            $customer->CADDRESS = $req->CADDRESS;
            $customer->CPHONE = $req->CPHONE;
            if($req->hasfile('CPICTURE')){
                $file=$req->file('CPICTURE');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'. $extension;
                $file->move('uploads/customers/',$filename);
                $customer->CPICTURE = $filename;

            }
           
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
