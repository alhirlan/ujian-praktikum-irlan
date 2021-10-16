<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateProviderController;
use App\Http\Controllers\DataProviderController;
// use App\Models\Provider;

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
// Route::get('/', function() {
//     $providers = Provider::all();
//     return view('content/menu', ['providers' => $providers]);
// });

// menu tampilan index
Route::get('/j3d219143', [CreateProviderController::class, 'index'])->name('main/index');

// menu tampilan detail
Route::get('/j3d219143/show-detail/{provider:nama_provider}', [CreateProviderController::class, 'show'])->name('main/show');

// form pembuatan provider
Route::get('/j3d219143/create/provider', [CreateProviderController::class, 'provider'])->name('main/provider');
// form proses pembuatan provider
Route::post('/j3d219143/provider', [CreateProviderController::class, 'createProvider'])->name('provider/create');

// form edit provider
Route::get('/j3d219143/edit-provider/{provider:nama_provider}', [CreateProviderController::class, 'editProvider'])->name('edit/provider');
// form proses edit provider
Route::put('/j3d219143/edit-provider/{provider:nama_provider}', [CreateProviderController::class, 'prosesEditProvider'])->name('edit/provider/proses');

// hapus provider
Route::delete('/j3d219143/delete-provider/{provider}', [CreateProviderController::class, 'deleteProvider'])->name('delete/provider');

// form pembuatan data provider
Route::get('/j3d219143/create/data-provider', [CreateProviderController::class, 'dataProvider'])->name('main/data-provider');
// form proses pembuatan data provider
Route::post('/j3d219143/data-provider', [DataProviderController::class, 'storeDataProvider'])->name('data-provider/create');

// form edit pembuatan data provider
Route::get('/j3d219143/edit-data-provider/{dataprovider:nama_paket}/{provider}', [DataProviderController::class, 'editDataProvider'])->name('edit/data_provider');
// form proses edit pembuatan data provider
Route::put('/j3d219143/edit-data-provider/{dataprovider}-{provider}', [DataProviderController::class, 'prosesEditDataProvider'])->name('edit/data_provider/proses');

// hapus data provider
Route::delete('/j3d219143/delete-data-provider/{dataprovider}-{provider}', [DataProviderController::class, 'deleteDataProvider'])->name('delete/data_provider');
