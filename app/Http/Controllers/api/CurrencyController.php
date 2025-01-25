<?php

namespace App\Http\Controllers\api;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    
    public function index()
    {
        //get all currencies
        $currencies = Currency::All();
        if(count($currencies)>0)
        {
            return response()->json(
                ['success'=>true , 'message'=>'found' ,'currencies'=>$currencies]);
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found or empty' ,'currencies'=>$currencies]);
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
        $currency = Currency::create($request->only('name', 'url_symbol' , 'description'));
        if($currency)
        return response()->json(
            ['success'=>true , 'message'=>'added successfully' ,'currency'=>$currency]
        );
        return response()->json(
            ['success'=>false , 'message'=>'not added', 'currency'=>null]
        );
    }

    public function show($id)
    {
        $currency = Currency::find($id);
        if($currency){
        return response()->json(
            ['success'=>true , 'currency'=>$currency]
        );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'Currency'=>null]
        );
    }

    public function update(Request $request , $name)
    {
        $currency = Currency::where('name' , $name)->first();
        if($currency)
        {
            $currency->update($request->only('name' , 'url_symbol' , 'description'));
            return response()->json([ 'success'=>true , 'message'=>'Updated successfully'] );
        }
        return response()->json([ 'success'=>false , 'message'=>'not updated'] );
    }

    public function destroy($id)
    {
        $currency = Currency::find($id);
        if(!empty($currency) && $currency->delete())
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
        $currency = Currency::where('name',$name)->first();
        if($currency != null && $currency->is_enabled > 0)
        {
            $currency->is_enabled = 0;
            $currency->save();
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
        $currency = Currency::where('name',$name)->first();
        if($currency != null && $currency->is_enabled < 1)
        {
            $currency->is_enabled = 1;
            $currency->save();
            return response()->json(
                ['success'=>true , 'message'=>'activated succesfully']
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not modified or activated']
        );
    }
}
