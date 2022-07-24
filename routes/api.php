<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\Pay\PayController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('UserRegister',[AuthController::class,'UserRegister']);
Route::post('UserLogin',[AuthController::class,'UserLogin']);
Route::get('userSearch/{nid}',[AuthController::class,'userSearch']);
Route::get('userView',[AuthController::class,'userView'])->middleware('auth:api');

//Admin...
Route::post('AdminUserRegister',[AdminController::class,'AdminUserRegister']);
Route::post('login',[AdminController::class,'login']);


Route::get('UserViewAdmin',[AdminController::class,'UserViewAdmin']);
Route::get('UserAdmin/{id}',[AdminController::class,'UserAdmin']);

//LoanApply-------

Route::post('LoanApply',[ApplyController::class,'LoanApply'])->middleware('auth:api');
Route::get('LoanView',[ApplyController::class,'LoanView'])->middleware('auth:api');
Route::get('LoanAdminView',[ApplyController::class,'LoanAdminView']);
Route::get('LoanSingleViewAdminView/{user_id}',[ApplyController::class,'LoanSingleViewAdminView']);
Route::post('approved/{id}',[ApplyController::class,'approved']);
Route::post('cancel/{id}',[ApplyController::class,'cancel']);
//pay bill........
Route::post('paymentMethod',[PayController::class,'paymentMethod'])->middleware('auth:api');
Route::get('paymentView',[PayController::class,'paymentView'])->middleware('auth:api');
Route::get('paymentAdminView',[PayController::class,'paymentAdminView']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
