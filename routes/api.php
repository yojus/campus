<?php

use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\ClassOfferController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('class_offers', ClassOfferController::class)
    ->middleware('auth:api')
    ->names('api.class_offers');

Route::apiResource('class_offers.favorites', FavoriteController::class)
    ->middleware('auth:api')
    ->only(['store', 'destroy'])
    ->names('api.class_offers.favorites');
