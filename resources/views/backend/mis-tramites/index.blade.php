@extends('layouts.backend')

@section('styles')

	<link href="{{ asset('public/dashlead/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>
	<link href="{{ asset('public/dashlead/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet"/>
	<link href="{{ asset('public/dashlead/plugins/datatable/fileexport/buttons.bootstrap4.min.css') }}" rel="stylesheet"/>

@endsection

@section('js')

    <script src="{{ asset('public/dashlead/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/dashlead/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/dashlead/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/js/backend/general.js') }}"></script>
    <script src="{{ asset('public/js/backend/mis-tramites.js') }}"></script>

@endsection

@section('buttons')

<?php
	$cierreVentanilla = 0;
	/**
	 * Hacer que ciertas empresas puedan hacer el tramite
	 * */
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

	@if($tramite_siguiente==1 || $tramite_siguiente==2 || $tramite_siguiente==3)
		<a href="{{ route($current_route.'.nuevo.tramite') }}" class="btn ripple btn-dark">Nuevo trámite de {!!$lbl_tramite_siguiente !!}</a>
	@endif

<?php }?>
@endsection

@section('title')
	<h2 class="main-content-title tx-24 mg-b-5">Historial de trámites</h2>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">{!! html_entity_decode(link_to_route($current_route.'.index', $title, null, [])) !!}</li>
    <li class="breadcrumb-item active">Expediente</li>
@endsection

@section('script')

	$('._inicio').addClass('menu-item-active');
	cargar_mis_tramites({{ $datos->id }});


@endsection

@section('content')
<style>
	table.dataTable td {
  		font-size: 12px;
	}	      
