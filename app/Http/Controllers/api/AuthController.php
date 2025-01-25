<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Controllers\PhoneController;
use App\Http\Requests\UpdatePasswordRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function register(RegisterRequest $request)
    {
        $user_type = $this->get_user_type($request , 'register');
        
        if(!empty($user_type))
        {
            $user = User::create($request->only('first_name' , 'last_name' , 'image_url' , 'phone_number' , 'address_id' , 'email')+
            ['type' => $user_type]+
            ['is_enabled' => ($user_type === "customer")?'1':'0']+
            ['password' => \Hash::make($request->input('password'))]
        );
        return $user;//created successfully now redirect to login page.
        }
        return response()->json(['success'=>false , 'message' => 'error wrong user role' ,
            'type' => $user_type ]);
    }

    public function login(Request $request)
    {
        $user_type = $this->get_user_type($request , 'login');
        if(! \Auth::attempt($request->only('phone_number','password')))
        {
            return response(
                ['success' => false,
                'message' => 'Invalid credentials'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $user = \Auth::user();
        if($user_type != "customer" && $user->is_enabled == 0)
        {
            return response(
                ['success' => false,
                'message' => 'Invalid credentials'],
                Response::HTTP_UNAUTHORIZED
            );
        }else{
            $jwt = $user->createToken('token' , [$user_type])->plainTextToken;
            $cookie = Cookie('jwt' , $jwt , 60*24); //1 day
        return response(
            [   'succes' => true ,
                'message' => 'logged in !']
            )->withCookie($cookie);
        }
        
    }

    public function user(Request $request)
    {
        return $request->user();
    }

    public static function logout()
    {
        $cookie = \Cookie::forget('jwt');
        return response(
            [ 
                'success' => true,
                'message' => 'logget out']
            )->withCookie($cookie);
    }

    public function updateInfo(UpdateInfoRequest $request)
    {
        $user = $request->user();
        $user->update($request->only('first_name','last_name','phone_number','email'));
        return response()->json([
            'success' => true,
            'message' => 'Updated successfully',
            'user' => $user]);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $request->user();
        $user->update(
            [
                'password' => \Hash::make($request->input('new_password'))
            ]
        );
        return response($user, Response::HTTP_ACCEPTED);
    }
    public function get_user_type($request , $page)
    {
        $user_type = "";
        switch (true) {
            case ($request->path() === 'api/admin/'.$page):
                $user_type = "admin";
                break;
            case ($request->path() === 'api/ambassador/'.$page):
                $user_type = "ambassador";
                break;
            case ($request->path() === 'api/assistant/'.$page):
                $user_type = "assistant";
                break;
            case ($request->path() === 'api/editor/'.$page): 
                $user_type = "editor";
                break;
            case ($request->path() === 'api/shipper/'.$page): 
                $user_type = "shipper";
                break;
            case ($request->path() === 'api/salesperson/'.$page): 
                $user_type = "salesperson";
                break;
            case ($request->path() === 'api/customer/'.$page): 
                $user_type = "customer";
                break;
            case ($request->path() === 'api/headquater/'.$page): 
                $user_type = "headquater";
                break;
            default:
                break;
        }
        return $user_type;
    }
}
