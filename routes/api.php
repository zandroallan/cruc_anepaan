<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
    API Routes
*/

Route::get('padron/{year}/contratistas', 'HomeController@padron');

Route::get('padron/{id_tramite}/contratista/detalle', 'HomeController@detalleContratistaPadron');


// 

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

        Route::post('padron', 'Api\ApiController@test');

        Route::get('padron/{year}/tramites', 'Api\ApiController@padron');

        Route::get('padron/tramites/{id_tramite}/detalle', 'Api\ApiController@padronDetalle');

    }
);





