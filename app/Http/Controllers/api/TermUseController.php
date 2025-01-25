<?php

namespace App\Http\Controllers\api;

use App\Models\TermUse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermUseController extends Controller
{
    
    public function index()
    {
        //get all terms
        $terms = TermUse::All();
        if(!empty($terms))
        {
            return response()->json(
                ['success'=>true , 'message'=>'found' ,'terms'=>$terms]);
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found' ,'terms'=>$terms]);
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
        $term = TermUse::create($request->only('title' ,'content'));
        if(!empty($term))
        return response()->json(
            ['success'=>true , 'message'=>'added successfully' ,'term'=>$term]
        );
        return response()->json(
            ['success'=>false , 'message'=>'not added', 'term'=>null]
        );
    }

    public function show($id)
    {
        $term = TermUse::find($id);
        if($term){
        return response()->json(
            ['success'=>true , 'term'=>$term]
        );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'TermUse'=>null]
        );
    }

    public function update(Request $request , $title)
    {
        $term = TermUse::where('title' , $title)->first();
        if(!empty($term))
        {
            $term->update($request->only('title' ,'content'));
            return response()->json([ 'success'=>true , 'message'=>'Updated successfully'] );
        }
        return response()->json([ 'success'=>false , 'message'=>'not updated'] );
    }

    public function destroy($id)
    {
        $term = TermUse::find($id);
        if(!empty($term) && $term->delete())
        {
            return response()->json(
                ['success'=>true , 'message'=>'deleted succesfully']
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not deleted or does not exist'] );
    }
}