<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paymentgetway;
use Auth;
use DB;

class PayController extends Controller
{
    public function paymentMethod(Request $req){

        if(Auth::check()){

        $user_id=Auth::id();

        $pay=new Paymentgetway;
        $pay->user_id=$user_id;
        $pay->loanName=$req->input('loanName');
        $pay->paymentNumber=$req->input('paymentNumber');
        $pay->paymentAmount=$req->input('paymentAmount');
        $pay->paymentdate=$req->input('paymentdate');
        $pay->save();
        
        if($pay){
            return response([
              'message'=>'submited',
              'pay'=>$pay
            ],200);
          }
          else
          {
            return response([
              'message'=>'Not submited',
            ],400);
          }
        }
        
    }

    public function paymentView(){
        if(Auth::check()){
           $user_id=Auth::id();
           $pay= Paymentgetway::where('user_id',$user_id)->get()->first();

           if($pay){
             return response([
                'message'=>'Payment View',
                'pay'=>$pay
             ],200);
           }
           else{
             return response([
                'message'=>'Not Paymment View'
             ]);
           }
      }
    }

    public function paymentAdminView(){
        $ApplyView=DB::table('users')->join('paymentgetways','paymentgetways.user_id', '=', 'users.id')->select('users.*','paymentgetways.id','paymentgetways.paymentNumber','paymentgetways.paymentdate','paymentgetways.loanName','paymentgetways.paymentAmount')->get();
       return $ApplyView;
    }
}
