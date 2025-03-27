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
	    <li class="breadcrumb-item">{!! html_entity_decode(link_to_route($current_route.'.index', $title, null, [])) !!}</li>
	    <li class="breadcrumb-item active">Solventar observación</li>
	@endsection

	@section('script')
		cargarInputs({{ $observacion->id_documentacion }});
		cargar_solventaciones( {{ $observacion->id }});
	@endsection

	@section('content')

		@include('backend.encabezado')

		<style>
			table td {
		  		font-size: 12px;
			}
		</style>
		<hr />

		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12">
				<div class="pd-10 bg-gray-400" style="text-align: justify;">
					<h4 class="text-dark">Observación</h4>
					<?php
						$vdocumentoPadreHijo='';
						if( $observacion->padre == null || $observacion->padre == '' ) {
			                $vdocumentoPadreHijo=$observacion->documento;
			            }
			            else {
			                $vdocumentoPadreHijo='<strong>' . $observacion->padre . '</strong> - ' . $observacion->documento;
			            }
					?>
					<p>
						<b>{!! $vdocumentoPadreHijo !!}</b>
					</p>
					{{ $observacion->observacion }}
				</div>
			</div>
		</div>
		<hr/>

		@if ( $observacion->id_status_tramite == 4)
	    <!-- Cargar documentos  -->
	    {!! Form::open(['route' => 'tramites.subir-documento-observacion', 'id'=>'myformdocumento','class'=>'form-horizontal myformdocumento', 'method' => 'post' , 'files' => true, 'enctype'=>'multipart/form-data']) !!}
			{!! Form::hidden('id_observacion', $observacion->id,['id'=>'id_observacion']) !!}               
			{!! Form::hidden('id_tramite', $observacion->id_tramite,['id'=>'id_tramite']) !!}               
			{!! Form::hidden('id_documentacion', $observacion->id_documentacion,['id'=>'id_documentacion']) !!}

			<div class="row">
				<div class="col-xl-12 col-lg-12 col-sm-12">
					<div class="card custom-card" >
						<div class="card-body">
							<input type="hidden" name="inputShowButton" id="inputShowButton" value="0">
							
							<div class="text-wrap">
								<div class="example" style="text-align: right;">
									<div class="btn btn-list">									
										<button type="button" id="btnterminarSolventacion" class="btn ripple btn-outline-info" style="display: none;">
											<i class="fa fa-save"></i> Solventar esta observación
										</button>
										<button type="summit" class="btn ripple btn-outline-primary">
											<i class="fa fa-search fa-upload"></i> Cargar documento
										</button>
									</div>
								</div><br>
								
								<div class="panel-body" id="vcargarInputsArray"></div>
							</div>
						</div>
					</div>
				</div>
			</div>    
	    {!! Form::close() !!}
		<!-- Fin Cargar documentos  -->
		@endif

		<div class="row">
			<div class="col-lg-12">
				<div class="card custom-card">
					<div class="card-body">
						<div>
							<h6 class="card-title mb-1">Documentos</h6>
							<p class="text-muted card-sub-title">Documentos cargados de la observación.</p>
						</div>
						<div class="table-responsive">
							<table id="solventaciones_tbl" class="table table-hover">
								<thead style="background-color: #333333 !important;">
									<tr>
										<th style="padding: 15px; color: #fff;">#</th>
										<th style="padding: 15px; color: #fff;">Area</th>
										<th style="padding: 15px; color: #fff;">Status</th>
										<th style="padding: 15px; color: #fff;">Observación</th>
										<th style="padding: 15px; color: #fff;">Soporte</th>
										<th style="padding: 15px; color: #fff;">Eliminar</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- <div class="col-md-4"></div>
		</div> -->

	@endsection
