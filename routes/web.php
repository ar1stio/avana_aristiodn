<?php

// use Illuminate\Support\Facades\Route;

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

Route::get('/find-string', [
    'uses'  => 'TestController@findstring',
    'as'    => 'test.find-string'
    // return view('test.find-string');
]);

Route::post('/process-string', [
    'uses'  => 'TestController@processstring',
    'as'    => 'test.process-string'
    // return view('test.find-string');
]);

Route::get('/validasi-data', [
    'uses'  => 'TestController@validasidata',
    'as'    => 'test.validasi-data'
    // return view('test.validasi-data');
]);

Route::post('/process-excel', [
    'uses'  => 'TestController@processexcel',
    'as'    => 'test.process-excel'
    // return view('test.validasi-data');
]);

// Route::get('/find-string', 'Auth\CustomerLoginController@showLoginForm')->name('customer.loginform');

//     return view('test.validasi-data');
// });
