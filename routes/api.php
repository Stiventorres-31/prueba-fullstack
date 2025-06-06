<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('user', UserController::class);
    Route::get('visit/pagination', [VisitController::class, 'paginate']);
    Route::resource('visit', VisitController::class);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/checkToken',[AuthController::class,'checkToken']);
});
