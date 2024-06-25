<?php

use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('dashboard.index');
});

Route::group(['controller' => TransaksiController::class, 'prefix' => 'transaksi', 'as' => 'transaksi.'], function () {
    Route::get('/', 'index')->name('index');
    Route::get('dataTables', 'dataTables')->name('dataTables');
    Route::get('show', 'show')->name('show');
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('update', 'update')->name('update');
    Route::get('indexReport', 'indexReport')->name('indexReport');
    Route::get('dataTablesReport', 'dataTablesReport')->name('dataTablesReport');

});