</style>
	@include('backend.encabezado')

	<div class="row">
		<div class="col-lg-12">
			@if( $cierreVentanilla == 1 )
			<div class="alert alert-warning fade show m-b-0">
				<b>Cierre de Ventanilla:</b>
				A las y los Contratistas o Supervisores Externos, se les comunica el cierre de la ventanilla, para el trámite y expedición de las constancias de Registro de Contratistas y de Registro Supervisores Externos concluyó el día 07 de Octubre de 2022 hasta nuevo aviso.
			</div>
			@endif
		</div>
	</div>

	@if($tramite_siguiente!=1 && $tramite_siguiente!=2 && $tramite_siguiente!=3)
		@if($tramite_siguiente==88)

			<div class="alert alert-dark mb-0" role="alert">
			  	<h4 class="alert-heading text-danger"><b>Usted tiene un <strong>"{{ $lbl_tramite_siguiente }}"</strong>.</b></h4>
			  	<p class="text-justify">La Secretaría procederá al análisis de la documentación proporcionada, en caso de que no cumpla con los requisitos aplicables o se le requiera alguna aclaración. La Secretaría prevendrá por una sola vez, para que subsane la omisión u observaciones dentro del término de <b>cinco días hábiles</b>, contados a partir de que haya surtido efectos la notificación; transcurrido el plazo sin que el solicitante desahogue la prevención, se desechará el trámite de la solicitud, pudiendo el interesado solicitar nuevamente el trámite correspondiente.</p>
			  	<hr>
			  	<p class="mb-0 text-justify">La Secretaría tendrá por recibida una solicitud y comenzará a correr el plazo de treinta días naturales, para que otorgue o niegue la constancia de inscripción, modificación o actualización en el registro de Contratistas o de Supervisores Externos, cuando el solicitante solvente las observaciones o presente la documentación completa con todos los requisitos.</p>
			</div>
		@endif
		@if($tramite_siguiente==89)
			<div class="alert alert-dark mb-0" role="alert">
			  	<h4 class="alert-heading text-danger"><b>Advertencia</b></h4>
			  	<p class="text-justify">Usted tiene un <strong>"{{ $lbl_tramite_siguiente }}"</strong>.</p>
			</div>
		@endif
		@if($tramite_siguiente==90)
			<div class="alert alert-dark mb-0" role="alert">
			  	<h4 class="alert-heading text-danger"><b>Advertencia</b></h4>
			  	<p class="text-justify">Usted tiene un <strong>"{{ $lbl_tramite_siguiente }}"</strong>.</p>
			</div>
		@endif
		@if($tramite_siguiente==100)
			<div class="alert alert-dark mb-0" role="alert">
			  	<h4 class="alert-heading text-danger"><b>Advertencia</b></h4>
			  	<p class="text-justify">Usted tiene un <strong>"{{ $lbl_tramite_siguiente }}"</strong>.</p>
			</div>
		@endif
	@endif

	<br />

	<div class="card card-custom card-sticky" id="kt_page_sticky_card">
		<div class="card-header">
			<div class="card-title">
				<h3 class="card-label">
					Trámites <br />
					<small class="">Listado de trámites genereados por el contratista</small>
				</h3>
			</div>
		</div>
		<div class="card-body">
			<!--  -->

			<!-- <div class="row">
				<div class="col-lg-4"></div>
				<div class="col-lg-8">
					<div class="search">
				      <input type="text" id="searchBox" class="searchTerm" name="searchBox">
				      <button type="submit" class="searchButton">
				        <i class="fa fa-search"></i>
				     </button>
				    </div>
				</div>
			</div> -->
			
			<div class="table-responsive _response"></div>
			<!--  -->
		</div>
	</div>

	<div class="modal modal-message-contacto fade" id="modal-message-contacto">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Datos del contacto</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="form-group row m-b-15">
						<label class="col-sm-3 col-form-label">Nombre</label>
						<div class="col-sm-9">
							<input class="form-control" type="text" id="txtNombre" name="txtNombre" readonly />
						</div>
					</div>

					<div class="form-group row m-b-15">
						<label class="col-sm-3 col-form-label">Paterno</label>
						<div class="col-sm-9">
							<input class="form-control" type="text" id="txtPaterno" name="txtPaterno" readonly />
						</div>
					</div>

					<div class="form-group row m-b-15">
						<label class="col-sm-3 col-form-label">Materno</label>
						<div class="col-sm-9">
							<input class="form-control" type="text" id="txtMaterno" name="txtMaterno" readonly />
						</div>
					</div>

					<div class="form-group row m-b-15">
						<label class="col-sm-3 col-form-label">Cargo</label>
						<div class="col-sm-9">
							<input class="form-control" type="text" id="txtCargo" name="txtCargo" readonly />
						</div>
					</div>

					<div class="form-group row m-b-15">
						<label class="col-sm-3 col-form-label">Clave de atencion</label>
						<div class="col-sm-9">
							<input class="form-control" type="text" id="txtClave" name="txtClave" readonly />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn ripple btn-dark" data-dismiss="modal">Cerrar</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Nuevo Inicio modal documentos del trámite -->
	<div class="modal modal-message fade" id="modal-message">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Documentación adjunta al trámite <span id="modal-folio"></span></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					{!! Form::hidden('id_tramite', null,['id'=>'id_tramite', 'class'=>'form-control gui-input']) !!}

					<div class="row">
        				<div class="col-md-12">

            				<p style="display:none">
            					<b>Nota:</b> Los documentos presentados deben ser legibles para evitar ser observados. El tamaño maximo de <b>cada archivo no debe sobrepasar los 40mb</b>. Los archivos deben ser subidos en formato <b>PDF</b>.
            				</p>

            				<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Documentación legal</legend>
				            <div class="form-group row m-b-10">
				                <div id="doctos-legal" class="col-md-12"></div>
				            </div>

							@if($datos->id_sujeto==1)
								<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Documentación financiera</legend>
								<div  class="col-md-12">
									<div class="form-group row align-items-center">
										<label style="display:none" class="col-md-2 col-form-label">Los Suscritos manifestamos, bajo protesta de decir verdad, que la empresa no estamos obligados a presentar la Declaración Anual del Impuesto Sobre la Renta. motivo por el cual asumimos cualquier responsabilidad administrativa y/o penal derivada de cualquier declaración en falso sobre las mismas</label>
									</div>
								</div>

								@if($datos->obligado_dec_isr==1)
				                	<p>Los Suscritos manifestamos, bajo protesta de decir verdad, que la empresa si esta obligada a presentar la Declaración Anual del Impuesto Sobre la Renta.</p>
				               @else
				               	<p>Los Suscritos manifestamos, bajo protesta de decir verdad, que la empresa no esta obligada a presentar la Declaración Anual del Impuesto Sobre la Renta.</p>
				               @endif

								<div class="form-group row m-b-10">
									<div id="doctos-financiera" class="col-md-12"></div>
								</div>
							@endif

            				<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Documentación técnica</legend>
				            <div class="form-group row m-b-10">
				                <div id="doctos-tecnica" class="col-md-12"></div>
				            </div>
        				</div>
    				</div>
			   	</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn ripple btn-dark" data-dismiss="modal">Cerrar</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Nuevo modal documentos del trámite -->
@endsection


