<?php

	// Begin SAGA: rutas nuevas 2024
	Route::get('mis-tramites/{id_tramite}/documentacion', 'Backend\DocumentacionController@mi_documentacion');

	// End: SAGA

	Route::get('documentacion/{id_tipo_tramite}/tramite/{id_tramite}/legal', 'Backend\DocumentacionController@lista_documentacion_legal')->where('id_tipo_tramite', '[0-9]+');

	Route::get('documentacion/{id_tipo_tramite}/tramite/{id_tramite}/financiera/{obligado_dec_isr}', 'Backend\DocumentacionController@lista_documentacion_financiera')->where('id_tipo_tramite', '[0-9]+');

	Route::get('documentacion/{id_tipo_tramite}/tramite/{id_tramite}/tecnica/{tec_acredita_tmp}', 'Backend\DocumentacionController@lista_documentacion_tecnica')->where('id_tipo_tramite', '[0-9]+');

	

	Route::get('documentacion/adjunta/{id}/descargar', 'Backend\DocumentacionController@documentacion_adjunta_descargar')->where('id', '[0-9]+');

	Route::get('documentacion/adjunta/{id}/descargar-by-name/{nombre_documento}', 'Backend\DocumentacionController@documentacion_adjunta_descargar_by_name')->where('id', '[0-9]+');



	Route::get('tramites/solventaciones/{id}', 'Backend\DocumentacionController@solventaciones')->where('id', '[0-9]+');