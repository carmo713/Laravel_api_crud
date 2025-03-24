<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;

Route::get('/users', [UserController::class,'index']);
Route::get('/users/{user}', [UserController::class,'show']);
route::post('/users', [UserController::class,'store']);
Route::put('/users/{user}', [UserController::class,'update']);