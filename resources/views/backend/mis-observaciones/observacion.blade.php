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

		<style>
			.input-file {
			    background-color: #D1D3E0;
			    border: 1px solid #181824;
			    border-radius: 6px;
			    height: 40px;
			    width: 100%;
			    color: #111833;
			    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); /* Sombra más intensa y grande */
			    transition: all 0.3s ease-in-out; /* Suaviza las transiciones */
			}

			.input-file::file-selector-button {
			    font-size: 14px;			    
			    border: 1px solid #181824;
			    border-radius-left-top: 6px;
			    border-radius-left-bottom: 6px;
			    color: white;
			    background-color: #181824;	
			    border: 1px solid #181824;
			    height: 40px;
			    cursor: pointer;
			    transition: all .25s ease-in;
			    width: 150px;
			    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra más notoria para el botón */
			}

			.input-file::file-selector-button:hover {
			    background-color: #1F1E2E;
			    color: #fff;
			    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Sombra más destacada en hover */
			    transition: all .25s ease-in;
			}

			.input-file:hover {
			    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4); /* Sombra más fuerte al pasar el ratón */
			}

		</style>

		<div class="alert alert-custom alert-light-dark fade show mb-2" role="alert">
				<div class="alert-icon">
					<span class="svg-icon svg-icon-primary svg-icon-3x">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						        <rect x="0" y="0" width="24" height="24"/>
						        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
						        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>
						    </g>
						</svg>
					</span>
				</div>
				<div class="alert-text font-weight-bold">
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

		<div class="card">
			<div class="card-body">
				@if ( $observacion->id_status_tramite == 4)
			    <!-- Cargar documentos  -->
			    {!! Form::open(['route' => 'tramites.subir-documento-observacion', 'id'=>'myformdocumento','class'=>'form-horizontal myformdocumento', 'method' => 'post' , 'files' => true, 'enctype'=>'multipart/form-data']) !!}
					{!! Form::hidden('id_observacion', $observacion->id,['id'=>'id_observacion']) !!}               
					{!! Form::hidden('id_tramite', $observacion->id_tramite,['id'=>'id_tramite']) !!}               
					{!! Form::hidden('id_documentacion', $observacion->id_documentacion,['id'=>'id_documentacion']) !!}
					
						<div class="card custom-card" >
							<div class="card-body">
								<input type="hidden" name="inputShowButton" id="inputShowButton" value="0">
								
								<div class="text-wrap">	
									<div class="panel-body" id="vcargarInputsArray"></div>

									<div class="example" style="text-align: right;">
										<div class="btn btn-list">									
											<button type="button" id="btnterminarSolventacion" class="btn ripple btn-outline-info" style="display: none;">
												<i class="fa fa-save"></i> Solventar esta observación
											</button>
											<button type="submit" class="btn ripple btn-outline-primary">
												<i class="fa fa-search fa-upload"></i> Cargar documento
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>						    
			    {!! Form::close() !!}
				<!-- Fin Cargar documentos  -->
				@endif

				<div class="table-responsive">
					<table id="solventaciones_tbl" class="table table-hover">
						<thead style="background-color: #333333 !important;">
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
