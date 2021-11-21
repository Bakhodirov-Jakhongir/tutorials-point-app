<?php

use App\Http\Controllers\CookieController;
use App\Http\Controllers\TestMiddlewareController;
use App\Http\Controllers\UriController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as DebugBar;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/debugbar', function (Request $request) {
    $request_path = $request->path();

    DebugBar::info($request_path);
    DebugBar::error('Error!');
    DebugBar::warning('Warning Watch out ... !');
    DebugBar::addMessage('Another message from addMessage()', 'my_label');

    Debugbar::startMeasure('render', 'Time for rendering');
    Debugbar::stopMeasure('render');
    Debugbar::addMeasure('now', LARAVEL_START, microtime(true));
    Debugbar::measure('My long operation', function () {
        // Do something…
    });

    return view('debugbar.index');
});


//Middleware Laravel
Route::get('/middleware/terminate', [TestMiddlewareController::class, 'index'])->middleware('age');

//Request object

Route::get('/foo/bar', [UriController::class, 'get_request_obj']);

//Cooikes in laravel

// Route::get('/cookie/set', [CookieController::class, 'setCookie']);
// Route::get('/cookie/get', [CookieController::class, 'getCookie']);


//Response object
Route::get('/response/header', function () {
    $person = [
        'name' => 'Alice',
        'age' => 20
    ];

    $json_data_person = '{
        "name": "Alice",
        "age": 20
      }';

    $json_data = json_encode($person);

    $decode_json_to_php_object = json_decode($json_data_person);

    return response($json_data, 200)->header('Content-Type', 'application/json');
});

Route::get('/cookie/set', function () {
    return response("Set Cookie via using response", 200)->header('Content-Type', 'text/html')
        ->withcookie('name', 'Jakhongir Bakhodirov', 5);
});


Route::get('/cookie/get', function (Request $request) {
    $cookie = $request->cookie('name');
    return response()->json([
        'cookie' => $cookie
    ]);
});
