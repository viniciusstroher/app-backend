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

Route::post('/auth','UserController@auth');
Route::group(['middleware' => ['auth:api','force.json']], function () {
	Route::get('/user','UserController@user');
	Route::get('/feedback','FeedbackController@getFeedback');
	Route::post('/feedback','FeedbackController@putFeedback');
	Route::post('/feedback-count','FeedbackController@count');
});
