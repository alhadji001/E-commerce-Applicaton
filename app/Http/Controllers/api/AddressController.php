<?php

namespace App\Http\Controllers\api;

use App\Models\City;
use App\Models\Address;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $address = new Address;
        $address->user_id = $request->user()->id;
        $address->phone_number2 = $request->phone_number2;
        $address->phone_number3 = $request->phone_number3;
        $address->country_id = $request->country_id;
        $address->city_id = $request->city_id;
        $address->description = $request->description;
        if($address->save())
        {
            return response()->json(
            ['success'=>true , 'message'=>'added successfully' ,'address'=>$address] );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not added', 'address'=>null]
        );
    }

    public function show($id)
    {
        $address = Address::where('id',  $id)->first();
        if($address){
        $full_address;
        $country = Country::find($address->country_id);
        $city = City::find($address->city_id);
        $full_address['country'] = $country->name;
        $full_address['city'] = $city->name;
        $full_address['description'] = $address->description;
        $full_address['phone_number2'] = $address->phone_number2;
        $full_address['phone_number3'] = $address->phone_number3;
        return response()->json(
            ['success'=>true , 'address'=>$full_address]
        );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'address'=>null]
        );
    }

    
    public function edit($id)
    {
        $address = Address::where('id' , $id)->first();
        //edit form here taking from db and edit them
    }

    
    public function update(Request $request , $id)
    {
        $address = Address::where('id' , $id)->first();
        if($address){
            $address->country_id = $request->country_id;
            $address->city_id = $request->city_id;
            $address->description = $request->description;
            $address->phone_number2 = $request->phone_number2;
            $address->phone_number3 = $request->phone_number3;
            if( $address->save()){
                return response()->json(
                    ['success'=>true , 'message'=>'updated succesfully']
            );
            }
        }
        return response()->json(
            ['success'=>false , 'message'=>'not updated']
        );
    }

    public function destroy($id)
    {
        $address = Address::find($id);
        if($address && $address->delete())
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