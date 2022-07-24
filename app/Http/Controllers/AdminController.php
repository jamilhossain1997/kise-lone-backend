<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminUserRegister(Request $request){
        $user=AdminUser::create([
               'email'=>$request->email,
               'password'=>Hash::make($request->password),
            ]);
           $token=$user->createToken('Token')->accessToken ;
            return response()->json([
               'status'=>200,
               'username'=>$user,
               'token'=>$token,
               'message'=>'Register Successfully',
            ]);
      }

      function login(Request $req){

        $User=AdminUser::where('email',$req->email)->first();
   
        if (!$User || !Hash::check($req->password,$User->password) ) {
           return response([
            "Error"=> "Not Match Email Or password"
           ],401);
        }
         $token=$User->createToken('Token')->accessToken ;
          return response([
            'message'=>"successfull Login",
             'user'=>$User,
             'token'=>$token
          ],200);
       }

    public function UserViewAdmin(){
        $user=User::all();
        return $user;
      }

    public function UserAdmin($id){
        $user=User::find($id);
        return $user;
    }
}
