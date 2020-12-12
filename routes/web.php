<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AssociationController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\ActivityController::class, 'index'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/associations', 'AssociationController@index');

Route::resource('associations', AssociationController::class);
Route::resource('activities', ActivityController::class);

Route::get('/{user}/subscribe/{association}', [App\Http\Controllers\SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('/{user}/unsubscribe/{association}', [App\Http\Controllers\SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');
