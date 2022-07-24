<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function UserRegister(Request $request){
        $user=User::create([
               'name'=>$request->name,
               'fatherhasbend'=>$request->fatherhasbend,
               'mother'=>$request->mother,
               'address'=>$request->address,
               'brith_d'=>$request->brith_d,
               'brith_m'=>$request->brith_m,
               'brith_y'=>$request->brith_y,
               'nid'=>$request->nid,
               'photo'=>$request->photo->store('Products_img'),
               'nid_f'=>$request->nid_f->store('Products_img'),
               'nid_s'=>$request->nid_s->store('Products_img'),
               'phone'=>$request->phone,
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

      // public function UserLogin(Request $req){

      //    $User=User::where('phone',$req->phone)->first();
   
      //   if (!$User || !Hash::check($req->password,$User->password) ) {
      //      return response([
      //       "Error"=> "Not Match Email Or password"
      //      ],401);
      //   }
      //   $token=$User->createToken($User->email.'_Token')->plainTextToken;
      //      return response([
      //           'message'=>"successfull login",
      //           'User'=>$User,
      //           'token'=>$token
      //       ],200);
      //  }


       public function UserLogin(Request $req){

        if (Auth::attempt($req->only('phone','password'))) {
             $user= Auth::User();
             $token=$user->createToken('Token')->accessToken ;
             return response([
                'message'=>"successfull login",
                'token'=>$token,
                'User'=>$user
            ],200);
         } 
         return response([
                'message'=>"successfull not login",
                
            ],401);
    }

    public function userView(){
        $user= Auth::User();
        return $user;
    }

   

    public function userSearch($nid){
        $user=User::where('nid',$nid)->orderBy('nid')->take(1)->get();
        return $user;
    }
}
