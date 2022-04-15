<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    //
    public function getAll(){
        return Employee::all();
    }

    public function get(Request $req){
        $employee=Employee::where('EID',$req->id)->first();
        if($employee){
            return response()->json($employee,200);
        }
        return response()->json(["msg"=>"Employee Not Found"],404);
    }

    public function addEmployee(Request $req){
        try{
           $employee=new Employee();
           $employee->ENAME = $req->ENAME;
           $employee->EEMAIL= $req->EEMAIL ;
           $employee->EPASSWORD = md5($req->EPASSWORD);
           $employee->EPHONE = $req->EPHONE;
           $employee->ESALARY = $req->ESALARY;
           $employee->EADDRESS = $req->EADDRESS;
           $employee->ESCHEDULE = $req->ESCHEDULE;

           if($req->hasfile('EPICTURE')){
               $file=$req->file('EPICTURE');
               $extension=$file->getClientOriginalExtension();
               $filename=time().'.'. $extension;
               $file->move('uploads/employees/',$filename);
               $employee->EPICTURE = $filename;
   
           }
           $employee->save();
           if($employee->save()){

               return response()->json(["msg"=>"Employee Added Successfully"],200);
           }
       }
       catch(\Exception $ex){
           return response()->json(["msg"=>"Employee Could not add"],500);
       }
                   
   }



   
   public function updateEmployee(Request $req){
    $employee=Employee::where('EID',$req->id)->first();
    if($employee){
        try{
            $employee->ENAME = $req->ENAME;
            $employee->EEMAIL= $req->EEMAIL ;
            // $employee->EPASSWORD = md5($req->EPASSWORD);
            $employee->EPHONE = $req->EPHONE;
            $employee->ESALARY = $req->ESALARY;
            $employee->EADDRESS = $req->EADDRESS;
            $employee->ESCHEDULE = $req->ESCHEDULE;
            if($req->hasfile('EPICTURE')){
                $file=$req->file('EPICTURE');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'. $extension;
                $file->move('uploads/employees/',$filename);
                $employee->EPICTURE = $filename;
    
            }
            $employee->save();
            if($employee->save()){
    
                return response()->json(["msg"=>"Employee Updated Successfully"],200);
            }
         }
         catch(\Exception $ex){
             return response()->json(["msg"=>"Employee could not updated"],500);
         }
           
    }
    return response()->json(["msg"=>"Employee Not Found"],404);
     
}

   public function deleteEmployee($id){
    $employee=Employee::where('EID',$id)->first();
      if($employee){ 
        $employee= $employee->delete();
        if ($employee){
            return response()->json(["msg"=>"Employee Delete Successfully"],200);
           }
           return response()->json(["msg"=>"Employee Delete Failed"],500);
       }
       return response()->json(["msg"=>"Employee Not Found"],404);
   }



}
