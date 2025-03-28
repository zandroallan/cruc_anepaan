	@extends('layouts.backend')

		@section('styles')	

			<!-- <link href="{{ asset('public/dashlead/plugins/select2/css/select2.min.css') }}" rel="stylesheet"/> -->
			<link href="{{ asset('public/css/tabs.css') }}" rel="stylesheet"/>

		@endsection

		@section('js')

			<!-- <script src="{{ asset('public/dashlead/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script> -->
			<!-- <script src="{{ asset('public/dashlead/plugins/select2/js/select2.min.js') }}"></script> -->
			<!-- <script src="{{ asset('public/dashlead/js/select2.js') }}"></script> -->
			<script src="{{ asset('public/js/backend/general.js') }}"></script>			
			<script src="{{ asset('public/js/backend/mis-tramites.js') }}"></script>
			<!--Archivos para los documentos de las areas-->
			<script src="{{ asset('public/js/backend/filesDoctos/jsDocumentosTools.js') }}"></script>	
			<script src="{{ asset('public/js/backend/filesDoctos/jsDocumentosLegal.js') }}"></script>	
			<script src="{{ asset('public/js/backend/filesDoctos/jsDocumentosFinanciera.js') }}"></script>	
			<script src="{{ asset('public/js/backend/filesDoctos/jsDocumentosTecnica.js') }}"></script>	
			<!--Archivos para los formularios-->
			<script src="{{ asset('public/js/backend/filesForms/jsCombos.js') }}"></script>
			<script src="{{ asset('public/js/backend/filesForms/mdl_area_legal.js') }}"></script>	
			<script src="{{ asset('public/js/backend/filesForms/mdl_rep_tec.js') }}"></script>
			<script src="{{ asset('public/js/backend/filesForms/jsChecks.js') }}"></script>	
			<!-- Archivos para los form area legal-->
			<script src="{{ asset('public/js/backend/filesForms/jsLegal.js') }}"></script>
			<script src="{{ asset('public/js/backend/filesForms/contacto.js') }}"></script>
			
		@endsection

		@section('buttons')

			<?php 
				$cierreVentanilla=0;
				
				if ( count($idRegistroAutorizado) > 0 ) {
					foreach ($idRegistroAutorizado as $key => $value) {
						if ( (int)$value == (int)Auth::User()->id_registro ) {
							$cierreVentanilla = -1;
						}
					}
				}
				if ( $ventanillaCerrada && $cierreVentanilla == 0 ) {
				    $cierreVentanilla = 1;
				}
				else { 
			?>
				@if ( $terminos != 0 )
					<button class="btn btn-outline-primary btn-sm mr-3 my-2 my-lg-0" onclick="send_1(this);">
						<i class="fa fa-save"></i> <b>Guardar avance</b>
					</button>
					<button class="btn btn-outline-success btn-sm mr-3 my-2 my-lg-0" onclick="send(this);">
						<i class="fa fa-envelope"></i> <b>Enviar trámite</b>
					</button>			
				@endif

			<?php } ?>

			<a href="{{ route($current_route.'.index') }}" class="btn btn-outline-dark btn-sm mr-3 my-2 my-lg-0">
				<i class="fa fa-arrow-left"></i> <b>Atrás</b>
			</a> 
		@endsection


		@section('title')
			<h2 class="main-content-title tx-24 mg-b-5">Nuevo trámite</h2>
		@endsection

		@section('breadcrumb')
			<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{!! html_entity_decode(link_to_route($current_route.'.index', $title, null, [])) !!}</h5>
		
			<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
			<span class="text-muted font-weight-bold mr-4">Generando un nuevo trámite</span>
		@endsection

		@section('script')
			$('.fc-datepicker').datepicker({
				dateFormat: 'dd/mm/yy',
				showOtherMonths: true,
				selectOtherMonths: true
			});

			id_tramite_global = {{ Auth::User()->id_registro }};		

			$('#customSwitch1').click(function() {
			    if ($(this).is(':checked')) {
			      aceptar_terminos();
			    }
		    });

		    if({{ $terminos }}==1) {

				cargar_documentacion_requerida_legal(<?php echo $id_tipo_tramite; ?>, 2, <?php echo $datos->id; ?>)

				if(<?php echo $datos->id_sujeto; ?>==1){
					cargar_documentacion_requerida_financiera(<?php echo $id_tipo_tramite; ?>, 3, <?php echo $datos->id; ?>, <?php echo $datos->obligado_dec_isr; ?>);
				}

				cargar_documentacion_requerida_tecnica(<?php echo $id_tipo_tramite; ?>, 4, <?php echo $datos->id; ?>, <?php echo $datos->tec_acredita_tmp; ?>)

				cargar_socios_legales({{ Auth::User()->id_registro }});

				get_datos_legales({{ Auth::User()->id_registro }});
				get_acta_constitutiva({{ Auth::User()->id_registro }});
				get_acta_constitutiva_modificacion({{ Auth::User()->id_registro }});
				get_representante_legal({{ Auth::User()->id_registro }});

				cargar_rtecs({{ Auth::User()->id_registro }});	

				if({{$id_contacto}}!=0)
				{
					$("#btn-guardar-contacto").html('Editar contacto');
					cargar_contacto(); 
					$('#iconContacto').show();
				}
				else
				{
					$('#iconContacto').hide();
				}
				
				tipo_persona(<?php echo $datos->id_tipo_persona; ?>);
						
				if(<?php echo $datos->id_tipo_persona; ?> != 1){
					$('#vnavSocioLegal').show();
					$('#vtabSocioLegal').show();
				}
				else {
					$('#vnavSocioLegal').hide();
					$('#vnavSocioLegal').hide();
				}
				
				//cargar_socios_legales({{ $datos->id }});
			}

		@endsection

		@section('content')

			@include('backend.encabezado')
			


			<div class="alert alert-custom alert-light-dark fade show mb-5" role="alert">
			    <div class="alert-icon"><i class="flaticon-warning"></i></div>
			    <div class="alert-text">
			    	<h5>Trámite en proceso de <span class="text-primary">{{ $lbl_tramite_siguiente }}</span>
			    		<br />
					<strong style="color: #ed8b00"><i class="fe fe-info"></i> Advertencia!</strong> Este tramite aun no ha sido enviado.</h5>
				</div>			    
			</div>	

			@if( $cierreVentanilla == 1 )
			<div class="alert alert-custom alert-outline-2x alert-outline-dark fade show mb-5" role="alert">
			    <div class="alert-icon"><i class="flaticon-warning"></i></div>
			    <div class="alert-text">
			    	<b>Cierre de Ventanilla:</b>
					A las y los Contratistas o Supervisores Externos, se les comunica el cierre de la ventanilla, para el trámite y expedición de las constancias de Registro de Contratistas y de Registro Supervisores Externos concluyó el día 07 de Octubre de 2022 hasta nuevo aviso.
			    </div>
			</div>
			@endif
			
			@if($terminos==0)
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<center>
						<div class="alert alert-custom alert-outline-2x alert-outline-dark fade show mb-5" role="alert">
						    <div class="alert-icon"><i class="flaticon-warning"></i></div>
						    <div class="alert-text">
						    	<h5><i class="fa fa-info-circle"></i> Atención</h5>
								<p>
									Para poder continuar con su tramite es necesario que lea todos los lineamientos, por ultimo debera aceptar los terminos y condiciones de lo contrario no podra continuar con el tramite correspondiente.
								</p>
								<div class="custom-control custom-switch">
								  <input type="checkbox" class="custom-control-input" id="customSwitch1" name="customSwitch1">
								  <label class="custom-control-label" for="customSwitch1"><b>Acepto todos los terminos y condiciones a los que estoy sujeto.</b></label>
								</div>
						    </div>
						</div>
					</center>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<center><embed src="{{ asset('public/descargas/LineamientosCS.pdf') }}" width="1000" height="550" alt="pdf" /></center>
				</div>			
			</div>
			@else
			<div class="row">
				<div class="col-lg-12">
					<div class="accordion accordion-toggle-arrow" id="accordionExample1">
						<div class="card">
							<div class="card-header">
								<div class="card-title" data-toggle="collapse" data-target="#collapseOne1">Informaci&oacute;n importante</div>
							</div>
							<div id="collapseOne1" class="collapse" data-parent="#accordionExample1">
								<div class="alert alert-custom alert-outline-info fade show mb-1" role="alert">
								    <div class="alert-text">
								    	<b>Información importante</b><br>
								    	<p>La Secretaría procederá al análisis de la documentación proporcionada, en caso de que no cumpla con los requisitos aplicables o se le requiera alguna aclaración. La Secretaría prevendrá por una sola vez, para que subsane la omisión u observaciones dentro del término de <b>cinco días hábiles</b>, contados a partir de que haya surtido efectos la notificación; transcurrido el plazo sin que el solicitante desahogue la prevención, se desechará el trámite de la solicitud, pudiendo el interesado solicitar nuevamente el trámite correspondiente.</p>
										  <hr>
										  <p class="mb-0">La Secretaría tendrá por recibida una solicitud y comenzará a correr el plazo de treinta días naturales, para que otorgue o niegue la constancia de inscripción, modificación o actualización en el registro de Contratistas o de Supervisores Externos, cuando el solicitante solvente las observaciones o presente la documentación completa con todos los requisitos.</p>
								    </div>					    
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card card-custom">
				<div class="card-body">
					@include('backend.mis-tramites.tabs')
				</div>
			</div>
			@endif

		@endsection