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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/alumni','AdminController@viewDataAlumni');

Route::get('/jurusan','AdminController@viewDataJurusan');

Route::get('/dashboard', 'AdminController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/detail-user', 'AdminController@detailUser');
//show Detail
Route::get('/detail/{id}', 'UserAttributsController@show');
//CreateDataAlumni
Route::put('/add-alumni', 'UserAttributsController@addUserAlumni');

// Route::get('/forms-edit-user/{id}', 'UserAttributsController@edit');

//edit pw
Route::put('/update-password', 'UserController@updatePassword');

//pdf
Route::get('laporan-pdf','AdminController@generatePDF');