<?php

use App\Http\Controllers\TestMiddlewareController;
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
