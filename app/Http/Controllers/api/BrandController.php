<?php

namespace App\Http\Controllers\api;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    
    public function index()
    {
        //get all brands
        $brands = Brand::All();
        if(!empty($brands))
        {
            return response()->json(
                ['success'=>true , 'message'=>'found' ,'brands'=>$brands]);
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found' ,'brands'=>$brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $brand = Brand::create($request->only('name' ,'url_logo', 'description'));
        if(!empty($brand))
        return response()->json(
            ['success'=>true , 'message'=>'added successfully' ,'brand'=>$brand]
        );
        return response()->json(
            ['success'=>false , 'message'=>'not added', 'brand'=>null]
        );
    }

    public function show($id)
    {
        $brand = Brand::find($id);
        if($brand){
        return response()->json(
            ['success'=>true , 'brand'=>$brand]
        );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'Brand'=>null]
        );
    }

    public function update(Request $request , $name)
    {
        $brand = Brand::where('name' , $name)->first();
        if(!empty($brand))
        {
            $brand->update($request->only('name' , 'url_logo' ,'description'));
            return response()->json([ 'success'=>true , 'message'=>'Updated successfully'] );
        }
        return response()->json([ 'success'=>false , 'message'=>'not updated'] );
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        if(!empty($brand) && $brand->delete())
        {
            return response()->json(
                ['success'=>true , 'message'=>'deleted succesfully']
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not deleted or does not exist'] );
    }

    public function disable($name)
    {
        $brand = Brand::where('name',$name)->first();
        if($brand != null && $brand->is_enabled > 0)
        {
            $brand->is_enabled = 0;
            $brand->save();
            return response()->json(
                ['success'=>true , 'message'=>'disactivated succesfully']
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not modified or disactivated']
        );
    }

    public function enable($name)
    {
        $brand = Brand::where('name',$name)->first();
        if($brand != null && $brand->is_enabled < 1)
        {
            $brand->is_enabled = 1;
            $brand->save();
            return response()->json(
                ['success'=>true , 'message'=>'activated succesfully']
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not modified or activated']
        );
    }
}
