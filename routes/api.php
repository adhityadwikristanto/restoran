<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

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

Route::get('/restoran', [RestaurantController::class, 'index']);
Route::get('/restoran/name/{name}', [RestaurantController::class, 'find']);


/**
 * menu
 * 
 * parameter: latitude, longitude, menu
 * for testing, use Grand Tulip location (-6.929531467842093, 107.59753226566424)
 */
Route::get('/menu/restoran/{id_restaurant}', [MenuController::class, 'find']); //menampilkan menu pada suatu restoran
Route::post('/menu/observasi', [MenuController::class, 'observasi']); //mengobservasi restoran di sekitar user ['menu','latitude','longitude']

/**
 * order
 * 
 * menyimpan order dengan rincian tanggal, email, seat, menus, kuantitas, keterangan
 */
Route::post('/order',[OrderController::class, 'store']);// menyimpan detail pesanan



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
