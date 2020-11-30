<?php

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

// GET locations/places
Route::get('searchPlace','App\Http\Controllers\PlaceController@index');
//POST request to add a place in our Database
Route::post('addPlace','App\Http\Controllers\PlaceController@store');
//POST: to add reviews from the users
Route::post('addReview','App\Http\Controllers\ReviewController@store');
