<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplyFrom;
use App\Models\User;
use Auth;
use DB;

class ApplyController extends Controller
{
   public function LoanApply(Request $req){

    if (Auth::check()){
        $user_id=Auth::id();
        $Apply=new ApplyFrom;
        $Apply->user_id= $user_id;
        $Apply->howMany=$req->input('howMany');
        $Apply->whatNeed=$req->input('whatNeed');
        $Apply->jamindar=$req->input('jamindar');
        $Apply->lonename=$req->input('lonename');
        $Apply->status="padding";
        $Apply->save();

        if($Apply){
            return response([
              'message'=>"ApplyFrom successfull",
               'Apply'=>$Apply
            ],200);
        }
        else{
            return response([
              'message'=>"ApplyFrom Not successfull",
            ],400);
        }
    }
    else{
              
            }
        
    }


    public function LoanView(){
       if (Auth::check()){
         $user_id=Auth::id();
          $Apply=ApplyFrom::where('user_id',$user_id)->get();
          return $Apply;
       }
    }

     public function LoanAdminView(){
       $ApplyView=DB::table('users')->join('apply_froms', 'apply_froms.user_id', '=', 'users.id')->select('users.*','apply_froms.user_id','apply_froms.howMany','apply_froms.whatNeed','apply_froms.jamindar','apply_froms.lonename','apply_froms.status')->get();
       return $ApplyView;
     }

     public function LoanSingleViewAdminView($user_id){
       $ApplyView=DB::table('users')->join('apply_froms', 'apply_froms.user_id', '=', 'users.id')->select('users.*','apply_froms.user_id','apply_froms.howMany','apply_froms.whatNeed','apply_froms.jamindar','apply_froms.lonename','apply_froms.status')->where('user_id',$user_id)->get();
       return $ApplyView;
     }

      public function approved(Request $req,$id){
        $apply=ApplyFrom::find($id);
        $apply->status=$req->input('app');
        $apply->update();
        if ( $apply) {
            return response([
               'message'=>'approved successfull',
               'apply'=> $apply
            ],200);
        }
        else
        {
            return response([
              'message'=>'cancel again upload !'
            ] ,400);
        }
      }


      public function cancel(Request $req,$id){
        $apply=ApplyFrom::find($id);
        $apply->status=$req->input('can');
        $apply->update();
        if ( $apply) {
            return response([
               'message'=>'cancel successfull',
               'apply'=> $apply
            ],200);
        }
        else
        {
            return response([
              'message'=>'cancel again upload !'
            ] ,400);
        }
      }
}
