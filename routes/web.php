<?php

use Illuminate\Support\Facades\Route;

date_default_timezone_set('America/Chihuahua');

Route::get('/', function () {
    return view('auth.login');
});

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
Route::get('buscador', ['as'=>'buscador.index', 'uses'=>'ValidacionController@index']);

Route::get('buscador/search', ['as'=>'buscador.search','uses' =>'ValidacionController@buscar']);

Route::get('buscador/{id}/qr', ['as'=>'buscador.qr','uses' =>'ValidacionController@qr']);

Route::get('certificado/validar', ['as'=>'certificado.validar', 'uses'=>'ValidacionController@validar']);

Route::get('certificado/datos-certificado', ['as'=>'certificado.datos-certificado', 'uses'=>'ValidacionController@getData']);

Route::get('constancia/validacion/{folio}', ['as'=>'constancia.validacion', 'uses'=>'ValidacionController@getValida']);

Route::get('/notificaciones/sin_acusar/cron', 'HomeController@notificacionesSinAcusarCron');

Route::get('/notificaciones/por_expirar/cron', 'HomeController@notificacionesPorExpirarCron');

Route::get('/notificaciones/expiradas/cron', 'HomeController@notificacionesExpiradasCron');

Route::get('/notificaciones/folios/repetidos', 'HomeController@notificacionFolioRepetido');

Route::get('/notificaciones/entregas', 'HomeController@notificacionEntrega');

Route::get('/notificaciones/citas', 'HomeController@notificacionCitas');

Route::get('/notificaciones/apertura', 'HomeController@notificacionApertura');

Route::get('dias/tramites', 'HomeController@diasHabiles');

Route::get('consulta/total-folios', function () {
	return (\App\Http\Models\Backend\T_Tramite::total_anio(date('Y'), 1)) + 1;
});


Route::get('/', function () {
	return redirect('/login');
});

/*Route::get('testlimite', function () {
	$helper= new \App\Http\Classes\Helper;
	$hoy= date('2021-02-15');
	$fechaLimite= $helper->fechaLimieSolventacion($hoy);
	return $fechaLimite;
});*/

//Crea tu cuenta
Route::get('crear-cuenta/registro', ['as'=>'crear-cuenta.registro','uses' =>'Frontend\CrearCuentaController@create']);

Route::post('crear-cuenta/registro', ['as'=>'crear-cuenta.store','uses' =>'Frontend\CrearCuentaController@store']);

Route::post('password/recuperar', ['as'=>'password.recuperar','uses' =>'Frontend\CrearCuentaController@recuperar_password']);

//Servicios en línea
Route::resource('solicitud', 'Frontend\SolicitudRegistroController',['except'=>'']);

//Muestra video youtube
Route::get('videotutorial', ['as'=>'videotutorial','uses' =>'Frontend\VideotutorialController@index']);



