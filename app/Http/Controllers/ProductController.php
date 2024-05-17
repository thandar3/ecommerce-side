<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list for Admin
    public function productAdminList(){
        $products = Product::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })->get();
        return view('admin.product.productList',compact('products'));
    }

    //product create
    public function productCreate(){
        $categoryItems =Category::select('name')->get();
        return view('admin.product.create',compact('categoryItems',));
    }

    //product data store
    public function productCreated(Request $request){
       $this->prodcutCreateValidation($request);
       $data = $this->productCreatedList($request);

        $fileName = uniqid().$request->file('product_image')->getCLientOriginalName();
        $request->file('product_image')->storeAs('public/ProductsImages',$fileName);
        $data['image'] =$fileName;

       Product::create($data);
       return redirect()->route('productAdmin#List')->with(['createSuccess' => 'Your product created']);
    }

    //product delete
    public function productDelete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('productAdmin#List')->with(['deleteSuccess' => 'Your product delected!']);
    }

    //prodcut edit Page
    public function editPage($id){
       $product =  Product::where('id',$id)->first();
       $products = Product::get();
        return view('admin.product.edit',compact('product','products'));
    }

    //updated products
    public function updatedPage(Request $request){

        $this->editProductValidation($request);
        $datas = $this->productUpdateList($request);

        if($request->hasFile('product_image')){

            $oldImage = Product::where('id',$request->product_id)->first();
            $oldImage = $oldImage->image;

            if($oldImage != null){
                Storage::delete('public/ProductsImages'. $oldImage);
            }

            $fileName = uniqid().$request->file('product_image')->getClientOriginalName();
            $request->file('product_image')->storeAs('public/ProductsImages',$fileName);
            $datas['image'] = $fileName;
        }

        Product::where('id',$request->product_id)->update($datas);
        return redirect()->route('productAdmin#List')->with(['updatedSuccess' => 'Your Product updated']);
    }

    //edit data
    private function productUpdateList($request){
        return [
            'name' => $request->product_name,
            'description' => $request->product_description,
            'product_category' => $request->product_category,
            'price' => $request->product_price,

        ];
    }

    //edit data validation
    private function editProductValidation($request){
        $productFormValidation = [
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
            'product_category' => 'required',

        ];

        Validator::make($request->all(),$productFormValidation)->validate();
    }

    //data store for product
    private function productCreatedList($request){
        return [
            'name' => $request->product_name,
            'description' => $request->product_description,
            'product_category' => $request->product_category,
            'price' => $request->product_price,
        ];
    }

    //validatino for product create form
    private function prodcutCreateValidation($request){
        $validationCheck = [
            'product_name' => 'required',
            'product_category' => 'required',
            'description' => 'required',
            'product_price' => 'required',
            'product_image' => 'required|mimes:jpg,png,jpeg|file',
        ];

        Validator::make($request->all(),$validationCheck)->validate();
    }
}
