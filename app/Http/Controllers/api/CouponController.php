<?php

namespace App\Http\Controllers\api;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function index()
    {
        //'user token' => Auth::user()->bearer_token
        $coupons = Coupon::All();
        if($coupons)
        {
            return response()->json(
                ['success'=>true , 'message' => 'found', 'coupons'=>$coupons]
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'coupons'=>null]
        );
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $coupon = Coupon::create($request->only('code','isValid','discount_percentage','type','description'));
        if($coupon)
        {
            return response()->json(
                ['success'=>true , 'message'=>'added' , 'Coupon'=>$coupon]
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not added', 'Coupon'=>null]
        );
    }

    public function show($id)
    {
        $coupon = Coupon::where('id' , $id)->first();
        if(!empty($coupon))
        return response()->json(
            ['success'=>true , 'message'=>'found' ,'Coupon'=>$coupon]
        );
        return response()->json(
            ['success'=>false , 'message'=>'not found', 'Coupon'=>null]
        );
    }


    public function edit(coupon $coupon)
    {
        //
    }


    public function update(Request $request , $id)
    {
        $coupon = Coupon::find($id);
            if($coupon)
            {
                $coupon->update($request->only('isValid','discount_percentage','type','code','description'));
                return response()->json([ 'success'=>true , 'message'=>'Updated successfully'] );
            }
            return response()->json([ 'success'=>false , 'message'=>'not updated'] );
    }


    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        if($coupon && $coupon->delete())
        {
            return response()->json(
                ['success'=>true , 'message'=> 'deleted successfully']
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not found or deleted']
        );
    }
}
