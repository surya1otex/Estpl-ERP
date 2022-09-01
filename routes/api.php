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

Route::get('/users', 'Apicontroller@listusers');
Route::get('/districts', 'Apicontroller@getDistricts');
Route::get('/blocks', 'Apicontroller@getBlocks');
Route::get('/attributes', 'Apicontroller@getAttributes');
Route::get('/loadblocks', 'Apicontroller@loadBlocks');

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
  Route::post('details', 'API\UserController@details');
  Route::post('/createclient', 'API\CreateClientController@createSchool');
  Route::get('/listclients',   'API\CreateClientController@listclients');
  Route::get('/listassignments', 'API\AssignmentController@listassignments');
  Route::get('/assignments/actionstarts', 'API\AssignmentController@checkprocessactions');
  Route::post('assignments/takeaction', 'API\AssignmentController@takeaction');
  Route::get('/assignments/{id}/details', 'API\AssignmentController@getactionDetails');
  Route::post('assignments/updateaction', 'API\AssignmentController@updateAction');
  Route::post('actionlogs/{id}/details', 'API\AssignmentController@getactionLogs');
});



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
