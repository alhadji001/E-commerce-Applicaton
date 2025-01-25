<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        //get all categories
        $categories = Category::All();
        if(!empty($categories))
        {
            return response()->json(
                ['success'=>true , 'message'=>'found' ,'categories'=>$categories]);
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found' ,'categories'=>$categories]);
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
        $category = Category::create($request->only('name' , 'description'));
        if($category)
        return response()->json(
            ['success'=>true , 'message'=>'added successfully' ,'category'=>$category]
        );
        return response()->json(
            ['success'=>false , 'message'=>'not added', 'category'=>null]
        );
    }

    public function show($id)
    {
        $category = Category::find($id);
        if($category){
        return response()->json(
            ['success'=>true , 'category'=>$category]
        );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'Category'=>null]
        );
    }

    public function update(Request $request , $name)
    {
        $category = Category::where('name' , $name)->first();
        if(!empty($category))
        {
            $category->update($request->only('name' , 'description'));
            return response()->json([ 'success'=>true , 'message'=>'Updated successfully'] );
        }
        return response()->json([ 'success'=>false , 'message'=>'not updated'] );
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if(!empty($category) && $category->delete())
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
        $category = Category::where('name',$name)->first();
        if($category != null && $category->is_enabled > 0)
        {
            $category->is_enabled = 0;
            $category->save();
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
        $category = Category::where('name',$name)->first();
        if($category != null && $category->is_enabled < 1)
        {
            $category->is_enabled = 1;
            $category->save();
            return response()->json(
                ['success'=>true , 'message'=>'activated succesfully']
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not modified or activated']
        );
    }
}
