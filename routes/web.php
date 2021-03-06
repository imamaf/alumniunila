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

Route::get('/','LandingPageController@index');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/alumni','AdminController@viewDataAlumni');

// View Data Jurusan
Route::get('/jurusan','AdminController@viewDataJurusan');

Route::get('/dashboard', 'AdminController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/detail-user', 'AdminController@detailUser');
//show Detail User
Route::get('/detail/{id}', 'UserAttributsController@show');
// --------------------------------- ROUTING ALUMNI ------------------
//Create dan Delete DataAlumni
Route::put('/add-alumni', 'UserAttributsController@addUserAlumni');

// Get Alumni By ID
Route::get('/getAlumniById/{id}', 'UserAttributsController@getAlumniById');

//Delete data alumni
Route::delete('/delete-user/{users_Attribut}', 'UserAttributsController@deleteUser');

// --------------------------------- ROUTING JURUSAN ---------------
Route::get('/update-jurusan/{id}', 'JurusanController@edit');
// Get Jurusan By ID
Route::get('/getJurusanById/{id}', 'JurusanController@getJurusanById');
// Create Data Jurusan
Route::put('/add-data-jurusan', 'JurusanController@create');
//Update data jurusan
Route::put('/update-data-jurusan/{tbl_jurusan}', 'JurusanController@update');
//Delete data jurusan
Route::delete('/delete-data-jurusan/{tbl_jurusan}', 'JurusanController@delete');
//edit pw
Route::put('/update-password', 'UserController@updatePassword');
//pdf
Route::get('/laporan-pdf','AdminController@generatePDF');
//search
Route::get('/cari/{pathSearch}','AdminController@search');
// view PDF
Route::get('/viewPDF','AdminController@viewPDF');
Route::get('/PDF','AdminController@pdf');