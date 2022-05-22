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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'], function() {

    Route::get('/teamInventory/{team}',  'TeamInventoryController@index');
    Route::get('/getTeamInventory/{team}',  'TeamInventoryController@inventory');
    Route::get('/item/{id}',  'TeamInventoryController@single_item');
    Route::get('/transactions/{id}',  'TransactionsController@index');
    Route::get('/getTransactions/{id}',  'TransactionsController@transactions');
    Route::get('/addItemForm',  'AddItemController@addItemForm');
    Route::post('/addItem', 'AddItemController@submit');
});

