<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //

    public function getAll(){
        return Category::all();
    }
  

    public function addCategory(Request $req){
        try{
           $category=new category();
           $category->CATEGORYNAME = $req->CATEGORYNAME;
           $category->save();
           if($category->save()){

               return response()->json(["msg"=>"Category Added Successfully"],200);
           }
       }
       catch(\Exception $ex){
           return response()->json(["msg"=>"Category Could not add"],500);
       }
                   
   }

   public function updateCategory(Request $req){
    $category=Category::where('CATEGORYID',$req->id)->first();
    if($category){
        try{
            $category->CATEGORYNAME = $req->CATEGORYNAME;
          
            $category->save();
            if($category->save()){
    
                return response()->json(["msg"=>"Category Updated Successfully"],200);
            }
         }
         catch(\Exception $ex){
             return response()->json(["msg"=>"Category could not updated"],500);
         }
           
    }
      return response()->json(["msg"=>"Category Not Found"],404);
     
 }


    public function deleteCategory($id){
     $category=Category::where('CATEGORYID',$id)->first();
      if($category){ 
        $category= $category->delete();
        if ($category){
            return response()->json(["msg"=>"Category Delete Successfully"],200);
           }
           return response()->json(["msg"=>"Category Delete Failed"],500);
       }
       return response()->json(["msg"=>"Category Not Found"],404);
   }


    public function detailsCategory(Request $req){
     $category = Category::where('CATEGORYID',$req->id)->first();
     if($category){
        
      $category->products = $category->products;
      return response()->json($category,200);   
     
     }
     return response()->json(["msg"=>"Category Not Found"],404);
   }




}
