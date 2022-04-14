<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;

class ManagerController extends Controller
{
    //

    public function get(Request $req){
        $manager=Manager::where('MID',$req->id)->first();
        if($manager){
            return response()->json($manager,200);
        }
        return response()->json(["msg"=>"Manager Not Found"],404);
    }


    public function updateManager (Request $req){
        $manager=Manager::where('MID',$req->id)->first();
        if($manager){
            try{
                $manager->MNAME = $req->MNAME;
                $manager->MEMAIL= $req->MEMAIL ;
                $manager->MPASSWORD = md5($req->MPASSWORD);
                $manager->MPHONE = $req->MPHONE;
                $manager->MADDRESS = $req->MADDRESS;

                if($req->hasfile('MPICTURE')){
                    $file=$req->file('MPICTURE');
                    $extension=$file->getClientOriginalExtension();
                    $filename=time().'.'. $extension;
                    $file->move('uploads/managers/',$filename);
                    $man->MPICTURE = $filename;
        
                }
                
                $manager->save();
                if($manager->save()){
        
                    return response()->json(["msg"=>"Manager Updated Successfully"],200);
                }
             }
             catch(\Exception $ex){
                 return response()->json(["msg"=>"Manager could not updated"],500);
             }
               
        }
        return response()->json(["msg"=>"Manager Not Found"],404);



    }



}
