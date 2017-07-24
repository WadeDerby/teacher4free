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
Route::get('/test','TeacherController@destroy');
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
		Route::get('home','TeacherController@home');
		Route::get('view/profile','TeacherController@profile');
		Route::post('view/profile','TeacherController@updateProfile');
		Route::get('view/skills','TeacherController@skills');
		Route::post('view/skills','TeacherController@updateSkills');
		Route::get('view/courses','TeacherController@courses');
		Route::post('view/courses','TeacherController@updateCourses');
		Route::get('view/qualification','TeacherController@qualification');
		Route::post('view/qualification','TeacherController@updateQualification');
		Route::get('view/timeline','TeacherController@timeline');
		Route::get('view/messages','TeacherController@messages');
		Route::get('view/settings','TeacherController@settings');
		Route::get('search','TeacherController@search');
});

Route::group(['prefix' => 'school/{username}'], function () {
		Route::get('home','SchoolController@home');
		Route::get('view/profile','SchoolController@profile');
		Route::post('view/profile','SchoolController@updateProfile');
		Route::get('view/skills','SchoolController@skills');
		Route::post('view/skills','SchoolController@updateSkills');
		Route::get('view/courses','SchoolController@courses');
		Route::post('view/courses','SchoolController@updateCourses');
		Route::get('view/timeline','SchoolController@timeline');
		Route::get('view/messages','SchoolController@messages');
		Route::get('view/messages','SchoolController@messages');
		Route::get('view/settings','SchoolController@settings');
		Route::get('search','SchoolController@search');
});

