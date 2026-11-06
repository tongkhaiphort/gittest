<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function(){
    return view('login');
});
Route::get('/user',[UserController::class,'index']);
Route::get('/user/create',[UserController::class,'create']);
Route::post('/user/store',[UserController::class,'store']);

Route::get('/students',[StudentController::class,'index']);

Route::get('/class',[ClassController::class,'index']);
