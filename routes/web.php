<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClassOfferController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
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

Route::get('/', [ClassOfferController::class, 'index'])
    ->middleware('auth')
    ->name('root');

Route::get('/welcome', function () {
    return view('welcome');
})->middleware('guest')
    ->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])
        ->name('dashboard');
});

Route::get('teacher/register', function () {
    return view('teacher.register');
})->middleware('guest')
    ->name('teacher.register');

Route::resource('class_offers', ClassOfferController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware('can:teacher');

Route::resource('class_offers', ClassOfferController::class)
    ->only(['show', 'index'])
    ->middleware('auth');

Route::resource('class_offers.messages', MessageController::class)
    ->only(['store', 'destroy'])
    ->middleware('auth');

Route::patch('/class_offers/{class_offer}/requests/{request}/approval', [RequestController::class, 'approval'])
    ->name('class_offers.requests.approval')
    ->middleware('can:teacher');

Route::patch('/class_offers/{class_offer}/requests/{request}/reject', [RequestController::class, 'reject'])
    ->name('class_offers.requests.reject')
    ->middleware('can:teacher');

Route::resource('class_offers.requests', RequestController::class)
    ->only(['store', 'destroy'])
    ->middleware('can:user');

Route::resource('requests.messages', ChatController::class)
    ->parameters(['requests' => 'req'])
    ->only(['index', 'store', 'destroy'])
    ->middleware('auth');
