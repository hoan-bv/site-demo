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
//Route::prefix('users')->group(function() {
//    Route::get('/', function() {
//        echo '<pre>';
//        print_r(11111111111);
//        die;
//    });
//    Route::post('register', [
//        UserController::class,
//        'register',
//    ]);
//    Route::get('/index', [
//        App\Http\Controllers\UserController::class,
//        'index',
//    ]);
//
//});
Route::post('login', [
    UserController::class,
    'authenticate',
]);
Route::group(['middleware' => ['jwt.verify']], function() {
    //Route::middleware(['jwt.verify'])->group(function () {
    Route::get('logout', [
        UserController::class,
        'logout',
    ]);
    Route::get('detail', [
        UserController::class,
        'detail',
    ]);
    Route::post('/edit', [
        UserController::class,
        'edit',
    ]);
    Route::post('create', [
        UserController::class,
        'store',
    ]);
});
Route::get('/test', function() {
    return 2222;
});


