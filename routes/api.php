<?php

use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register',[RegisterController::class,'register']);
Route::post('login',[RegisterController::class,'login']);

Route::group([
    "middleware" => ["auth:api"]
],function(){
Route::get('profile',[RegisterController::class,'profile']);
Route::get('refreshtoken',[RegisterController::class,'refreshtoken']);
Route::get('logout',[RegisterController::class,'logout']);
Route::apiResource('departments', DepartmentController::class);
Route::apiResource('employees', EmployeeController::class);
}  
);



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
