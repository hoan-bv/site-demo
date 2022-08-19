<?php

use App\Http\Controllers\Api\ControllerUser;
use App\Http\Controllers\LangController;
use App\Http\Controllers\UserController;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redis;
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
Route::get('/greeting/{locale}', function($locale) {
    if (!in_array($locale, [
        'en',
        'es',
        'fr',
    ])) {
        abort(400);
    }
    App::setLocale($locale);
    echo __('message.title');
    dd($locale);
    //
});
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
    Route::post('index', [
        LangController::class,
        'index',
    ]);
    Route::post('notify', [
        UserController::class,
        'notify',
    ]);
    Route::post('read', [
        UserController::class,
        'read',
    ]);
});
Route::get('/test', function() {
    $id = 1;
    Redis::set('name', 'Taylor');
//    $values = Redis::lrange('names', 0, 10);
    echo '<pre>';
    var_dump(Redis::get('name'));
    die;
    return 2222;
});


