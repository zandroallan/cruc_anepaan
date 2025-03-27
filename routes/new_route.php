<?php
	
	Route::get('tramites/get/representante-tecnico/{id}', 'Backend\TecnicaController@getRepresentanteTecnico');

	Route::get('tramites/listas/representante-tecnico/{id_registro_tmp}', 'Backend\TecnicaController@datosRepresentanteTecnico');

	Route::post('tramites/store/representante-tecnico', 'Backend\TecnicaController@storeRepresentanteTecnico');

	Route::delete('tramites/eliminar/representante-tecnico/{id}', ['as'=>'tramites.eliminar.rtec','uses' =>'Backend\TecnicaController@destroyRTEC']);

	Route::get('tramites/get/especialidades-tecnicas-rtec/{id_t_rep_tec}', 'Backend\TecnicaController@getEspecialidadesRTEC');

	Route::get('combos/colegios/especialidades/{id_r_tec}', 'Backend\TecnicaController@getColegiosEspecialidades');

	Route::post('tramites/store/especialidades-rtec', 'Backend\TecnicaController@storeEspecialidadRTEC');

	Route::get('tramites/{id_t_rep_tec}/eliminar/especialidades-tecnicas-rtec/{id}', 'Backend\TecnicaController@destroyEspecialidadesRTEC');


	# Rutas - AREA LEGAL
	# Sandro Alan Gomez Aceituno

	# guarda datos generales
	Route::post('tramites-area-legal/store/datos-legales', ['as'=>'tramites-area-legal.store-datos-legales','uses' =>'Backend\LegalController@store_datos_legales']);

	# guarda acta constitutiva
	Route::post('tramites-area-legal/store/acta-constitutiva', ['as'=>'tramites-area-legal.store-acta-constitutiva','uses' =>'Backend\LegalController@store_acta_constitutiva']);

	# Guarda el representante legal
	Route::post('tramites-area-legal/store/representante-legal', ['as'=>'tramites-area-legal.store-representante-legal','uses' =>'Backend\LegalController@store_representante_legal']);

	# carga los datos legales
	Route::get('tramites-area-legal/get/datos-legales/{id_registro_tmp}', ['as'=>'tramites-area-legal.get-datos-legales','uses' =>'Backend\LegalController@get_datos_legales']);

	# Carga el acta constitutiva
	Route::get('tramites-area-legal/get/acta-constitutiva/{id_registro_tmp}', ['as'=>'tramites-area-legal.get-acta-constitutiva','uses' =>'Backend\LegalController@get_acta_constitutiva']);

	Route::get('tramites-area-legal/get/acta-constitutiva-modificacion/{id_registro_tmp}', ['as'=>'tramites-area-legal.get-acta-constitutiva-modificacion','uses' =>'Backend\LegalController@get_acta_constitutiva_modificacion']);

	//carga el representante legal
	Route::get('tramites-area-legal/get/representante-legal/{id_registro_tmp}', 'Backend\LegalController@get_representante_legal');

	# Eliminar solventaciones
	Route::get('tramites/eliminar/{id_tramite_documentacion}/solventacion', 'Backend\MisObservacionesController@eliminar_solventacion');


	//Imprimir el formato de acuse de solventacion de las observaciones
	Route::get('tramites/{id_tramite}/acuse-observacion-solventado/{mode}', ['as'=>'tramites.acuse-observacion-solventado','uses' =>'ImpresionController@acuseObservacionSolventado']);
