

	<?php $__env->startSection('title'); ?>
		<h2 class="main-content-title tx-24 mg-b-5">Seguimiento Trámite</h2>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('breadcrumb'); ?>
	    <li class="breadcrumb-item"><?php echo html_entity_decode(link_to_route('mis-tramites.index', $title, null, [])); ?></li>
	    <li class="breadcrumb-item active">Seguimiento Trámite</li>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('content'); ?>

		<?php echo $__env->make('backend.encabezado', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<hr />
		<div class="row">
			<div class="col-lg-12">
				<div class="card custom-card">												
					<div aria-multiselectable="true" class="accordion" id="accordionDetalle" role="tablist">
						<div class="card">
							<div class="card-header" id="headingDetalle" role="tab">
								<a aria-controls="collapseDetalle" style="background-color: #333333; color: #fff;" aria-expanded="true" data-toggle="collapse" href="#collapseDetalle" class="">Seguimiento del tramite <?php echo $folio; ?></a>
							</div>
							<div aria-labelledby="headingDetalle" class="collapse show" data-parent="#accordionDetalle" id="collapseDetalle" role="tabpanel" style="">
								<div class="card-body">
									<?php if( !empty($datosTramite) ): ?>
									<?php if( strlen($datosTramite->folio) > 6 ): ?> 
									<!-- Begin: Contenido detalle -->

									<div class="card custom-card main-content-body-profile">
										<nav class="nav main-nav-line">
											<a class="nav-link active" data-toggle="tab" href="#tab1over">Datos generales</a>
											<a class="nav-link" data-toggle="tab" href="#tab2rev">Expecialidades técnicas empresa</a>
											<a class="nav-link" data-toggle="tab" href="#tab3rev">Expecialidades técnicas RTEC</a>
										</nav>
										<div class="card-body tab-content h-100">
											<div class="tab-pane active" id="tab1over">
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
													<div class="card-body col-lg-6" style="border: none;">
														<div class="main-profile-contact-list main-profile-work-list">
															<div class="media">
																<div class="media-logo bg-light text-dark">
																	<i class="fe fe-disc"></i>
																</div>
																<div class="media-body">
																	<span>Estatus área legal</span>
																	<div>
																		<span class="badge badge-<?php echo $datosTramite->status_legal_color; ?>" style="display: inline; color: #fff;">
																			<?php echo $datosTramite->status_legal; ?>

																		</span> 
																	</div>
																</div>
															</div>
															<?php if( $datosTramite->id_sujeto_tramite != 2 ): ?>
															<div class="media">
																<div class="media-logo bg-light text-dark">
																	<i class="fe fe-disc"></i>
																</div>
																<div class="media-body">
																	<span>Estatus área financiera</span>
																	<div>
																		<span class="badge badge-<?php echo $datosTramite->status_financiera_color; ?>" style="display: inline; color: #fff;">
																			<?php echo $datosTramite->status_financiera; ?>

																		</span>
																	</div>
																</div>
															</div>
															<?php endif; ?>
															<div class="media">
																<div class="media-logo bg-light text-dark">
																	<i class="fe fe-disc"></i>
																</div>
																<div class="media-body">
																	<span>Estatus área técnica</span>
																	<div>
																		<span class="badge badge-<?php echo $datosTramite->status_tecnica_color; ?>" style="display: inline; color: #fff;">
																			<?php echo $datosTramite->status_tecnica; ?>

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
																	<div> <?php echo $folio; ?> </div>
																</div>
															</div>
															<div class="media">
																<div class="media-logo bg-light text-dark">
																	<i class="fe fe-calendar"></i>
																</div>
																<div class="media-body">
																	<span>Fecha de inicio del tramite</span>
																	<div> <?php echo $datosTramite->fecha_inicio; ?> </div>
																</div>
															</div>															
															<!-- <?php if( !empty($vflTramiteCapitalContable) ): ?> -->
															<div class="media">
																<div class="media-logo bg-light text-dark">
																	<i class="fe fe-dollar-sign"></i>
																</div>
																<div class="media-body">
																	<span>Capital contable</span>																	
																	<div>ACTUAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $vcp; ?></div>
																</div>
															</div>
															<!-- <?php endif; ?> -->
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tab2rev">
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
												<p> <?php echo $vtextoEspecialidades; ?> </p>
											</div>
											<div class="tab-pane" id="tab3rev">
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
												<p> <?php echo $vtextoEspecialidadesRTEC; ?> </p>
											</div>
										</div>
									</div>
									

									<?php if( !empty($observaciones['obsLegal']) || !empty($observaciones['obsFinanciera']) || !empty($observaciones['obsTecnica'])): ?>
									<div aria-multiselectable="true" class="accordion" id="accordionObservaciones" role="tablist">
										<?php if( !empty($observaciones['obsLegal']) && $datosTramite->id_status_area_legal >= 4 ): ?>
										<div class="card">
											<div class="card-header" id="headingOne" role="tab">
												<a aria-controls="collapseOne" aria-expanded="false" data-toggle="collapse" href="#collapseOne" class="collapsed">
													Observaciones área legal <span class="badge badge-<?php echo $datosTramite->status_legal_color; ?>"><?php echo $datosTramite->status_legal; ?></span>
												</a>
											</div>
											<div aria-labelledby="headingOne" class="collapse" data-parent="#accordionObservaciones" id="collapseOne" role="tabpanel" style="">
												<div class="card-body">
													<ul class="list-group list-group-flush">
													<?php $__currentLoopData = $observaciones['obsLegal']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<li class="list-group-item">															
															<h5 class="card-title mb-1">
																<?php echo $dato['documento_padre']; ?>

																<?php if( $dato['id_status'] != 9 ): ?>
																<span class="badge badge-<?php echo $dato['status_color']; ?>"><?php echo $dato['status']; ?></span>
																<?php endif; ?>
															</h5>
															<h6 class="card-title mb-1"><?php echo $dato['documento']; ?></h6>
															<p class="mb-0" style="text-align: justify;"><?php echo $dato['observacion']; ?></p>
														</li>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</ul>
												</div>
											</div>
										</div>
										<?php endif; ?>
										<?php if( !empty($observaciones['obsFinanciera']) && $datosTramite->id_status_area_financiera >= 4 ): ?>
										<div class="card">
											<div class="card-header" id="headingTwo" role="tab">
												<a aria-controls="collapseTwo" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapseTwo">
													Observaciones área financiera <span class="badge badge-<?php echo $datosTramite->status_financiera_color; ?>"><?php echo $datosTramite->status_financiera; ?></span>
												</a>
											</div>
											<div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionObservaciones" id="collapseTwo" role="tabpanel" style="">
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
													<?php $__currentLoopData = $observaciones['obsFinanciera']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<li class="list-group-item">
															<h5 class="card-title mb-1">
																<?php echo $dato['documento_padre']; ?>

																<?php if( $dato['id_status'] != 9 ): ?>
																<span class="badge badge-<?php echo $dato['status_color']; ?>"><?php echo $dato['status']; ?></span>
																<?php endif; ?>
															</h5>
															<h6 class="card-title mb-1"><?php echo $dato['documento']; ?></h6>
															<p class="mb-0" style="text-align: justify;"><?php echo $dato['observacion']; ?></p>
														</li>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</ul>
												</div>
											</div>
										</div>
										<?php endif; ?>
										<?php if( !empty($observaciones['obsTecnica']) && $datosTramite->id_status_area_tecnica >= 4 ): ?>
										<div class="card">
											<div class="card-header" id="headingThree" role="tab">
												<a aria-controls="collapseThree" aria-expanded="true" class="" data-toggle="collapse" href="#collapseThree">
													Observaciones área técnica <span class="badge badge-<?php echo $datosTramite->status_tecnica_color; ?>"><?php echo $datosTramite->status_tecnica; ?></span>
												</a>
											</div>
											<div aria-labelledby="headingThree" class="collapse" data-parent="#accordionObservaciones" id="collapseThree" role="tabpanel" style="">
												<div class="card-body">
													<ul class="list-group list-group-flush">
													<?php $__currentLoopData = $observaciones['obsTecnica']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<li class="list-group-item">
															<h5 class="card-title mb-1">
																<?php echo $dato['documento_padre']; ?>

																<?php if( $dato['id_status'] != 9 ): ?>
																<span class="badge badge-<?php echo $dato['status_color']; ?>"><?php echo $dato['status']; ?></span>
																<?php endif; ?>
															</h5>
															<h6 class="card-title mb-1"><?php echo $dato['documento']; ?></h6>
															<p class="mb-0" style="text-align: justify;"><?php echo $dato['observacion']; ?></p>
														</li>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</ul>
												</div>
											</div><!-- collapse -->
										</div>
										<?php endif; ?>			
									</div>
									<?php endif; ?>

									<!-- End: -->
									<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
						</div>								
					</div>					
				</div>
			</div>
		</div>
		
	<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\www\sircse\resources\views/backend/mis-tramites-seguimiento/index.blade.php ENDPATH**/ ?>