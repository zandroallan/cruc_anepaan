@extends('layouts.backend')

	@section('styles')        
	         
	@endsection

	@section('js')
			
		{!! Html::script('public/js/backend/general.js'); !!}
		{!! Html::script('public/js/backend/mis-observaciones.js'); !!}
		{!! Html::script('public/js/backend/tramite.observaciones.js'); !!}

	@endsection

	@section('title')

		<h2 class="main-content-title tx-24 mg-b-5">Observacion</h2>

	@endsection

	@section('breadcrumb')

	    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{!! html_entity_decode(link_to_route($current_route.'.index', $title, null, [])) !!}</h5>	
		<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
		<span class="text-muted font-weight-bold mr-4">Observaciones</span>
		
	@endsection

	@section('script')
		cargarInputs({{ $observacion->id_documentacion }});
		cargar_solventaciones( {{ $observacion->id }});
	@endsection

	@section('content')

		@include('backend.encabezado')

		<div class="card card-custom mb-4">
			<div class="card-body">

			<a href="#" class="text-dark font-weight-bolder text-hover-primary font-size-h4">
				Modulo de solventación <br />
				<?php
					$vdocumentoPadreHijo='';
					if( $observacion->padre == null || $observacion->padre == '' ) {
						$vdocumentoPadreHijo=$observacion->documento;
					}
					else {
						$vdocumentoPadreHijo='<strong>' . $observacion->padre . '</strong> - <span class="text-muted">' . $observacion->documento .'</span>';
					}
				?>
				{!! $vdocumentoPadreHijo !!}
			</a>
			<p class="text-dark-50 font-weight-normal font-size-lg mt-6">
				<i><b>Observación:</b> {{ $observacion->observacion }}</i>
			</p>
			<hr />

			@if ( $observacion->id_status_tramite == 4)
			    <!-- Cargar documentos  -->
			    {!! Form::open(['route' => 'tramites.subir-documento-observacion', 'id'=>'myformdocumento','class'=>'form-horizontal myformdocumento', 'method' => 'post' , 'files' => true, 'enctype'=>'multipart/form-data']) !!}
					{!! Form::hidden('id_observacion', $observacion->id,['id'=>'id_observacion']) !!}               
					{!! Form::hidden('id_tramite', $observacion->id_tramite,['id'=>'id_tramite']) !!}               
					{!! Form::hidden('id_documentacion', $observacion->id_documentacion,['id'=>'id_documentacion']) !!}
					<input type="hidden" name="inputShowButton" id="inputShowButton" value="0">
					
					<div class="text-wrap">	
						<div class="panel-body" id="vcargarInputsArray"></div>
						<div class="example" style="text-align: right;">
							<div class="btn btn-list">									
								<button type="button" id="btnterminarSolventacion" class="btn ripple btn-outline-success" style="display: none;">
									<i class="fa fa-save"></i> Solventar esta observación
								</button>
								<button type="submit" class="btn ripple btn-outline-primary">
									<i class="fa fa-search fa-upload"></i> Cargar documento
								</button>
							</div>
						</div>
					</div>
			    {!! Form::close() !!}
				<!-- Fin Cargar documentos  -->
				@endif

			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="solventaciones_tbl" class="table table-bordered table-checkable dataTable no-footer dtr-inline">
						<thead class="thead-dark head-dark">
							<tr>
								<th style="padding: 15px; color: #fff;">#</th>
								<th style="padding: 15px; color: #fff;">Area</th>
								<th style="padding: 15px; color: #fff;">Status</th>
								<th style="padding: 15px; color: #fff;">Observación</th>
								<th style="padding: 15px; color: #fff;" class="text-center" width="15%">Soporte</th>
								<th style="padding: 15px; color: #fff;">Eliminar</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	@endsection
