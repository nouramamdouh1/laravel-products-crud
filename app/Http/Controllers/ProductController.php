<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\storeproductrequest;
use App\Http\Requests\updateproductrequest;
use App\Http\Services\Media;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
   {
        $brands=DB::table('brands')->select('id','name')->get();
        return view('createproduct',compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeproductrequest $request)
    {
            //insert into database
            $newimagename=Media::upload($request->file('image'),'images\products');
            $data=$request->except('_token' , 'image');
            $data['image']=$newimagename;
            // DB::table('products')->insert($data)


            if(Product::create($data)){
                return redirect()->route('index')->with('success','added successfully');
            }else{
                return redirect()->route('products.create')->with('error','can not added ');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands=DB::table('brands')->select('id','name')->get();
        return view('editproducts',compact('brands','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateproductrequest $request, Product $product)
    {
         
            if($request->hasfile('image')){
                $newimagename=Media::upload($request->file('image'),'images\products');
                $data=$request->except('_token','_method','image');
                $data['image']=$newimagename;
    
                //delete old image from folder
                $photoname=$product->image;
                Media::delete(public_path("\images\products\\{$photoname}"));
            }
           
            
            if($product->update($data)){
                return redirect()->route('index')->with('success','updated successfully');
            }else{
                return redirect()->route('index')->with('error','can not updated ');
            }
          
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $photoname=$product->image;
        Media::delete(public_path("images\products\\{$photoname}"));
        if ($product->delete()) {
           return redirect()->route('index')->with('success','deleted successfully');
        }else{
            return redirect()->route('index')->with('error','can not delete ');
        

    }
}
}
