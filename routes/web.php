<?php

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/rolusers', function () {
        return view('roluser');
    })->name('rolusers');

    Route::get('/providers', function () {
        return view('provider');
    })->name('provider');

    Route::get('/clients', function () {
        return view('client');
    })->name('client');

    Route::get('/admixtures', function () {
        return view('admixture');
    })->name('admixture');

    Route::get('/combos', function () {
        return view('combo');
    })->name('combo');

    Route::get('/purchase_sheets', function () {
        return view('purchase_sheet');
    })->name('purchase_sheet');

    Route::get('/entry_orders', function () {
        return view('entry_order');
    })->name('entry_order');

    Route::get('/expenditure_orders', function () {
        return view('expenditure_order');
    })->name('expenditure_order');

    Route::get('/warehouses', function () {
        return view('warehouse');
    })->name('warehouse');
});
