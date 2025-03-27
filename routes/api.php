<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('padron/{year}/contratistas', 'HomeController@padron');

Route::get('padron/{id_tramite}/contratista/detalle', 'HomeController@detalleContratistaPadron');
