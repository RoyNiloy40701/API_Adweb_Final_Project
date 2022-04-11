<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
   
    public function getAll(){
        return Product::all();
    }


    public function get(Request $req){
        $product=Product::where('PID',$req->id)->first();
        if($product){
            return response()->json($product,200);
        }
        return response()->json(["msg"=>"Product Not Found"],404);
    }



    public function addProduct(Request $req){
         try{
            $product=new Product();
            $product->PNAME = $req->PNAME;
            $product->PSHOP= $req->PSHOP ;
            $product->PDESCRIPTION = $req->PDESCRIPTION;
            $product->PBPRICE = $req->PBPRICE;
            $product->PCATEGORYID =  $req->PCATEGORYID;
            $product->MID= $req->MID;
            $product->PSTOCK = $req->PSTOCK;

            if($req->hasfile('PPICTURE')){
                $file=$req->file('PPICTURE');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'. $extension;
                $file->move('uploads/products/',$filename);
                $product->PPICTURE = $filename;

            }
            $product->save();
            if($product->save()){

                return response()->json(["msg"=>"Product Added Successfully"],200);
            }
        }
        catch(\Exception $ex){
            return response()->json(["msg"=>"Product Could not add"],500);
        }
                    
    }




    public function updateProduct(Request $req){
        $product=Product::where('PID',$req->id)->first();
        if($product){
            try{
                $product->PNAME = $req->PNAME;
                $product->PSHOP= $req->PSHOP ;
                $product->PDESCRIPTION = $req->PDESCRIPTION;
                $product->PBPRICE = $req->PBPRICE;
                $product->PCATEGORYID =  $req->PCATEGORYID;
                $product->MID= $req->MID;
                $product->PSTOCK = $req->PSTOCK;
                if($req->hasfile('PPICTURE')){
                    $file=$req->file('PPICTURE');
                    $extension=$file->getClientOriginalExtension();
                    $filename=time().'.'. $extension;
                    $file->move('uploads/products/',$filename);
                    $product->PPICTURE = $filename;
        
                }
                $product->save();
                if($product->save()){
        
                    return response()->json(["msg"=>"Product Updated Successfully"],200);
                }
            }
            catch(\Exception $ex){
                return response()->json(["msg"=>"Product could not updated"],500);
            }
               
        }
        return response()->json(["msg"=>"Product Not Found"],404);
         
    }



    public function deleteProduct($id){
     $product=Product::where('PID',$id)->first();
     if($product){ 
         $product= $product->delete();
         if ($product){
             return response()->json(["msg"=>"Product Delete Successfully"],200);
            }
            return response()->json(["msg"=>"Product Delete Failed"],500);
        }
        return response()->json(["msg"=>"Product Not Found"],404);
    }


}
