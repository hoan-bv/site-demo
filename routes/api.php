<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth:sanctum')->get('/user', function(Request $request) {
    echo '<pre>';
    print_r(22222222222);
    die;
    return $request->user();
});
Route::get('/test', function() {
    echo '<pre>';
    print_r(22222222222);
    die;
    return $request->user();
});
Route::get('/', function() {
    echo '<pre>';
    print_r(333333333333333333);
    die;
});
Route::get('create', function() {
    echo '<pre>';
    print_r(333333333333333333);
    die;
});
