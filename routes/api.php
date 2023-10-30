<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hello;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/form-submit',[hello::class,'form_submit']);
Route::post('/form-display',[hello::class,'form_display']);
Route::post('delete/{id}',[hello::class,'delete']);
Route::get('edit/{id}',[hello::class,'edit']);
Route::put('update/{id}',[hello::class,'update']);
Route::get('search/{name}',[hello::class,'search']);