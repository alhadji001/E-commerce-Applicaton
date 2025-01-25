<?php

namespace App\Http\Controllers\api;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    
    public function index()
    {
        //get all aboutUs
        $allAboutUs = AboutUs::All();
        if(!empty($allAboutUs))
        {
            return response()->json(
                ['success'=>true , 'message'=>'found' ,'aboutUs'=>$allAboutUs]);
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found' ,'aboutUs'=>$allAboutUs]);
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
        $aboutUs = AboutUs::create($request->only('name' , 'role' , 'email' ,'url_image'));
        if(!empty($aboutUs))
        return response()->json(
            ['success'=>true , 'message'=>'added successfully' ,'aboutUs'=>$aboutUs]
        );
        return response()->json(
            ['success'=>false , 'message'=>'not added', 'aboutUs'=>null]
        );
    }

    public function show($id)
    {
        $aboutUs = AboutUs::find($id);
        if($aboutUs){
        return response()->json(
            ['success'=>true , 'aboutUs'=>$aboutUs]
        );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'AboutUs'=>null]
        );
    }

    public function update(Request $request , $name)
    {
        $aboutUs = AboutUs::where('name' , $name)->first();
        if(!empty($aboutUs))
        {
            $aboutUs->update($request->only('name' ,'role' , 'email','url_image'));
            return response()->json([ 'success'=>true , 'message'=>'Updated successfully'] );
        }
        return response()->json([ 'success'=>false , 'message'=>'not updated'] );
    }

    public function destroy($id)
    {
        $aboutUs = AboutUs::find($id);
        if(!empty($aboutUs) && $aboutUs->delete())
        {
            return response()->json(
                ['success'=>true , 'message'=>'deleted succesfully']
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not deleted or does not exist'] );
    }
}
