<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use Mail;
use Session;
use App\Models\Pending_user;
use App\Models\Customer;

class PagesController extends Controller
{
    //
    public function login(Request $req){
        $customer=Customer::where('CID',$req->id)->first();
        $man = Customer::where('CEMAIL',$req->CEMAIL)
        ->where('CPASSWORD',md5($req->CPASSWORD))
        ->first();
    
       
        if($man){
           
            return response()->json(["msg"=>"Login Successfully"],200);
             
        }
         return response()->json(["msg"=>"Login Failed"],404);
  
    }
        
    public function mail(Request $request){
        $data = ['name'=>"Niloy Roy", 'data'=>'Hello Dev'];

       

        $emailAddress = $request->CEMAIL;

        $user['to'] = $emailAddress;

        Mail::send('mail',$data,function($messages) use ($user){

            $otp = rand(1000,9999);

            Session::put('otp', $otp);

            // $user = user::where('email','=',$emailAddress)->update(['OTP' => $otp]);

            $messages->to($user['to']);

            $messages->subject('Your OTP is : '. $otp);

            // $messages->body('Your OTP is : '. $otp);

        });

        $OTPFromSession = Session::get('otp');

         $user = Pending_user::where('CEMAIL','=',$emailAddress)->update(['OTP' => $OTPFromSession]);
        return "Mail Sent"; 

    }
    public function verifyOTP(Request $req){

        $pendingUser = Pending_user::where('OTP', $req->OTP)->first();
       if($pendingUser){
        try{

        $customer=new Customer();
        $customer->CNAME = $pendingUser->CNAME;
        $customer->CEMAIL= $pendingUser->CEMAIL;
        $customer->CPASSWORD =($pendingUser->CPASSWORD);
        // $customer->CADDRESS = $req->CADDRESS;
        $customer->CPHONE = $pendingUser->CPHONE;

        $customer->save();
        if( $customer->save()){
            $pendingUser= $pendingUser->delete();
            return response()->json(["msg"=>" Registration Successfully"],200);
        }
        }
         catch(\Exception $ex){
        return response()->json(["msg"=>"Registration Failed"],500);
     }
    }
    return response()->json(["msg"=>"Please enter correct OTP"],500);
}
}
