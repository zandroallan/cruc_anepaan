@extends('layouts.backend')

	@section('styles')

		<!-- <link href="{{ asset('dashlead/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>
		<link href="{{ asset('dashlead/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet"/>
		<link href="{{ asset('dashlead/plugins/datatable/fileexport/buttons.bootstrap4.min.css') }}" rel="stylesheet"/> -->

	@endsection

	@section('buttons')

		<a href="{{ route($current_route.'.index') }}" class="btn ripple btn-outline-primary">
			Regresar
		</a>

	@endsection

	@section('title')

		<h2 class="main-content-title tx-24 mg-b-5">Mi documentación enviada</h2>

	@endsection

	@section('breadcrumb')

	    <li class="breadcrumb-item">{!! html_entity_decode(link_to_route($current_route.'.index', $title, null, [])) !!}</li>
	    <li class="breadcrumb-item active">Mi documentación enviada</li>

	@endsection

	@section('content')

		@include('backend.encabezado')

		<br />
		<div class="card custom-card overflow-hidden">
			<div class="card-body">
				<div class="row">
					<div class="card-body col-lg-6" style="border: none;">
						<div class="main-profile-contact-list main-profile-work-list">
							<div class="media">
								<div class="media-logo bg-light text-dark">
									<i class="fe fe-disc"></i>
								</div>
								<div class="media-body">
									<span>Estatus área legal</span>
									<div>
										<span class="badge badge-{!! $datosTramite->status_legal_color !!}" style="display: inline; color: #fff;">
											{!! $datosTramite->status_legal !!}
										</span> 
									</div>
								</div>
							</div>
							@if ( $datosTramite->id_sujeto_tramite != 2 )
							<div class="media">
								<div class="media-logo bg-light text-dark">
									<i class="fe fe-disc"></i>
								</div>
								<div class="media-body">
									<span>Estatus área financiera</span>
									<div>
										<span class="badge badge-{!! $datosTramite->status_financiera_color !!}" style="display: inline; color: #fff;">
											{!! $datosTramite->status_financiera !!}
										</span>
									</div>
								</div>
							</div>
							@endif
							<div class="media">
								<div class="media-logo bg-light text-dark">
									<i class="fe fe-disc"></i>
								</div>
								<div class="media-body">
									<span>Estatus área técnica</span>
									<div>
										<span class="badge badge-{!! $datosTramite->status_tecnica_color !!}" style="display: inline; color: #fff;">
											{!! $datosTramite->status_tecnica !!}
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body col-lg-6" style="border: none;">
						<div class="main-profile-contact-list main-profile-work-list">
							<div class="media">
								<div class="media-logo bg-light text-dark">
									<i class="fe fe-disc"></i>
								</div>
								<div class="media-body">
									<span>Estatus general del trámite</span>
									<div> {!! $folio !!} </div>
								</div>
							</div>
							<div class="media">
								<div class="media-logo bg-light text-dark">
									<i class="fe fe-calendar"></i>
								</div>
								<div class="media-body">
									<span>Fecha de inicio del tramite</span>
									<div> {!! $datosTramite->fecha_inicio !!} </div>
								</div>
							</div>															
							<!-- @if ( !empty($vflTramiteCapitalContable) ) -->
							<div class="media">
								<div class="media-logo bg-light text-dark">
									<i class="fe fe-dollar-sign"></i>
								</div>
								<div class="media-body">
									<span>Capital contable</span>																	
									<div>ACTUAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {!! $vcp !!}</div>
								</div>
							</div>
							<!-- @endif -->
						</div>
					</div>
				</div>
			</div>
		</div>

		<hr />
		<div class="card custom-card main-content-body-profile">
			<nav class="nav main-nav-line">
				<a class="nav-link active" data-toggle="tab" href="#tab1over">Documentación enviada</a>
				<a class="nav-link" data-toggle="tab" href="#tab2rev">Observaciones</a>
			</nav>
			<div class="card-body tab-content h-100">
				<div class="tab-pane active" id="tab1over">
					<!--  -->
					<div class="row">
						<div class="col-md-12">
							<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Documentación legal</legend>
							<div class="form-group row m-b-10">
								<div id="doctos-legal" class="col-md-12"></div>
							</div>
							<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Documentación financiera</legend>
							<div class="form-group row m-b-10">
								<div id="doctos-financiera" class="col-md-12"></div>
							</div>
							<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Documentación t&eacute;cnica</legend>
							<div class="form-group row m-b-10">
								<div id="doctos-tecnica" class="col-md-12"></div>
							</div>
						</div>	
					</div>
					<!--  -->
				</div>
				<div class="tab-pane" id="tab2rev">
					<!--  -->
					<div class="row">		
						<div class="col-md-12 form-horizontal form-bordered profile-content">			
							<div class="table-responsive">
				                <table id="solventaciones_nDocumentos_tbl" class="table table-hover mg-b-0">
									<thead>
										<tr>
											<th width="10px">#</th>
											<!-- <th width="100px">Folio</th> -->
											<th >Documento</th>
											<th >Observación</th>
											<!-- <th >Motv/Rechazado</th> -->
											<th class="text-center" width="100px">Área</th>
											<!-- <th class="text-center" width="100px">Status</th>														 -->
											<th class="text-center">Archivo</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>		
						</div>
					</div>
					<!--  -->
				</div>
			</div>
		</div>

	@endsection

	@section('js')

	    <script src="{{ asset('js/backend/mis-documentos.js') }}"></script>

	@endsection

	@section('script')

		cargar_documentacion_lega({{ $id_tipo_tramite }}, {{ $id_tramite }});
		cargar_documentacion_financiera({{ $id_tipo_tramite }}, {{ $id_tramite }}, {{ $datos->obligado_dec_isr }});
		cargar_documentacion_tecnica({{ $id_tipo_tramite }}, {{ $id_tramite }}, {{ $datos->tec_acredita_tmp }});

		cargar_solventaciones({{ $id_tramite }});

	@endsection