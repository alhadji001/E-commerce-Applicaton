<?php

namespace App\Http\Controllers\api;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function index()
    {
        //get all cities
        $cities = City::All();
        if($cities)
        {
            $i = 0;
            foreach($cities as $city)
            {
                $country = Country::find($city->country_id);
                $cities[$i++]['country'] = $country->name;
            }
            return response()->json(
                ['success'=>true , 'message'=>'found' ,'cities'=>$cities]);
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found' ,'cities'=>$cities]);
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
        $city = new City;
        $city->name = $request->name;
        $country = Country::where('name','LIKE',"%{$request->country}%")->first();
        $city->country_id=$country->id;

        if($city->save())
        {
            return response()->json(
            ['success'=>true , 'message'=>'added successfully' ,'city'=>$city] );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not added', 'city'=>null]
        );
    }

    public function show($id)
    {
        $city = City::find($id);
        if($city){
        return response()->json(
            ['success'=>true , 'city'=>$city]
        );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'city'=>null]
        );
    }

    public function update(Request $request , $name)
    {
        $city = City::where('name' , $name)->first();
        if($city)
        {
            $city->update($request->only('name' , 'country_id'));
            return response()->json([ 'success'=>true , 'message'=>'Updated successfully'] );
        }
        return response()->json([ 'success'=>false , 'message'=>'not updated'] );
    }

    public function destroy($id)
    {
        $city = City::find($id);
        if($city && $city->delete())
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