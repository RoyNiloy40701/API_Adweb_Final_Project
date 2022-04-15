<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deliveryman;

class DeliverymanController extends Controller
{
    //
    public function getAll(){
        return Deliveryman::all();
    }



    public function addDeliveryman(Request $req){
        try{
           $deliveryman=new Deliveryman();
           $deliveryman->DNAME = $req->DNAME;
           $deliveryman->DEMAIL= $req->DEMAIL ;
           $deliveryman->DPASSWORD = md5($req->DPASSWORD);
           $deliveryman->DPHONE = $req->DPHONE;
           $deliveryman->DSALARY = $req->DSALARY;
           $deliveryman->DADDRESS = $req->DADDRESS;
           $deliveryman->DSCHEDULE = $req->DSCHEDULE;

        

           if($req->hasfile('DPICTURE')){
               $file=$req->file('DPICTURE');
               $extension=$file->getClientOriginalExtension();
               $filename=time().'.'. $extension;
               $file->move('uploads/deliverymans/',$filename);
               $deliveryman->DPICTURE = $filename;
   
           }
           $deliveryman->save();
           if($deliveryman->save()){

               return response()->json(["msg"=>"Deliveryman Added Successfully"],200);
           }
       }
       catch(\Exception $ex){
           return response()->json(["msg"=>"Deliveryman Could not add"],500);
       }
                   
   }


   public function updateDeliveryman(Request $req){
    $deliveryman=Deliveryman::where('DID',$req->id)->first();
    if($deliveryman){
        try{
       
            $deliveryman->DNAME = $req->DNAME;
            $deliveryman->DEMAIL= $req->DEMAIL ;
            // $deliveryman->DPASSWORD = md5($req->DPASSWORD);
            $deliveryman->DPHONE = $req->DPHONE;
            $deliveryman->DSALARY = $req->DSALARY;
            $deliveryman->DADDRESS = $req->DADDRESS;
            $deliveryman->DSCHEDULE = $req->DSCHEDULE;

             if($req->hasfile('DPICTURE')){
               $file=$req->file('DPICTURE');
               $extension=$file->getClientOriginalExtension();
               $filename=time().'.'. $extension;
               $file->move('uploads/deliverymans/',$filename);
               $deliveryman->DPICTURE = $filename;
   
           }
           $deliveryman->save();
           if($deliveryman->save()){
    
                return response()->json(["msg"=>"Deliveryman  Updated Successfully"],200);
            }
         }
         catch(\Exception $ex){
             return response()->json(["msg"=>"Deliveryman  could not updated"],500);
         }
           
    }
    return response()->json(["msg"=>"Deliveryman  Not Found"],404);
     
}
}
