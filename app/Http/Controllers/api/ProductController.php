<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    
    public function store(Request $request)
    {
        ProductDetail::create($request->only('image2_url','image3_url','size','color','volume',
        'dimension','weight','full_description','is_new','is_trending','is_featured'));

        $productDetail = ProductDetail::where('image2_url',$request->image2_url)->where('image3_url',$request->image3_url)->first();
        $is_save = Product::create($request->only('name','image1_url','price','fake_price','tag',
        'short_description','discount_percentage','sub_category','brand','supplier','has_coupon','quantity')+['product_detail'=>$productDetail->id]);

        if($is_save)
        {
            return response()->json(
            ['success'=>true , 'message'=>'added successfully' ,'product'=>$is_save] );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not added', 'product'=>null]
        );
    }

    public function index()
    {
        $products = Product::All();
        if($products){
            $i = 0;
            foreach($products as $product){
                $productDetail = ProductDetail::where('id',$product->product_detail)->first();
                $brand = Brand::where('id',$product->brand)->first();
                $category = SubCategory::where('id',$product->sub_category)->first();
                $supplier = User::where('id',$product->supplier)->where('type','salesperson')->first();
                $product['category'] =  $category->name;
                $product['brand'] =  $brand->name;
                $product['supplier'] =  $supplier->first_name.' '.$supplier->last_name;
                $product['other details '] =  $productDetail;
                $i++;
            }
        return response()->json(
            ['success'=>true , 'products'=>$products]
        );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'city'=>null]
        );
    }

    public function show($id)
    {
        $product = Product::find($id);
        if($product){
            $productDetail = ProductDetail::where('id',$product->product_detail)->first();
            $brand = Brand::where('id',$product->brand)->first();
            $category = SubCategory::where('id',$product->sub_category)->first();
            $supplier = User::where('id',$product->supplier)->where('type','salesperson')->first();
            $product['category'] =  $category->name;
            $product['brand'] =  $brand->name;
            $product['supplier'] =  $supplier->first_name.' '.$supplier->last_name;
            $product['other details '] =  $productDetail;
        return response()->json(
            ['success'=>true , 'product'=>$product]
        );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'product'=>null]
        );
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if($product && $product->delete())
        {
            $productDetail = ProductDetail::find($product->product_detail);
            if($productDetail){
                $productDetail->delete();
            }
            return response()->json(
                ['success'=>true , 'message'=>'deleted succesfully']
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not deleted or does not exist']
        );
    }

    public function edit()//to do
    {

    }
    public function update()//to do
    {

    }


}
