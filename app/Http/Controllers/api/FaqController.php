<?php

namespace App\Http\Controllers\api;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    
    public function index()
    {
        //get all faqs
        $faqs = Faq::All();
        if(!empty($faqs))
        {
            return response()->json(
                ['success'=>true , 'message'=>'found' ,'faqs'=>$faqs]);
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found' ,'faqs'=>$faqs]);
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
        $faq = Faq::create($request->only('question' ,'answer'));
        if(!empty($faq))
        return response()->json(
            ['success'=>true , 'message'=>'added successfully' ,'faq'=>$faq]
        );
        return response()->json(
            ['success'=>false , 'message'=>'not added', 'faq'=>null]
        );
    }

    public function show($id)
    {
        $faq = Faq::find($id);
        if($faq){
        return response()->json(
            ['success'=>true , 'faq'=>$faq]
        );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'Faq'=>null]
        );
    }

    public function update(Request $request , $question)
    {
        $faq = Faq::where('question' , $question)->first();
        if(!empty($faq))
        {
            $faq->update($request->only('question' ,'answer'));
            return response()->json([ 'success'=>true , 'message'=>'Updated successfully'] );
        }
        return response()->json([ 'success'=>false , 'message'=>'not updated'] );
    }

    public function destroy($id)
    {
        $faq = Faq::find($id);
        if(!empty($faq) && $faq->delete())
        {
            return response()->json(
                ['success'=>true , 'message'=>'deleted succesfully']
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not deleted or does not exist'] );
    }

}