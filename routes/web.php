<?php

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

Route::get('/', 'HomeController@index');
Route::get('/news','HomeController@news');
Route::get('/about','HomeController@about');
Route::get('/projects','HomeController@projects');
Route::get('/contact','HomeController@contact');
Route::get('/join','HomeController@join');
Route::get('/register','HomeController@join');


Route::get('/register/teacher','TeacherController@create');
Route::get('/register/school','SchoolController@create');
Route::get('/register/ngo','OrganizationController@create');
Route::post('/register/teacher','Auth\RegisterController@registerTeacher');
Route::post('/register/school','Auth\RegisterController@registerSchool');
Route::post('/register/ngo','Auth\RegisterController@registerOrganization');




