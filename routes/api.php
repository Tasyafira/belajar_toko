<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Detail_TransaksiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
    //return $request->user();
//});

Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

Route::group(['middleware' => ['jwt.verify']], function ()
{
    Route::group(['middleware' => ['api.superadmin']], function()
    {
        Route::delete('/pelanggan/{id}', 'PelangganController@destroy');
        Route::delete('/produk/{id}', 'ProdukController@destroy');
        Route::delete('/petugas/{id}', 'PetugasController@destroy');
        Route::delete('/transaksi/{id}', 'TransaksiController@destroy');
        Route::delete('/detail_transaksi/{id}', 'Detail_TransaksiController@destroy');
    });

    Route::group(['middleware'=> ['api.admin']], function()
    {
        Route::post('/pelanggan', 'PelangganController@store');
        Route::put('/pelanggan/{id}', 'PelangganController@update');

        Route::post('/produk', 'ProdukController@store');
        Route::put('/produk/{id}', 'ProdukController@update');

        Route::post('/petugas', 'PetugasController@store');
        Route::put('/petugas/{id}', 'PetugasController@update');

        Route::post('/transaksi', 'TransaksiController@store');
        Route::put('/transaksi/{id}', 'TransaksiController@update');

        Route::post('/detail_transaksi', 'Detail_TransaksiController@store');
        Route::put('/detail_transaksi/{id}', 'Detail_TransaksiController@update');
    });

    
    Route::get('/pelanggan', 'PelangganController@show');
    Route::get('/pelanggan/{id}', 'PelangganController@detail');

    Route::get('/produk', 'ProdukController@show');
    Route::get('/produk/{id}', 'produkController@detail');
    
    Route::get('/petugas', 'PetugasController@show');
    Route::get('/petugas/{id}', 'PetugasController@detail');
    
    Route::get('/transaksi', 'TransaksiController@show');
    Route::get('/transaksi/{id}', 'TransaksiController@detail');
  
    Route::get('/detail_transaksi', 'Detail_TransaksiController@show');
    Route::get('/detail_transaksi/{id}', 'Detail_TransaksiController@detail');
    
});