Route::group(['middleware' => ['auth']], function () {

	// Begin SAGA: Nuevas rutas

	require base_path('routes/new_route.php');
	
	require base_path('routes/documentacion.php');

	Route::get('tramites/solventaciones/documento-observacion/{id_tramite_observacion}', 
		[
			'as' => 'tramites.solventaciones_subidas', 
			'uses' => 'Backend\MisObservacionesController@solventaciones_subidas'
		]);

	Route::post('tramites/solventaciones/terminar-documento-observacion', 
    	[
    		'as' => 'tramites.solventaciones.terminar-documento-observacion', 
    		'uses' => 'Backend\MisObservacionesController@terminar_solventacion'
    	]);
	// End: SAGA
	
	Route::get('impresion/tramite/observaciones/{id_tramite}', ['as'=>'impresion.tramite.observaciones','uses' =>'ImpresionController@observaciones'])->where('id_tramite', '[0-9]+');

	Route::get('/notificaciones/observaciones', 'HomeController@notificaciones_forzadas')->name('notificaciones.observaciones');
	Route::get('/notificaciones/observaciones/acusar/{id_notificacion}', 'Backend\NotificacionesController@acusar')->name('notificaciones.observaciones.acusar');

	Route::middleware(['notificacionesforzadas'])->group(function() {

		Route::get('tramites/cancelados/{id}/anexo', ['as'=>'tramites.cancelados.anexo','uses' =>'Backend\TramitesController@downloadAdjuntoCancelado'])->where('id', '[0-9]+');
 
		Route::get('/home', 'HomeController@index')->name('home');
		//Mis trámites
		Route::get('tramites/mis-observaciones/{id_tramite}', ['as'=>'tramites.mis-observaciones','uses' =>'Backend\MisTramitesController@mis_observaciones'])->where('id_tramite', '[0-9]+');
		Route::get('mis-tramites/expediente/{id_cs}', ['as'=>'mis-tramites.expediente.mis-tramites','uses' =>'Backend\MisTramitesController@mis_tramites'])->where('id_cs', '[0-9]+');
		Route::get('mis-tramites/tramite/nuevo', ['as'=>'mis-tramites.nuevo.tramite','uses' =>'Backend\MisTramitesController@nuevo_tramite']);
		Route::post('mis-tramites/subir-documento', ['as'=>'mis-tramites.store-document','uses' =>'Backend\MisTramitesController@store_document']);
		Route::post('mis-tramites/subir-documento-tmp', ['as'=>'mis-tramites.store-document-tmp','uses' =>'Backend\MisTramitesController@store_document_tmp']);
		Route::resource('mis-tramites', 'Backend\MisTramitesController',['except'=>'']);
		Route::get('mis-tramites/tramite/{id}/tec-acredita/{id_dec}', ['as'=>'mis-tramites.tec-acredita','uses' =>'Backend\MisTramitesController@tec_acredita']);

		//DEC ANUAL
		Route::get('mis-tramites/tramite/{id}/obligado-dec-isr/{id_dec}', ['as'=>'mis-tramites.obligado-dec-isr','uses' =>'Backend\MisTramitesController@obligado_dec_isr']);

		//Socios legales
		//Lista en la tabla los socios legales
    	Route::get('mis-tramites/listas/socios-legales/{id_tramite}', ['as'=>'mis-tramites.listas.socios-legales','uses' =>'Backend\MisTramitesController@resultados_socios_legales'])->where('id_tramite', '[0-9]+');
		Route::delete('mis-tramites/destroy/socios-legales/{id}', ['as'=>'mis-tramites.destroy-socios-legales','uses' =>'Backend\MisTramitesController@destroy_socios_legales'])->where('id', '[0-9]+');        

		Route::get('mis-tramites/get/socio-legal/{id}', ['as'=>'mis-tramites.get-socio-legal','uses' =>'Backend\MisTramitesController@get_socio_legal'])->where('id', '[0-9]+');
		Route::post('mis-tramites/store/socio-legal', ['as'=>'mis-tramites.store-socios-legales','uses' =>'Backend\MisTramitesController@store_socios_legales']);
		
		
		Route::post('mis-tramites/guardar-contacto', ['as'=>'mis-tramites.guardar-contacto','uses' =>'Backend\MisTramitesController@store_contacto']);
		Route::get('mis-tramites/contacto/get-contacto', ['as'=>'mis-tramites.contacto.get-contacto','uses' =>'Backend\MisTramitesController@getContacto']);
		Route::get('mis-tramites/{id_tramite}/contacto/get-contacto-tramite', ['as'=>'mis-tramites.contacto.set-contacto-tramite','uses' =>'Backend\MisTramitesController@getContactoTramite']);
		Route::get('mis-tramites/condiciones/aceptar', ['as'=>'mis-tramites.aceptar.condiciones','uses' =>'Backend\MisTramitesController@storeCondiciones']);



		Route::post('mis-tramites/subir-documento-soporte', ['as'=>'mis-tramites.store-document-soporte','uses' =>'Backend\MisTramitesController@store_document_soporte']);
		Route::resource('mis-tramites', 'Backend\MisTramitesController',['except'=>'']);		

        //Mis observaciones
        Route::resource('mis-observaciones', 'Backend\MisObservacionesController',['except'=>'']);
        //carga en el index al entrar - desde el js
        Route::get('mis-observaciones/expediente/{id_cs}', ['as'=>'mis-observaciones.expediente.mis-observaciones','uses' =>'Backend\MisObservacionesController@mis_observaciones'])->where('id_cs', '[0-9]+');
        //manda a los detalles de la observacion al dar clic en la observacion en la tabla
        Route::get('detalle/tramite/observacion/{id_tramite}', ['as'=>'detalle.tramite.observacion','uses' =>'Backend\MisObservacionesController@detalle_observacion'])->where('id_tramite', '[0-9]+');		
        //boton que sube archivo de observacion
        Route::post('tramites/publico/subir-documento-observacion', ['as' => 'tramites.subir-documento-observacion', 'uses' => 'Backend\MisObservacionesController@guardar_observacion']);
        //Boton que orpime el contratista cuando ha subido todas sus solventaciones
        Route::get('tramites/{id_tramite}/enviar-solventacion-observacion', ['as' => 'tramites.enviar-solventacion-observacion', 'uses' => 'Backend\MisObservacionesController@enviar_solventacion_observacion']);
                
 		//Listas
		Route::get('listas/documentacion-requerida/{id_tipo_tramite}/registro/{id_registro}/area/{id_area}', ['as'=>'listas.documentacion.requerida.areas','uses' =>'CombosController@lista_documentacion_requerida'])->where('id_tipo_tramite', '[0-9]+');
		Route::get('listas/documentacion-requerida/{id_tipo_tramite}/registro/{id_registro}/area-tecnica/{tec_acredita_tmp}', ['as'=>'listas.documentacion.requerida.areas.tecnica','uses' =>'CombosController@lista_documentacion_requerida_tecnica'])->where('id_tipo_tramite', '[0-9]+');	


                
		//Trámites
		Route::get('tramites-adjuntos/{id}/descargar-tmp', ['as'=>'tramites-adjuntos.descargar-tmp','uses' =>'Backend\TramitesController@download_adjunto_tmp'])->where('id', '[0-9]+');
		Route::get('tramites-adjuntos/{id}/descargar', ['as'=>'tramites-adjuntos.descargar','uses' =>'Backend\TramitesController@download_adjunto'])->where('id', '[0-9]+');
		Route::delete('tramites-adjuntos/eliminar/{id}', ['as'=>'tramites-adjuntos.eliminar','uses' =>'Backend\TramitesController@destroy_adjunto'])->where('id', '[0-9]+');
		Route::get('tramites-adjuntos/{id}/descargar-by-name/{nombre_documento}', ['as'=>'tramites-adjuntos.descargar-by-name','uses' =>'Backend\TramitesController@download_adjunto_by_name'])->where('id', '[0-9]+');

		//Combos
		Route::get('combos/municipios/{id_estado}', ['as'=>'combos.municipios','uses' =>'CombosController@municipios'])->where('id_estado', '[0-9]+');
		Route::get('combos/tipotramite/{id_tipo_tramite}/documentacion/{id_sujeto}', ['as'=>'combos.documentacion.tipotramite','uses' =>'CombosController@documentacion_t_tramite'])->where(['id_tipo_tramite'=> '[0-9]+', 'id_sujeto', '[0-9]+']);
		Route::get('combos/documentacion/{id_tramite}/requerida', ['as'=>'combos.documentacion.requerida','uses' =>'CombosController@documentacion_t_tramite_requerida'])->where('id_tramite', '[0-9]+');
		Route::get('combos/documentacion/{id_tramite}/recibida', ['as'=>'combos.documentacion.recibida','uses' =>'CombosController@documentacion_tramite_recibida'])->where('id_tramite', '[0-9]+');
		Route::get('combos/documentacion/{id_tramite}/adjunta', ['as'=>'combos.documentacion.adjunta','uses' =>'CombosController@documentacion_tramite_adjunta'])->where('id_tramite', '[0-9]+');
		Route::get('combos/documentacion/{id_registro}/adjunta-tmp', ['as'=>'combos.documentacion.adjunta-tmp','uses' =>'CombosController@documentacion_tramite_adjunta_tmp'])->where('id_registro', '[0-9]+');

		Route::get('combos/get-opcionales/{id_documento}', ['as'=>'combos.get-opcionales','uses' =>'CombosController@get_opcionales_documentos'])->where('id_documento', '[0-9]+');		
		Route::get('combos/documentos/{id_tipo_tramite}/registro/{id_registro}/area/{id_area}/acredita/{tec_acredita}', ['as'=>'combos.documentacion.obligatoria','uses' =>'CombosController@lista_documentacion_obligatoria'])->where('id_tipo_tramite', '[0-9]+');		
		//Impresiones
		Route::get('impresion/tramite/constancia-documentacion/{id_tramite}', ['as'=>'impresion.tramite.constancia','uses' =>'ImpresionController@constancia_documentacion'])->where('id_tramite', '[0-9]+');		
		Route::get('impresion/tramite/constancia-documentos/{id_tramite}', ['as'=>'impresion.tramite.documentos','uses' =>'ImpresionController@constancia_documentos'])->where('id_tramite', '[0-9]+');		
		//descargas documentos
		Route::get('descargas-formatos', ['as'=>'descargas-f.index','uses' =>'Backend\DescargasController@index']);
		Route::get('descargas-formatos/{id}/bajar', ['as'=>'descargas-f.bajar','uses' =>'Backend\DescargasController@descargar']);
		Route::get('descargas/resultados', ['as'=>'descargas-f.resultados','uses' =>'Backend\DescargasController@resultados']);


		 //Nuevo
         //trae datos del tramite
         Route::get('tramite/{id}/datos', ['as'=>'tramite.datos','uses' =>'Backend\TramitesController@tramite_datos'])->where('id', '[0-9]+');
         //Listas solo descarga
     	Route::get('listas/documentacion-descarga/{id_tipo_tramite}/tramite/{id_tramite}/area/{id_area}', ['as'=>'listas.documentacion.descarga.areas','uses' =>'CombosController@lista_documentacion_descarga'])->where('id_tipo_tramite', '[0-9]+');

     	Route::get('listas/documentacion-descarga/{id_tipo_tramite}/tramite/{id_tramite}/area-tecnica/{tec_acredita_tmp}', ['as'=>'listas.documentacion.descarga.areas.tecnica','uses' =>'CombosController@lista_documentacion_descarga_tecnica'])->where('id_tipo_tramite', '[0-9]+');	
	
		//carga los documentos del area financiera, verificando si esta o no obligado a presentar declaracion anual
		Route::get('listas/documentacion-requerida/{id_tipo_tramite}/registro/{id_registro}/area-financiera/{obligado_dec_isr}', ['as'=>'listas.documentacion.requerida.areas.financiera','uses' =>'CombosController@lista_documentacion_requerida_financiera_obligado'])->where('id_tipo_tramite', '[0-9]+');	 

		//carga los documentos del area financiera, solo descarga de documentos despues de enviar el tramite
		Route::get('listas/documentacion-descarga/{id_tipo_tramite}/tramite/{id_tramite}/area-financiera/{obligado_dec_isr}', ['as'=>'listas.documentacion.descarga.areas.financiera','uses' =>'CombosController@lista_documentacion_requerida_financiera_descarga'])->where('id_tipo_tramite', '[0-9]+');



		# Rutas Nuevas SAGA
		Route::get('cambiar/observacion/{id_observacion}/tramite', 
			'Backend\MisObservacionesController@volverCargarObservacion');

		Route::get('tramites/seguimientos', ['as'=>'tramites.seguimientos', 'uses' =>'Backend\TramitesController@tramitesSeguimientos']);



		# Rutas nuevas SAGA - Modificaciones del 2025
		// Route::post('tramites-area-financiera/recuperar-contador-publico', 
			// 'Backend\FinancieraController@recuperar_contador_publico');
			
		Route::get('financiero/capital/contable', 'Backend\FinancieraController@api_capital_contable');

		Route::get('financiero/estados/financieros', 'Backend\FinancieraController@api_estados_financieros');

		Route::post('capital/contable/store', 
			'Backend\FinancieraController@store_capital_contable');


	});
});

Auth::routes();

