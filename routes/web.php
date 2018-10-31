<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;

Auth::routes();
/**
 * Root page
 */
Route::get('/', 'HomeController@index')->name('home');

/**
 * Welcome page
 */
Route::get('/welcome', function () {
    return redirect('home');
});

/**
 * Home page
 */
Route::get('/home', 'HomeController@home');

/**
 * Upload page(ImportDeconv)
 */
Route::get('/upload', function (){
    if (!Auth::check() || !\App\User::isApproved()) {
        return redirect('/');
    }
    return view("/contents/Import");
});

/**
 * Upload page(LibrarySearch)
 */
Route::get('/upload2', function (){
    if (!Auth::check() || !\App\User::isApproved()) {
        return redirect('/');
    }
    return view("/contents/LibrarySearch");
});

/**
 * Management page
 */
Route::get('/admin', function (){
    if (\App\User::getRole() == 10) {
        return view("/contents/admin");
    }
    return redirect('/');
});

/**
 * View reports page
 */
Route::get('/view', function (){
    if (!Auth::check() || !\App\User::isApproved()) {
        return redirect('/');
    }
    return view("/contents/view");
});


/**
 * Profile page
 */
Route::get('/profile', function (){
    if (!Auth::check() || !\App\User::isApproved()) {
        return redirect('/');
    }
    return view("/contents/profile");
});

/**
 * Configuration page
 */
Route::get('/config', function (){
    if (!Auth::check() || !\App\User::isApproved()) {
        return redirect('/');
    }
    return view("/contents/config");
});

/**
 * HRMS page
 */
Route::get('/hrms', function (){
    if (!Auth::check() || !\App\User::isApproved()) {
        return redirect('/');
    }
    return view("/contents/config/hrms");
});


/**
 * API
 * Return job list
 */
Route::get('/getJobList', function (){
    if (!Auth::check() || !\App\User::isApproved()) {
        return null;
    }
    $up = new \App\Http\Controllers\UploadController();
    return json_encode($up -> getJobs());
});

/**
 * API
 * Download report
 */
Route::get('/dljob1', function (){
    if (!Auth::check() || !\App\User::isApproved()) {
        return null;
    }
    $up = new \App\Http\Controllers\UploadController();
    return $up -> ImportedResult();
});

Route::get('/dljob2', function (){
    if (!Auth::check() || !\App\User::isApproved()) {
        return null;
    }
    $up = new \App\Http\Controllers\UploadController();
    return $up -> SearchResult();
});

/**
 * API
 * Search jobs
 */
Route::get('/searchJob', function (){
    if (!Auth::check() || !\App\User::isApproved()) {
        return null;
    }
    $up = new \App\Http\Controllers\UploadController();
    return $up -> searchJob();
});

/**
 * API
 * List all users
 */
Route::get('/getUserList', function (){
    if (\App\User::getRole() != 10) {
        return null;
    }
    $user = new \App\Http\Controllers\AdminController();
    return json_encode($user -> getUserList());
});

/**
 * API
 * Manage user
 */
Route::get('/manage', function (){
    if (\App\User::getRole() != 10) {
        return null;
    }
    $user = new \App\Http\Controllers\AdminController();
    return json_encode(array("data" => $user -> manage()));
});

/**
 * API
 * Save job detail in database
 */
Route::get('/record', function (){
    if (!Auth::check() || !\App\User::isApproved()) {
        return null;
    }
    $up = new \App\Http\Controllers\UploadController();
    $up -> recordUpload();
});

/**
 * API
 * Insert HRMS config
 */
Route::get('/addHRMS', function (){
    if (!Auth::check() || !\App\User::isApproved()) {
        return null;
    }
    $up = new \App\Http\Controllers\ConfigController();
    $up -> HRMS_new();
});

/**
 * API
 * Return user's HRMS config
 */
Route::get('/getHRMS', function (){
    if (!Auth::check() || !\App\User::isApproved()) {
        return null;
    }
    $up = new \App\Http\Controllers\ConfigController();
    return $up -> HRMS_get();
});

/**
 * API
 * Return user's HRMS config
 */
Route::get('/modHRMS', function (){
    if (!Auth::check() || !\App\User::isApproved()) {
        return null;
    }
    $up = new \App\Http\Controllers\ConfigController();
    return $up -> HRMS_mod();
});

/**
 * API
 * Return server usage
 */
Route::get('/cpuUsage', function (){
    if (!Auth::check()) {
        return null;
    }
    $up = new \App\Http\Controllers\HomeController();
    return $up -> getUsage();
});

/**
 * API
 * Return upload stat
 */
Route::get('/uploadStat', function (){
    if (!Auth::check()) {
        return null;
    }
    $up = new \App\Http\Controllers\HomeController();
    return $up -> getStat();
});
