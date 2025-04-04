<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/auth', [\App\Http\Controllers\AuthController::class, 'auth']);

Route::get('/auth/callback', [\App\Http\Controllers\AuthController::class, 'callback']);

Route::get('/webhook/subscription', [\App\Http\Controllers\WebhookController::class, 'subscription']);
Route::post('/webhook/web-pixel', [\App\Http\Controllers\WebhookController::class, 'webhook']);

Route::post('/track-event', [\App\Http\Controllers\TrackEventController::class, 'trackEvent']);


