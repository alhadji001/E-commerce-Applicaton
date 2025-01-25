<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\api\AuthController;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    // public function store(RegisterRequest $request)
    // {
    //     $user = AuthController::register($request , "admin");
    //     if($user){
    //         return response($user, Response::HTTP_CREATED);
    //     }else{
    //         return response('Registration failed', Response::HTTP_FAILED);
    //     }
        
    // }

    // public function login(Request $request)
    // {
    //     return AuthController::login($request , "admin");
    // }
    
    // public function show($id)
    // {
    //     $user = User::where('id' ,$id)->where('type' ,"admin");
    //     return $user;
    // }

    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
    public function disactive_user($id)
    {
        $user = User::where('id',$id)->first();
        if($user != null && $user->is_enabled > 0)
        {
            $user->is_enabled = 0;
            $user->save();
            return response()->json(
                ['success'=>true , 'message'=>'disactivated succesfully']
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not modified or disactivated']
        );
    }

    public function active_user($id)
    {
        $user = User::where('id',$id)->first();
        if($user != null && $user->is_enabled < 1)
        {
            $user->is_enabled = 1;
            $user->save();
            return response()->json(
                ['success'=>true , 'message'=>'activated succesfully']
            );
        }
        return response()->json(
            ['success'=>false , 'message'=>'not modified or activated']
        );
    }
}