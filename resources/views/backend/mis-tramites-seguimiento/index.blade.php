@extends('layouts.backend')

	@section('title')
		<h2 class="main-content-title tx-24 mg-b-5">Seguimiento Trámite</h2>
	@endsection

	@section('breadcrumb')

		<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{!! html_entity_decode(link_to_route('mis-tramites.index', $title, null, [])) !!}</h5>	
		<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
		<span class="text-muted font-weight-bold mr-4">Seguimiento Trámite</span>

	@endsection


	@section('content')

		@include('backend.encabezado')

		<div class="card card-custom">
			<div class="card-header">
				<div class="card-title">
					<span class="card-icon">
						<i class="flaticon2-chat-1 text-primary"></i>
					</span>
					<h3 class="card-label">
						Seguimiento del tramite {!! $folio !!}
					</h3>
				</div>
			</div>
			<div class="card-body">
				
					@if ( !empty($datosTramite) )
						@if ( strlen($datosTramite->folio) > 6 ) 
							<!-- Begin: Contenido detalle -->
							<ul class="nav nav-tabs nav-tabs-line">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#tab1over">Datos generales</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tab2rev">Expecialidades técnicas empresa</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tab3rev">Expecialidades técnicas RTEC</a>
								</li>
							</ul>
							<div class="tab-content mt-5" id="myTabContent">
								<div class="tab-content mt-5" id="myTabContent">
									<div class="tab-pane fade show active" role="tabpanel" id="tab1over">
										<?php
											$vflTramiteCapitalContable=[];
											$vflTramiteCapitalContable=\App\Http\Models\Backend\T_Tramite_Estado_Financiero::general([
												'id_tramite'=>$datosTramite->id
											])->first();

											$vactual='';
											// $formateador = new NumberFormatter( 'en_IT', NumberFormatter::CURRENCY );
											if ( !empty($vflTramiteCapitalContable) ) {
												$vcapitalContable=json_decode($vflTramiteCapitalContable->capital_neto);
												$vactual='$ '.$vcapitalContable->actual;														

												// $vactual=$formateador->formatCurrency($vcapitalContable->actual, "USD");
												// $vanterior=$formateador->formatCurrency($vcapitalContable->anterior, "USD");
											}


											//ARB
											$CapitalContable_upd=\App\Http\Models\Backend\T_Tramite_Capital_Contable::general([
												'id_tramite'=>$datosTramite->id
											])->first();

											$vcp='';
											if ( isset($CapitalContable_upd->capital) ) {
												$vcp='$ '.$CapitalContable_upd->capital;
											}
										?>


