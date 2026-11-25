<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Article
Route::get('/getdata',[ArticleController::class,'index']);

Route::get('/getarticle/{id}',[ArticleController::class,'show']);

Route::post('/store',[ArticleController::class,'store'])->middleware('auth:sanctum');

Route::patch('/update/{id}',[ArticleController::class,'update'])->middleware('auth:sanctum');

Route::delete('/delete/{id}',[ArticleController::class,'destroy'])->middleware('auth:sanctum');

Route::get('/Article/{id}/user',[ArticleController::class,'getArticleUser']);

////////////////////////////////////////////////////////////////////////////////////////
// Card
Route::post('/store/card',[CardController::class,'store']);

Route::get('/card/{id}/user',[CardController::class,'getCardUser']);

////////////////////////////////////////////////////////////////////////////////////////

Route::get('/user/{id}/card',[UserController::class,'getUserCard']);

Route::get('/user/{id}/articles',[UserController::class,'getUserArticles']);

///////////////////////////////////////////////////////////////////////////////////////// 
// Auth
Route::post('/signup',[AuthController::class,'signup']);

Route::post('/signin',[AuthController::class,'signin']);

Route::post('/signout',[AuthController::class,'signout'])->middleware('auth:sanctum');