<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getTemplate', function (){
    $instance = new \App\Http\Controllers\UploadController();
    return $instance -> getTemplate();
});

Route::get('/list', function (){
    $process = new \App\API\Process();
    return $process->StartProcess();
});

Route::get('/getCredential', function (){
    if (!Auth::check()) {
        return null;
    }
    $upload = new \App\API\IO();
    return $upload -> getCredential();
});


