<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('languages/{locale}', [
    'as'   => 'locale.change',
    'uses' => 'SetLocaleController'
]);


Route::group([
    'prefix' => 'bills/{bill}',
    'as'     => 'bills.'
], function () {
    Route::get('send', [
        'as'   => 'send',
        'uses' => 'BillController@send',
    ]);
    Route::get('export/{type}', [
        'as'   => 'export',
        'uses' => 'BillController@export',
    ]);
    Route::get('print', [
        'as'   => 'print',
        'uses' => 'BillController@print',
    ]);
});

Route::get('/index', 'BillController@index');
Route::get('/', 'BillController@index');
Route::resource('bills', 'BillController');

Auth::routes();
