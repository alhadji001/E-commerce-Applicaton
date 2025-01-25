<?php

namespace App\Http\Controllers\api;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    
    public function index()
    {
        //get all countries
        $countries = Country::all();
        if($countries)
        {
            return response()->json(
                ['success'=>true , 'countries'=>$countries]);
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found' ,'countries'=>null]);
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
        $country = Country::create($request->only('name' , 'flag_url' , 'symbol' , 'phone_code'));
        if($country)
        return response()->json(
            ['success'=>true , 'message'=>'added successfully' ,'country'=>$country]
        );
        return response()->json(
            ['success'=>false , 'message'=>'not added', 'country'=>null]
        );
    }

    public function show($id)
    {
        $country = Country::find($id);
        if($country){
        return response()->json(
            ['success'=>true , 'country'=>$country]
        );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'country'=>null]
        );
    }

    public function update(Request $request , $name)
    {
        $country = Country::where('name' , $name)->first();
        if($country)
        {
            $country->update($request->only('name' , 'flag_url' , 'symbol' , 'phone_code'));
            return response()->json([ 'success'=>true , 'message'=>'Updated successfully'] );
        }
        return response()->json([ 'success'=>false , 'message'=>'not updated'] );
    }

    public function destroy($id)
    {
        $country = Country::find($id);
        if($country && $country->delete())
        {
            return response()->json(
                ['success'=>true , 'message'=>'deleted succesfully']
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not deleted or does not exist']
        );
    }
}
