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
						<i class="flaticon2-chat-1 fa-2x text-primary"></i>
					</span>
					<h3>
						Seguimiento del trámite {!! $folio !!}
					</h3>
				</div>
			</div>
			<div class="card-body">
					@if ( !empty($datosTramite) )
						@if ( strlen($datosTramite->folio) > 6 ) 
							<!-- Begin: Contenido detalle -->
							<ul class="nav nav-tabs nav-tabs-line">
								<li class="nav-item">
									<a class="nav-link active font-size-h6" data-toggle="tab" href="#tab1over">Datos generales</a>
								</li>
								<li class="nav-item">
									<a class="nav-link font-size-h6" data-toggle="tab" href="#tab2rev">Expecialidades técnicas de la empresa</a>
								</li>
								<li class="nav-item">
									<a class="nav-link font-size-h6" data-toggle="tab" href="#tab3rev">Expecialidades técnicas RTEC</a>
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
								
										<div class="card">
											<div class="card-body">

												<div class="alert alert-custom alert-light-dark fade show mb-10" role="alert">
													<div class="alert-icon">
														<i class="flaticon-clock-2 icon-3x text-muted font-weight-bold"></i>
													</div>
													<div class="alert-text font-weight-bold">
														<h6><span class="label label-dot label-dark"></span> Fecha de inicio del tramite: {!! $datosTramite->fecha_inicio !!}</h6>
														
														<h6><span class="label label-dot label-dark"></span>
														Capital contable: {{ $vcp }}</h6>
													</div>
												</div>

												<h3 class="card-title align-items-start flex-column mt-10">
													<span class="card-label font-weight-bolder text-dark">Status del tr&aacute;mite</span>
												</h3>

												<div class="d-flex align-items-center flex-wrap mb-3">
													<!--begin: Item-->
													<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
														<span class="mr-4">
															<i class="flaticon-globe icon-3x text-muted font-weight-bold"></i>
														</span>
														<div class="d-flex flex-column text-dark-75">
															<span class="font-weight-bolder font-size-h6">Area Legal</span>
															<span class="font-weight-bolder font-size-h5">
																<span class="label label-lg font-weight-bold label-light-{!! $datosTramite->status_legal_color !!} label-inline">
																	<span class="label label-{!! $datosTramite->status_legal_color !!} label-dot mr-2"></span><b>{!! $datosTramite->status_legal !!}</b>
																</span>
															</span>
														</div>
													</div>
													<!--end: Item-->
													
													<!--begin: Item-->
													@if ( $datosTramite->id_sujeto_tramite != 2 )
													<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
														<span class="mr-4">
															<i class="flaticon-coins icon-3x text-muted font-weight-bold"></i>
														</span>
														<div class="d-flex flex-column text-dark-75">
															<span class="font-weight-bolder font-size-h6">Area Financiera</span>
															<span class="font-weight-bolder font-size-h5">
																<span class="label label-lg font-weight-bold label-light-{!! $datosTramite->status_financiera_color !!} label-inline">
																	<span class="label label-{!! $datosTramite->status_financiera_color !!} label-dot mr-2"></span><b>{!! $datosTramite->status_financiera !!}</b>
																</span>
															</span>
														</div>
													</div>
													@endif
													<!--end: Item-->

													<!--begin: Item-->
													<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
														<span class="mr-4">
															<i class="flaticon2-delivery-truck icon-3x text-muted font-weight-bold"></i>
														</span>
														<div class="d-flex flex-column text-dark-75">
															<span class="font-weight-bolder font-size-h6">Area T&eacute;cnica</span>
															<span class="font-weight-bolder font-size-h5">
																<span class="text-dark-50 font-weight-bold">
																	<span class="label label-lg font-weight-bold label-light-{!! $datosTramite->status_tecnica_color !!} label-inline">
																		<span class="label label-{!! $datosTramite->status_tecnica_color !!} label-dot mr-2"></span><b>{!! $datosTramite->status_tecnica !!}</b>
																	</span>
																</span>
															</span>
														</div>
													</div>
													<!--end: Item-->

													<!--begin: Item-->
													<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
														<span class="mr-4">
															<i class="flaticon2-list icon-3x text-muted font-weight-bold"></i>
														</span>
														<div class="d-flex flex-column text-dark-75">
															<span class="font-weight-bolder font-size-h6">General</span>
															<span class="font-weight-bolder font-size-h5">
																<span class="text-dark-50 font-weight-bold">														
																	<b>{!! $spanfolio !!}</b>
																</span>
															</span>
														</div>
													</div>
													<!--end: Item-->											
												</div>

												<!-- observaciones -->
												<h3 class="card-title align-items-start flex-column mt-10">
													<span class="card-label font-weight-bolder text-dark">Desglose de las observaciones por &aacute;rea</span>
												</h3>

												@if ( !empty($observaciones['obsLegal']) || !empty($observaciones['obsFinanciera']) || !empty($observaciones['obsTecnica']))
												<div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
													@if ( !empty($observaciones['obsLegal']) && $datosTramite->id_status_area_legal >= 4 )
													<div class="card">
														<div class="card-header" id="headingOne6">
															<div class="card-title" data-toggle="collapse" data-target="#collapseOne6">
																<i class="flaticon-globe icon-3x text-muted font-weight-bold"></i>
																Observaciones área legal
															</div>
														</div>
														<div id="collapseOne6" class="collapse show" data-parent="#accordionExample6">
															<div class="column">	
																<div class="card-body">																
																	<?php $contadorLeg = 0; ?>
																	@foreach ( $observaciones['obsLegal'] as $dato )
																	<?php $contadorLeg++; ?>
															        <div class="belief top">
															          <h3 style="padding-left: 5px; width: 25px;">{{$contadorLeg}}</h3>
															          <h4>
																	  		@if ( $dato['id_status'] != 9 )
																			<span class="label label-outline-{!! $dato['status_color'] !!} label-inline mr-2">
																				<span class="label label-{!! $dato['status_color'] !!} label-dot mr-2"></span>
																				<b>{!! $dato['status'] !!}</b>
																			</span>
																			@endif

																			@if(isset($dato['documento_padre']))
																				<br>
															          			{!! $dato['documento_padre'] !!} 
																			@endif																			
															          </h4>
															          <h5>{!! $dato['documento'] !!}</h5>
															          <p class="mb-0" style="text-align: justify; font-style: italic;"><b>Observacion:</b> {!! $dato['observacion'] !!}</p>
															        </div>
															        @endforeach
															    </div>
															</div>
														</div>
													</div>
													@endif
													@if ( !empty($observaciones['obsFinanciera']) && $datosTramite->id_status_area_financiera >= 4 )
													<div class="card">
														<div class="card-header" id="headingTwo6">
															<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo6">
																<i class="flaticon-coins icon-3x text-muted font-weight-bold"></i>
																Observaciones área financiera
															</div>
														</div>
														<div id="collapseTwo6" class="collapse" data-parent="#accordionExample6">
															<div class="column">
																<?php
																	$vflTramiteCapitalContable=\App\Http\Models\Backend\T_Tramite_Estado_Financiero::general([
																		'id_tramite'=>$datosTramite->id
																	])->first();

																	if ( !empty($vflTramiteCapitalContable) )
																		$vcapitalContable=json_decode($vflTramiteCapitalContable->capital_neto);
																?>

																<div class="card-body">
																	<?php $contadorFin = 0; ?>
																	@foreach ( $observaciones['obsFinanciera'] as $dato )
																	<?php $contadorFin++; ?>
															        <div class="belief top">
															          <h3 style="padding-left: 5px; width: 25px;">{{$contadorFin}}</h3>
															          <h4>																	  
															          		@if ( $dato['id_status'] != 9 )
															          		<span class="label label-outline-{!! $dato['status_color'] !!} label-inline mr-2">
															          			<span class="label label-{!! $dato['status_color'] !!} label-dot mr-2"></span>
															          			<b>{!! $dato['status'] !!}</b>
															          		</span>
																			@endif

																			@if(isset($dato['documento_padre']))
																				<br>
																				{!! $dato['documento_padre'] !!} 
																			@endif
															          </h4>
															          <h5>{!! $dato['documento'] !!}</h5>
															          <p class="mb-0" style="text-align: justify; font-style: italic;"><b>Observacion:</b> {!! $dato['observacion'] !!}</p>
															        </div>
															        @endforeach
															    </div>
															</div>
														</div>
													</div>
													@endif
													@if ( !empty($observaciones['obsTecnica']) && $datosTramite->id_status_area_tecnica >= 4 )
													<div class="card">
														<div class="card-header" id="headingThree6">
															<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree6">
																<i class="flaticon2-delivery-truck icon-3x text-muted font-weight-bold"></i>
																Observaciones área técnica
															</div>
														</div>
														<div id="collapseThree6" class="collapse" data-parent="#accordionExample6">
															<div class="column">
																<div class="card-body">
																	<?php $contadorTec = 0; ?>
																	@foreach ( $observaciones['obsTecnica'] as $dato )
																	<?php $contadorTec++; ?>
															        <div class="belief top">
															          <h3 style="padding-left: 5px; width: 25px;">{{$contadorTec}}</h3>
															          <h4>
															          		@if ( $dato['id_status'] != 9 )
															          		<span class="label label-outline-{!! $dato['status_color'] !!} label-inline mr-2">
															          			<span class="label label-{!! $dato['status_color'] !!} label-dot mr-2"></span>
															          			<b>{!! $dato['status'] !!}</b>
															          		</span>
																			@endif
																			
																			@if(isset($dato['documento_padre']))
																				<br>
															          			{!! $dato['documento_padre'] !!} 
																			@endif
															          </h4>
															          <h5>{!! $dato['documento'] !!}</h5>
															          <p class="mb-0" style="text-align: justify; font-style: italic;"><b>Observacion:</b> {!! $dato['observacion'] !!}</p>
															        </div>
															        @endforeach
															    </div>
															</div>
														</div>
													</div>
													@endif
												</div>
												@endif
												<!-- end observaciones -->
											</div>
										</div>
								
									</div>


									<div class="tab-pane fade" role="tabpanel" id="tab2rev">
										<div class="card">
											<div class="card-body">
												<?php
													$vtextoEspecialidades='Sin especialidades.';
													$vcapitalContable=json_decode($datosTramite->especialidades_tecnicas);
												?>
												<h5 class="mb-5">Especialidades técnicas acreditadas por la empresa</h5>

												@if( !empty($vcapitalContable))
												<ol class="lstEspc">
													@foreach ( $vcapitalContable as $key => $value )
														<?php $vflEspecialidades=\App\Http\Models\Catalogos\C_Especialidad::findOrFail($value); ?>
													  	<li>												    
													    	<p><strong class="ml-12 mr-5">{{ $vflEspecialidades->clave}}</strong>{{ $vflEspecialidades->nombre }}</p>
													  	</li>
													  	<?php unset($vflEspecialidades); ?>
													@endforeach
												</ol>
												@endif
											</div>
										</div>
									</div>
									<div class="tab-pane fade" role="tabpanel" id="tab3rev">
										<div class="card">
											<div class="card-body">
												<h5 class="mb-5">Especialidades técnicas acreditadas por el representante técnico (RTEC)</h5>
												<?php
													$vtextoEspecialidadesRTEC ='Sin especialidades.';
													$vflRTEC=\App\Http\Models\Backend\T_Tramite_Rep_Tecnico::general(['id_tramite'=> $datosTramite->id])->first();
												?>

												@if( !empty($vflRTEC))
												<ol class="lstEspc">
													<?php $vespecialidadesRTEC=json_decode($vflRTEC->especialidades); ?>
													@foreach ( $vespecialidadesRTEC as $key => $value )
														<?php $vflEspecialidades=\App\Http\Models\Catalogos\C_Especialidad::findOrFail($value); ?>
													  	<li>												    
													    	<p><strong class="ml-12 mr-5">{{ $vflEspecialidades->clave}}</strong>{{ $vflEspecialidades->nombre }}</p>
													  	</li>
													  	<?php unset($vflEspecialidades); ?>
													@endforeach
												</ol>
												@endif
												<?php unset($vflRTEC, $vespecialidadesRTEC); ?>
											</div>
										</div>
									</div>
								</div>
							</div>	
						<!-- End: Contenido detalle -->
						@endif
					@endif

			</div>
		</div>
		
	@endsection

	@section('script')

	$('._avance_tramite').addClass('menu-item-active');

	@endsection