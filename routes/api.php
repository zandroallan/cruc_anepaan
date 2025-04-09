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


Route::post('register', 'Api\LoginSanctumController@register');

Route::post('login', 'Api\LoginSanctumController@login');

Route::post('logout', 'Api\LoginSanctumController@logout');


Route::get('unauthorized',function(Request $r){
	$response = [
            'success' => false,
            'code'    => "C003",
            'message' => "Unauthorized",
            'data'    => [
            				'error' => "No existe ningun token"
            			]
        ];

    return response()->json($response, 404);

})->name('api.unauthorized');


Route::middleware('auth:sanctum')->group(
    function () {

        Route::post('registros', 'Api\ApiController@test');

    }
);
