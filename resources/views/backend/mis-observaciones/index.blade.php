@extends('layouts.backend')

	@section('styles')

		<!-- <link href="{{ asset('public/dashlead/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/> -->
		<!-- <link href="{{ asset('public/dashlead/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet"/> -->
		<!-- <link href="{{ asset('public/dashlead/plugins/datatable/fileexport/buttons.bootstrap4.min.css') }}" rel="stylesheet"/> -->

	@endsection

	@section('js')

		<!-- <script src="{{ asset('public/dashlead/plugins/datatable/jquery.dataTables.min.js') }}"></script> -->
	    <!-- <script src="{{ asset('public/dashlead/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script> -->
	    <!-- <script src="{{ asset('public/dashlead/plugins/datatable/dataTables.responsive.min.js') }}"></script> -->
	    <script src="{{ asset('public/js/backend/general.js') }}"></script>
	    <script src="{{ asset('public/js/backend/mis-observaciones.js') }}"></script>

	@endsection

	@section('buttons')	
		@if($status_t==5)
			<a href="{{ Route('tramites.acuse-observacion-solventado', [$datos->id_ultimo_tramite, 'D']) }}" class="btn ripple btn-outline-dark" target="_blank">
					<i class="fa fa-file-pdf t-plus-1 text-danger fa-fw fa-lg"></i> Acuse de observaciones solventadas
			</a>
		@endif

		@if( ($id_c_tramites_seguimiento != 0) && ($id_c_tramites_seguimiento == 2)	)
			<a href="{{ Route('impresion.tramite.observaciones', $datos->id_ultimo_tramite) }}" class="btn ripple btn-outline-danger">
				<i class="fa fa-file-pdf t-plus-1 text-danger fa-fw fa-lg"></i> Observaciones
			</a>
		@endif

		@if( $en_tiempo!=1 && $datos->id_ultimo_tramite != 0)
			@if($si_o_no==1 )                                                
		 		@if($yano==0 )
					@if($en_tiempo!=1)
						{!! html_entity_decode(link_to_route('tramites.enviar-solventacion-observacion','<i class="fa fa-paper-plane"></i> Enviar solventacion de observaciones', [$datos->id_ultimo_tramite],['class'=>'btn ripple btn-outline-warning', 'aria-expanded'=>'false'])) !!}           
					@endif
				@endif
			@endif
		@endif
	@endsection

	@section('title')
		<h2 class="main-content-title tx-24 mg-b-5">Mis Observaciones</h2>
	@endsection

	@section('breadcrumb')

		<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{!! html_entity_decode(link_to_route($current_route.'.index', $title, null, [])) !!}</h5>	
		<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
		<span class="text-muted font-weight-bold mr-4">Observaciones</span>

	@endsection

	@section('script')
		

		

		$('._observaciones').addClass('menu-item-active');
		cargar_mis_observaciones({{ $datos->id_ultimo_tramite }});	

		var avisoEnvioSolventacion ="Los Archivos han sido cargados, a continuación proceda a enviar las solventaciones,";
			avisoEnvioSolventacion+="para la revisión de las áreas de la Coordinacion de Verificación de la Supervisión Externa de la Obra Pública Estatal.";


		@if ( $en_tiempo != 1 && $datos->id_ultimo_tramite != 0 )
			@if( $si_o_no==1 )
				@if( $yano==0 )

					$.confirm({
				        title: '¡ Advertencia !',
				        content: avisoEnvioSolventacion,
				        type: 'orange',
				        theme: 'material',
				        buttons: {
				            Aceptar: function() {
				                enviar_solventacion( {{ $datos->id_ultimo_tramite }} );
				            },
				            Cancelar: function() {
			                    $.alert({
							        title: 'Mensaje!',
							        content: '¡El usuario ha cancelado la acción!',
							    });
				            }
				        }
				    });
					
				@endif
			@endif
		@endif

	@endsection

	@section('content')
	<style>
		table.dataTable td {
	  		font-size: 12px;
		}
	</style>

		@include('backend.encabezado')
		@if($en_tiempo!=1)	

			<div class="alert alert-custom alert-light-dark fade show mb-2" role="alert">
				<div class="alert-icon">
					<span class="svg-icon svg-icon-3x svg-icon-dark">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Code/Info-circle.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24"></rect>
								<circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"></circle>
								<rect fill="#000000" x="11" y="10" width="2" height="7" rx="1"></rect>
								<rect fill="#000000" x="11" y="7" width="2" height="2" rx="1"></rect>
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</div>
				<div class="alert-text font-weight-bold">
					@if($contar_observaciones!=0)
						@if($si_o_no==1 )
							<p>
								<i class="task-icon bg-secondary"></i>
								<h6>Observaciones @if($yano==0 )-  Tiene hasta el dia {{$fecha_larga}} para solventar @endif</h6>
							</p>
						@else
							<p>
								<i class="task-icon bg-secondary"></i>
								<h6>Revise periódicamente su correo electrónico proporcionado para avisos y notificaciones del Sistema.<br /> Tiene hasta el dia {{$fecha_larga}} para solventar. Gracias por su atención.</h6>
							</p>
						@endif
					@else
						<p>
							<i class="task-icon bg-secondary"></i>
							<h6>No tiene observaciones</h6>
						</p>
					@endif
				</div>
			</div>

			@if($yano==1 )
				<div class="alert alert-dark mb-0" role="alert">
				  	<h4 class="alert-heading"><b>Las solventaciones han sido enviadas.</b></h4>
				  	<p class="text-justify">La Secretaría tendrá por recibida una solicitud y comenzará a correr el plazo de treinta días naturales, para que otorgue o niegue la constancia de inscripción, modificación o actualización en el registro de Contratistas o de Supervisores Externos, cuando el solicitante solvente las observaciones o presente la documentación completa con todos los requisitos.</p>
				  	<hr>
				  	<p class="mb-0 text-justify">Todos los seguimientos al trámite se le notificarán a su cuenta en el Portal del contratista y a este correo electrónico.</p>
				</div>				
			@endif	


		@elseif($en_tiempo==0 && $status_t==5)
			<div class="alert alert-dark mb-0" role="alert">
			  	<h4 class="alert-heading"><b>Informaci&oacute;n.</b></h4>
			  	<p class="text-justify">La fecha limite para solventar sus observaciones ha vencido. Por lo anterior el tramite con folio: <b>{!! $folio_t !!}</b> y fecha limite de solventaci&oacute;n: <b>{!! $f_limite !!}</b> ha sido <b>cancelado</b>.</p>		  	
			</div>
		@endif

		<div class="row">
			<div class="col-lg-12">
				<div class="card custom-card overflow-hidden">
					<div class="card-body">
						<div>
							<h6 class="card-title mb-1">Observaciones del trámite</h6>
							<p class="text-muted card-sub-title">Listado observaciones realizadas al trámite.</p>
						</div>
						<!-- <div class="row">
							<div class="col-lg-6"></div>
							<div class="col-lg-6">
								<div class="search">
							      <input type="text" id="searchBox" class="searchTerm" name="searchBox">
							      <button type="submit" class="searchButton">
							        <i class="fa fa-search"></i>
							     </button>
							    </div>
							</div>
						</div> -->
							
						<div class="table-responsive">
							<table id="mis-observaciones" class="table table-bordered table-checkable dataTable no-footer dtr-inline">
								<thead class="thead-dark head-dark">
									<tr>
										<!-- <th style="color: #fff; padding: 15px 15px;">#</th> -->
										<th style="color: #fff; padding: 15px 15px;">
											<i class="far fa-check-circle"></i>
										</th>
										<th style="color: #fff; padding: 15px 15px;" class="wd-10p">FOLIO</th>
										<th style="color: #fff; padding: 15px 15px;">DOCUMENTO OBSERVADO</th>
										<th style="color: #fff; padding: 15px 15px;">OBSERVACIÓN</th>
										<th style="color: #fff; padding: 15px 15px;">ÁREA</th>
										<th style="color: #fff; padding: 15px 15px;">ESTATUS</th>
										<th style="color: #fff; padding: 15px 15px;">ACCIONES</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Inicio modal documentos del trámite -->
		<div class="modal modal-message fade" id="modal-message">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Documentación adjunta al trámite <span id="modal-folio"></span></h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						{!! Form::open(['route' => ['tramites-adjuntos.eliminar', 0], 'id'=>'frm-destroy-adjunto', 'name'=>'frm-destroy-adjunto','method' => 'DELETE'], ['role' => 'form']) !!}
						{!! Form::close() !!}					
					{{-- 	{!! Form::open(['route' => $current_route.'.store-document', 'method' => 'POST' , 'files' => true, 'id' => 'frm-subir-adjunto', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']) !!}  --}}
		    				{!! Form::hidden('id_tramite', null,['id'=>'id_tramite', 'class'=>'form-control gui-input']) !!}
							<div class="form-group row m-b-15">
								<label for="id_documento" class="col-form-label col-md-1">Documento*</label>
								<div class="col-md-5">
									{!! Form::select('id_documento', $documentos_requeridos, null, ['id' => 'id_documento', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control']) !!}
									<div id="el-id_documento" class="invalid-feedback lbl-error"></div>
								</div>
								<div class="col-md-5">									
									<input type="file" id="archivosubido" name="archivosubido" class="form-control">
									<div id="el-archivosubido" class="invalid-feedback lbl-error"></div>									
								</div>	
								<div class="col-md-1">
									<button type="button" class="btn btn-primary" onclick="upload(this)"><i class="fa fa-search fa-upload"></i> Subir</button>
								</div>								
							</div>
						{!! Form::close() !!}
						<br><br>
						<div class="row">
							<div class="col-md-4">
								<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Área legal</legend>								
								<div id="doctos-legal" class="col-md-12">								
								</div>
							</div>
							<div class="col-md-4">
								<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Área técnica</legend>
								<div id="doctos-tecnica" class="col-md-12">
								</div>
							</div>
							<div class="col-md-4">
								<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Área financiera</legend>
								<div id="doctos-financiera" class="col-md-12">
								</div>
							</div>
						</div>
						
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Cerrar</a>
					</div>
				</div>
			</div>
		</div>							
		<!-- Fin modal documentos del trámite -->

		<!-- <div class="col-md-4"></div>
		</div> -->

	@endsection