<div class="row">										
	<div class="col-md-6">
		<div class="flex-grow-1 card-spacer-x">
			<div class="d-flex align-items-center justify-content-between mb-10">
				<div class="d-flex align-items-center mr-2">
					<div class="symbol symbol-50 symbol-light mr-3 flex-shrink-0">
						<div class="symbol-label">
							<i class="icon-xl fas fa-gavel"></i>
						</div>
					</div>
					<div>
						<a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">
							Estatus área legal
						</a>
						<div class="font-size-sm text-muted font-weight-bold mt-1">
							<span class="badge badge-{!! $datosTramite->status_legal_color !!}" style="display: inline; color: #fff;">
								{!! $datosTramite->status_legal !!}
							</span> 
						</div>
					</div>
				</div>
			</div>
			@if ( $datosTramite->id_sujeto_tramite != 2 )
			<div class="d-flex align-items-center justify-content-between mb-10">
				<div class="d-flex align-items-center mr-2">
					<div class="symbol symbol-50 symbol-light mr-3 flex-shrink-0">
						<div class="symbol-label">
							<i class="icon-xl fas fa-dollar-sign"></i>
						</div>
					</div>
					<div>
						<a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">
							Estatus área financiera
						</a>
						<div class="font-size-sm text-muted font-weight-bold mt-1">
							<span class="badge badge-{!! $datosTramite->status_financiera_color !!}" style="display: inline; color: #fff;">
								{!! $datosTramite->status_financiera !!}
							</span>
						</div>
					</div>
				</div>
			</div>
			@endif
			<div class="d-flex align-items-center justify-content-between">
				<div class="d-flex align-items-center mr-2">
					<div class="symbol symbol-50 symbol-light mr-3 flex-shrink-0">
						<div class="symbol-label">
							<i class="icon-xl fas fa-hard-hat"></i>
						</div>
					</div>
					<div>
						<a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">
							Estatus área técnica
						</a>
						<div class="font-size-sm text-muted font-weight-bold mt-1">
							<span class="badge badge-{!! $datosTramite->status_tecnica_color !!}" style="display: inline; color: #fff;">
								{!! $datosTramite->status_tecnica !!}
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="flex-grow-1 card-spacer-x">
			<div class="d-flex align-items-center justify-content-between mb-10">
				<div class="d-flex align-items-center mr-2">
					<div class="symbol symbol-50 symbol-light mr-3 flex-shrink-0">
						<div class="symbol-label">
							<i class="icon-xl fas fa-chart-line"></i>
						</div>
					</div>
					<div>
						<a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">
							Estatus general del trámite
						</a>
						<div class="font-size-sm text-muted font-weight-bold mt-1">
							<span class="badge badge-{!! $datosTramite->status_legal_color !!}" style="display: inline; color: #fff;">
								{!! $folio !!}
							</span> 
						</div>
					</div>
				</div>
			</div>
			<div class="d-flex align-items-center justify-content-between mb-10">
				<div class="d-flex align-items-center mr-2">
					<div class="symbol symbol-50 symbol-light mr-3 flex-shrink-0">
						<div class="symbol-label">
							<i class="icon-xl fas fa-calendar"></i>
						</div>
					</div>
					<div>
						<a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">
							Fecha de inicio del tramite
						</a>
						<div class="font-size-sm text-muted font-weight-bold mt-1">
							<span class="badge badge-{!! $datosTramite->status_financiera_color !!}" style="display: inline; color: #fff;">
								{!! $datosTramite->fecha_inicio !!}
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="d-flex align-items-center justify-content-between">
				<div class="d-flex align-items-center mr-2">
					<div class="symbol symbol-50 symbol-light mr-3 flex-shrink-0">
						<div class="symbol-label">
							<i class="icon-xl fas fa-coins"></i>
						</div>
					</div>
					<div>
						<a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">
							Capital contable
						</a>
						<div class="font-size-sm text-muted font-weight-bold mt-1">
							<span class="badge badge-{!! $datosTramite->status_tecnica_color !!}" style="display: inline; color: #fff;">
								div>ACTUAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {!! $vcp !!}</div>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>









									</div>
									<hr />
									<div class="tab-pane fade" role="tabpanel" id="tab2rev">
										<?php
											$vtextoEspecialidades='Sin especialidades.';
											$vcapitalContable=json_decode($datosTramite->especialidades_tecnicas);
											if ( !empty($vcapitalContable) ) {
												$vtextoEspecialidades='';
												foreach ($vcapitalContable as $key => $value) {
													// code...
													$vflEspecialidades=\App\Http\Models\Catalogos\C_Especialidad::findOrFail($value);
													$vtextoEspecialidades.=$vflEspecialidades->clave .'.-'. $vflEspecialidades->nombre . '<br />';
													unset($vflEspecialidades);
												}
											}
										?>
										<h5>Especialidades técnicas acreditadas propias</h5>
										<p> {!! $vtextoEspecialidades !!} </p>
									</div>
									<div class="tab-pane fade" role="tabpanel" id="tab3rev">
										<?php
											$vtextoEspecialidadesRTEC ='Sin especialidades.';
											$vflRTEC=\App\Http\Models\Backend\T_Tramite_Rep_Tecnico::general(['id_tramite'=> $datosTramite->id])->first();
											if ( !empty($vflRTEC)) {
												$vtextoEspecialidadesRTEC ='';
												$vespecialidadesRTEC=json_decode($vflRTEC->especialidades);
												foreach ($vespecialidadesRTEC as $key => $value) {
													// code...
													$vflEspecialidades=\App\Http\Models\Catalogos\C_Especialidad::findOrFail($value);
													$vtextoEspecialidadesRTEC.=$vflEspecialidades->clave .'.-'. $vflEspecialidades->nombre . '<br />';
													unset($vflEspecialidades);
												}
											}
											unset($vflRTEC, $vespecialidadesRTEC);
										?>
										<h5>Especialidades técnicas del representante técnico (RTEC)</h5>
										<p> {!! $vtextoEspecialidadesRTEC !!} </p>
									</div>
								</div>
							</div>
							
							@if ( !empty($observaciones['obsLegal']) || !empty($observaciones['obsFinanciera']) || !empty($observaciones['obsTecnica']))
							<div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
								@if ( !empty($observaciones['obsLegal']) && $datosTramite->id_status_area_legal >= 4 )
								<div class="card">
									<div class="card-header" id="headingOne6">
										<div class="card-title" data-toggle="collapse" data-target="#collapseOne6">
											<i class="flaticon2-notification"></i>
											Observaciones área legal <span class="badge badge-{!! $datosTramite->status_legal_color !!}">{!! $datosTramite->status_legal !!}</span>
										</div>
									</div>
									<div id="collapseOne6" class="collapse show" data-parent="#accordionExample6">
										<div class="card-body">
											<ul class="list-group list-group-flush">
											@foreach($observaciones['obsLegal'] as $dato)
												<li class="list-group-item">															
													<h5 class="card-title mb-1">
														{!! $dato['documento_padre'] !!}
														@if ( $dato['id_status'] != 9 )
														<span class="badge badge-{!! $dato['status_color'] !!}">{!! $dato['status'] !!}</span>
														@endif
													</h5>
													<h6 class="card-title mb-1">{!! $dato['documento'] !!}</h6>
													<p class="mb-0" style="text-align: justify;">{!! $dato['observacion'] !!}</p>
												</li>
											@endforeach
											</ul>
										</div>
									</div>
								</div>
								@endif
								@if ( !empty($observaciones['obsFinanciera']) && $datosTramite->id_status_area_financiera >= 4 )
								<div class="card">
									<div class="card-header" id="headingTwo6">
										<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo6">
											<i class="flaticon2-notification"></i>
											Observaciones área financiera <span class="badge badge-{!! $datosTramite->status_financiera_color !!}">{!! $datosTramite->status_financiera !!}</span>
										</div>
									</div>
									<div id="collapseTwo6" class="collapse" data-parent="#accordionExample6">
										<div class="card-body">
											<?php
												$vflTramiteCapitalContable=\App\Http\Models\Backend\T_Tramite_Estado_Financiero::general([
													'id_tramite'=>$datosTramite->id
												])->first();

												if ( !empty($vflTramiteCapitalContable) )
													$vcapitalContable=json_decode($vflTramiteCapitalContable->capital_neto);
											?>

											<ul class="list-group list-group-flush">
											<?php
											/*
											@if ( !empty($vflTramiteCapitalContable) && $datosTramite->id_status_area_financiera == 7 )
												<li class="list-group-item">
													<h5 class="card-title mb-1">Capital contable</h5>
													<h6 class="card-title mb-1">
														ACTUAL &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-success">{!! $vcapitalContable->actual !!}</span>
													</h6>
													<h6 class="card-title mb-1">
														ANTERIOR <span class="badge badge-warning">{!! $vcapitalContable->anterior !!}</span>
													</h6>
												</li>
											@endif
											*/
											?>
											@foreach ( $observaciones['obsFinanciera'] as $dato )
												<li class="list-group-item">
													<h5 class="card-title mb-1">
														{!! $dato['documento_padre'] !!}
														@if ( $dato['id_status'] != 9 )
														<span class="badge badge-{!! $dato['status_color'] !!}">{!! $dato['status'] !!}</span>
														@endif
													</h5>
													<h6 class="card-title mb-1">{!! $dato['documento'] !!}</h6>
													<p class="mb-0" style="text-align: justify;">{!! $dato['observacion'] !!}</p>
												</li>
											@endforeach
											</ul>
										</div>
									</div>
								</div>
								@endif
								@if ( !empty($observaciones['obsTecnica']) && $datosTramite->id_status_area_tecnica >= 4 )
								<div class="card">
									<div class="card-header" id="headingThree6">
										<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree6">
											<i class="flaticon2-notification"></i>
											Observaciones área técnica <span class="badge badge-{!! $datosTramite->status_tecnica_color !!}">{!! $datosTramite->status_tecnica !!}</span>
										</div>
									</div>
									<div id="collapseThree6" class="collapse" data-parent="#accordionExample6">
										<div class="card-body">
											<ul class="list-group list-group-flush">
											@foreach($observaciones['obsTecnica'] as $dato)
												<li class="list-group-item">
													<h5 class="card-title mb-1">
														{!! $dato['documento_padre'] !!}
														@if ( $dato['id_status'] != 9 )
														<span class="badge badge-{!! $dato['status_color'] !!}">{!! $dato['status'] !!}</span>
														@endif
													</h5>
													<h6 class="card-title mb-1">{!! $dato['documento'] !!}</h6>
													<p class="mb-0" style="text-align: justify;">{!! $dato['observacion'] !!}</p>
												</li>
											@endforeach
											</ul>
										</div>
									</div>
								</div>
								@endif
							</div>
							@endif

						<!-- End: Contenido detalle -->
						@endif
					@endif

			</div>
		</div>
		
	@endsection

	@section('script')

	$('._avance_tramite').addClass('menu-item-active');

	@endsection