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
Route::get('teacher/{username}','TeacherController@index')->middleware('auth');
Route::get('school/{username}','SchoolController@index')->middleware('auth');

Route::get('/login','Auth\LoginController@index');
Route::post('/login','Auth\LoginController@login');
Route::get('/logout','Auth\LoginController@logout');


Route::get('/register/teacher','TeacherController@create');
Route::get('/register/school','SchoolController@create');
Route::get('/register/ngo','OrganizationController@create');
Route::post('/register/teacher','Auth\RegisterController@registerTeacher');
Route::post('/register/school','Auth\RegisterController@registerSchool');
Route::post('/register/ngo','Auth\RegisterController@registerOrganization');



Route::group(['prefix' => 'teacher/{username}'], function () {
		Route::get('view/profile','TeacherController@profile');
		Route::get('view/skills','TeacherController@skills');
		Route::get('view/qualification','TeacherController@qualification');
		Route::get('view/timeline','TeacherController@timeline');
		Route::get('view/messages','TeacherController@messages');
		Route::get('view/settings','TeacherController@settings');
});


