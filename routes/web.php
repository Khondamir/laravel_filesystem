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

 Route::get('login', 'Login@index');
 Route::post('post-login', 'Login@postLogin'); 
 Route::get('registration', 'Login@registration');
 Route::post('post-registration', 'Login@postRegistration'); 
 Route::get('dashboard', 'Login@dashboard'); 
 Route::get('admin', 'Login@dashboard');
 Route::get('logout', 'Login@logout');

// Store file
 Route::post('dashboard', 'FileUpload@fileUpload')->name('fileUpload');
 Route::get('dashboard/{id}', 'FileUpload@reprocess')->name('reprocess');
 Route::get('accept/{id}', 'FileUpload@acceptForm');
 Route::get('second-form/{id}', 'SecondFormController@create');
 Route::post('second-form/{id}', 'SecondFormController@store')->name('secondFormUpload');
 Route::get('update2/{id}', 'SecondFormController@update')->name('reprocess2');
 Route::get('accept2/{id}', 'SecondFormController@accept');
 Route::get('get-info', 'SecondFormController@getInformation')->name('get-info');