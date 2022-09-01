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

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');

// Route::resource('users', 'UserController');
// Route::resource('forms', 'Formelements');
// Route::resource('roles', 'RoleController');
// Route::resource('permissions', 'PermissionController');
// Route::resource('posts', 'PostController');

Route::group(['middleware' => ['auth']], function() {
  Route::resource('roles','RoleController');
  Route::resource('users','UserController');
  Route::resource('forms', 'Formelements');

  // Resource routing section end

  Route::group(['prefix'  =>   'categories'], function() {

    Route::get('/', 'CategoryController@index')->name('categories.index');
    Route::get('/create', 'CategoryController@create')->name('categories.create');
    Route::post('/store', 'CategoryController@store')->name('categories.store');
    Route::get('/{id}/edit', 'CategoryController@edit')->name('categories.edit');
    Route::post('/update', 'CategoryController@update')->name('categories.update');
    Route::get('/{id}/delete', 'CategoryController@delete')->name('categories.delete');
  
  });

  // vendor routes

  Route::group(['prefix'  =>   'vendors'], function() {

    Route::get('/', 'VendorController@index')->name('vendors.index');
    Route::get('/create', 'VendorController@create')->name('vendors.create');
    Route::post('/store', 'VendorController@store')->name('vendors.store');
    Route::get('/{id}/edit', 'VendorController@edit')->name('vendors.edit');
    Route::post('/update', 'VendorController@update')->name('vendors.update');
    Route::get('/{id}/delete', 'VendorController@delete')->name('vendors.delete');
  
  });

  // Assignment Routes


  Route::group(['prefix'  =>   'assignments'], function() {

    Route::get('/', 'AssignmentController@index')->name('assignment.index');
    Route::get('/create', 'AssignmentController@create')->name('assignment.create');
    Route::post('/store', 'AssignmentController@store')->name('assignment.store');
  
  
    Route::get('/{id}/details', 'AssignmentController@edit')->name('assignment.details');
    Route::get('/{id}/action_start', 'AssignmentController@takeaction')->name('assignment.action');
    Route::get('/{id}/action_update', 'AssignmentController@editaction')->name('assignment.edit.action');
    Route::get('/{id}/add_items', 'AssignmentController@additems')->name('assignment.add.items');
    Route::post('/update_action', 'AssignmentController@updateaction')->name('assignment.update.action');
  
   // Route::post('/save_action', 'AssignmentController@saveaction')->name('assignment.save.action');
  
  
    Route::post('/save_action', 'AssignmentController@saveaction')->name('assignment.save.action');
  
    Route::post('/images/upload', 'AssignmentController@upload')->name('assignment.images.upload');
    // Route::get('/{id}/edit', 'ClientController@edit')->name('clients.edit');
    // Route::post('/update', 'ClientController@update')->name('clients.update');
    // Route::get('/{id}/delete', 'ClientController@delete')->name('clients.delete');

    Route::post('/assign_user', 'AssignmentController@assignto');
    Route::post('/fetchitems', 'AssignmentController@getitems');
    Route::post('/additems', 'AssignmentController@saveitemtoPO');
    Route::get('/delete_items/{id}', 'AssignmentController@deleteItem');
  
  });

  // Product Routes

  Route::group(['prefix'  =>   'servicetasks'], function() {
    Route::get('/', 'AssignmentController@services')->name('services.index');
  });

  Route::group(['prefix' => 'products'], function () {

    Route::get('/', 'ProductController@index')->name('products.index');
    Route::get('/create', 'ProductController@create')->name('products.create');
    Route::post('/store', 'ProductController@store')->name('products.store');
    Route::get('/edit/{id}', 'ProductController@edit')->name('products.edit');
    Route::post('/update', 'ProductController@update')->name('products.update');
  
  });


  // Clients Routes

  Route::group(['prefix'  =>   'clients'], function() {

    Route::get('/', 'ClientController@index')->name('clients.index');
    Route::get('/create', 'ClientController@create')->name('clients.create');
    Route::post('/store', 'ClientController@store')->name('clients.store');
    Route::get('/{id}/edit', 'ClientController@edit')->name('clients.edit');
    Route::post('/update', 'ClientController@update')->name('clients.update');
    Route::get('/{id}/delete', 'ClientController@delete')->name('clients.delete');
  
  });
  
  //Route::resource('products','ProductController');
});

// Routes added by Surya


// end of surya routes

Route::get('/organisation','OrganisationController@index');
Route::match(['get','post'],'/organisation-add', 'OrganisationController@addorganisation');
Route::match(['get','post'],'/organisation-edit/{id}', 'OrganisationController@editorganisation');
Route::match(['get','post'],'/contactperson-add', 'OrganisationController@addcontactperson');
Route::get('contactperson-add','OrganisationController@addcontactperson');
Route::get('contactperson-add/getaddress/{id}','OrganisationController@getaddress');
Route::match(['get','post'],'/location-add/{id}/addlocn', 'OrganisationController@addlocation');
Route::match(['get','post'],'/addlocation/', 'OrganisationController@addlocation');
Route::match(['get','post'],'/location-edit/{id}/editlocn', 'OrganisationController@editlocation');
 //organisation branch by hrushi 19/04
 // Route::get('/organisationbranch','OrganisationbranchController@index');
 // // Route::post('/Add-branch','OrganisationbranchController@addorganisationbranch');
 //   Route::match(['get','post'],'/Add-branch', 'OrganisationbranchController@addorganisationbranch');
   
 //    //Route::post('/edit-organisationbranch/{id}','OrganisationbranchController@editorganisationbranch');
 //   Route::match(['get','post'],'/edit-organisationbranch/{id}', 'OrganisationbranchController@editorganisationbranch');

// End of organisation branch
