<?php

use App\Http\Controllers\Api\ControllerUser;
use App\Http\Controllers\UserController;
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
//Route::middleware('auth:sanctum')->get('/user', function(Request $request) {
//    echo '<pre>';
//    print_r(22222222222);
//    die;
//    return $request->user();
//});
Route::prefix('users')->group(function() {
    Route::get('/', function() {
        echo '<pre>';
        print_r(11111111111);
        die;
    });
    Route::post('/create', [
        App\Http\Controllers\UserController::class,
        'store',
    ]);
    Route::post('/store', [
        UserController::class,
        'store',
    ]);
    Route::post('/edit', function() {
        echo '<pre>';
        print_r(22222222222);
        die;
    });
});
Route::get('/test', function() {
    echo '<pre>';
    print_r(22222222222);
    die;
    return $request->user();
});
//Route::get('/', function() {
//    echo '<pre>';
//    print_r('home111111111111');
//    die;
//});

