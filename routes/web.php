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

Route::get('/alumni', function () {
    return view('admin.alumni');
});

Route::get('/jurusan', function () {
    return view('admin.jurusan');
});

Route::get('/dashboard', 'AdminController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/detailUser', 'AdminController@detailUser');
//show Detail
Route::get('/detail/{id}', 'UserAttributsController@show');
//CreateDataAlumni
Route::get('/alumni2', 'UserAttributsController@create');
