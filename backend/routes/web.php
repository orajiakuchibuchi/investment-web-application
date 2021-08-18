<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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
Route::post('/subscribe', [Controller::class, 'subscribe']);
Route::get('/',[Controller::class, 'index']);
Route::post('/contact', [Controller::class, 'contactUs']);

Route::get('/clear-cache', function() {
    return Artisan::call('cache:clear');
    // return what you want
});
