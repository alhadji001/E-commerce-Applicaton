<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all Subcategories
        $subcategories = SubCategory::All();
        if(!empty($subcategories))
        {
            $i = 0;
            foreach($subcategories as $subcategory)
            {
                $category = Category::find($subcategory->category_id);
                $subcategories[$i++]['category'] = $category->name;
            }
            return response()->json(
                ['success'=>true , 'message'=>'found' ,'subcategories'=>$subcategories]);
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found' ,'subcategories'=>$subcategories]);
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

    public function edit($id)
    {
        //
    }

    public function store(Request $request)
    {
        $category = Category::where('name' , $request->category)->first();
        $subcategory = SubCategory::create($request->only('name' , 'description')+['category_id' => $category->id]);
        if(!empty($subcategory))
        return response()->json(
            ['success'=>true , 'message'=>'added successfully' ,'subcategory'=>$subcategory]
        );
        return response()->json(
            ['success'=>false , 'message'=>'not added', 'subcategory'=>null]
        );
    }

    public function show($id)
    {
        $subcategory = SubCategory::find($id);
        if($subcategory){
        return response()->json(
            ['success'=>true , 'subcategory'=>$subcategory]
        );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'subcategory'=>null]
        );
    }

    public function update(Request $request , $name)
    {
        $subcategory = SubCategory::where('name' , $name)->first();
        if(!empty($subcategory))
        {
            $category = Category::where('name' , $request->category)->first();
            $subcategory->update($request->only('name' , 'description')+['category_id' => $category->id]);
            return response()->json([ 'success'=>true , 'message'=>'Updated successfully'] );
        }
        return response()->json([ 'success'=>false , 'message'=>'not updated'] );
    }

    public function destroy($id)
    {
        $subcategory = SubCategory::find($id);
        if(!empty($subcategory) && $subcategory->delete())
        {
            return response()->json(
                ['success'=>true , 'message'=>'deleted succesfully']
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not deleted or does not exist'] );
    }

}
