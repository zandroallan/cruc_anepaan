

	<?php $__env->startSection('title'); ?>
		<h2 class="main-content-title tx-24 mg-b-5">Seguimiento Trámite</h2>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('breadcrumb'); ?>

		<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?php echo html_entity_decode(link_to_route('mis-tramites.index', $title, null, [])); ?></h5>	
		<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
		<span class="text-muted font-weight-bold mr-4">Seguimiento Trámite</span>

	<?php $__env->stopSection(); ?>


	<?php $__env->startSection('content'); ?>

		<?php echo $__env->make('backend.encabezado', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<div class="card card-custom">
			<div class="card-header">
				<div class="card-title">
					<span class="card-icon">
						<i class="flaticon2-chat-1 fa-2x text-primary"></i>
					</span>
					<h3>
						Seguimiento del tramite <?php echo $folio; ?>

					</h3>
				</div>
			</div>
			<div class="card-body">
					<?php if( !empty($datosTramite) ): ?>
						<?php if( strlen($datosTramite->folio) > 6 ): ?> 
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
														<h6><span class="label label-dot label-dark"></span> Fecha de inicio del tramite: <?php echo $datosTramite->fecha_inicio; ?></h6>
														
														<h6><span class="label label-dot label-dark"></span>
														Capital contable: <?php echo e($vcp); ?></h6>
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
																<span class="label label-lg font-weight-bold label-light-<?php echo $datosTramite->status_legal_color; ?> label-inline">
																	<span class="label label-<?php echo $datosTramite->status_legal_color; ?> label-dot mr-2"></span><b><?php echo $datosTramite->status_legal; ?></b>
																</span>
															</span>
														</div>
													</div>
													<!--end: Item-->
													
													<!--begin: Item-->
													<?php if( $datosTramite->id_sujeto_tramite != 2 ): ?>
													<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
														<span class="mr-4">
															<i class="flaticon-coins icon-3x text-muted font-weight-bold"></i>
														</span>
														<div class="d-flex flex-column text-dark-75">
															<span class="font-weight-bolder font-size-h6">Area Financiera</span>
															<span class="font-weight-bolder font-size-h5">
																<span class="label label-lg font-weight-bold label-light-<?php echo $datosTramite->status_financiera_color; ?> label-inline">
																	<span class="label label-<?php echo $datosTramite->status_financiera_color; ?> label-dot mr-2"></span><b><?php echo $datosTramite->status_financiera; ?></b>
																</span>
															</span>
														</div>
													</div>
													<?php endif; ?>
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
																	<span class="label label-lg font-weight-bold label-light-<?php echo $datosTramite->status_tecnica_color; ?> label-inline">
																		<span class="label label-<?php echo $datosTramite->status_tecnica_color; ?> label-dot mr-2"></span><b><?php echo $datosTramite->status_tecnica; ?></b>
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
																	<b><?php echo $spanfolio; ?></b>
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

												<?php if( !empty($observaciones['obsLegal']) || !empty($observaciones['obsFinanciera']) || !empty($observaciones['obsTecnica'])): ?>
												<div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
													<?php if( !empty($observaciones['obsLegal']) && $datosTramite->id_status_area_legal >= 4 ): ?>
													<div class="card">
														<div class="card-header" id="headingOne6">
															<div class="card-title" data-toggle="collapse" data-target="#collapseOne6">
																<i class="flaticon-globe icon-3x text-muted font-weight-bold"></i>
																Observaciones área legal
															</div>
														</div>
														<div id="collapseOne6" class="collapse show" data-parent="#accordionExample6">
															<div class="card-body">
																<div class="column">
																	<?php $contadorLeg = 0; ?>
																	<?php $__currentLoopData = $observaciones['obsLegal']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																	<?php $contadorLeg++; ?>
															        <div class="belief top">
															          <h3 style="padding-left: 5px; width: 25px;"><?php echo e($contadorLeg); ?></h3>
															          <h4>
															          		<?php echo $dato['documento_padre']; ?> -
															          		<?php if( $dato['id_status'] != 9 ): ?>
															          		<span class="label label-outline-<?php echo $dato['status_color']; ?> label-inline mr-2">
															          			<span class="label label-<?php echo $dato['status_color']; ?> label-dot mr-2"></span>
															          			<b><?php echo $dato['status']; ?></b>
															          		</span>
																			<?php endif; ?>
															          </h4>
															          <h5><?php echo $dato['documento']; ?></h5>
															          <p class="mb-0" style="text-align: justify;"><?php echo $dato['observacion']; ?></p>
															        </div>
															        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															    </div>
															</div>
														</div>
													</div>
													<?php endif; ?>
													<?php if( !empty($observaciones['obsFinanciera']) && $datosTramite->id_status_area_financiera >= 4 ): ?>
													<div class="card">
														<div class="card-header" id="headingTwo6">
															<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo6">
																<i class="flaticon-coins icon-3x text-muted font-weight-bold"></i>
																Observaciones área financiera
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

																<div class="column">
																	<?php $contadorFin = 0; ?>
																	<?php $__currentLoopData = $observaciones['obsFinanciera']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																	<?php $contadorFin++; ?>
															        <div class="belief top">
															          <h3 style="padding-left: 5px; width: 25px;"><?php echo e($contadorFin); ?></h3>
															          <h4>
															          		<?php echo $dato['documento_padre']; ?> -
															          		<?php if( $dato['id_status'] != 9 ): ?>
															          		<span class="label label-outline-<?php echo $dato['status_color']; ?> label-inline mr-2">
															          			<span class="label label-<?php echo $dato['status_color']; ?> label-dot mr-2"></span>
															          			<b><?php echo $dato['status']; ?></b>
															          		</span>
																			<?php endif; ?>
															          </h4>
															          <h5><?php echo $dato['documento']; ?></h5>
															          <p class="mb-0" style="text-align: justify;"><?php echo $dato['observacion']; ?></p>
															        </div>
															        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															    </div>
															</div>
														</div>
													</div>
													<?php endif; ?>
													<?php if( !empty($observaciones['obsTecnica']) && $datosTramite->id_status_area_tecnica >= 4 ): ?>
													<div class="card">
														<div class="card-header" id="headingThree6">
															<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree6">
																<i class="flaticon2-delivery-truck icon-3x text-muted font-weight-bold"></i>
																Observaciones área técnica
															</div>
														</div>
														<div id="collapseThree6" class="collapse" data-parent="#accordionExample6">
															<div class="card-body">
																<div class="column">
																	<?php $contadorTec = 0; ?>
																	<?php $__currentLoopData = $observaciones['obsTecnica']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																	<?php $contadorTec++; ?>
															        <div class="belief top">
															          <h3 style="padding-left: 5px; width: 25px;"><?php echo e($contadorTec); ?></h3>
															          <h4>
															          		<?php echo $dato['documento_padre']; ?> -
															          		<?php if( $dato['id_status'] != 9 ): ?>
															          		<span class="label label-outline-<?php echo $dato['status_color']; ?> label-inline mr-2">
															          			<span class="label label-<?php echo $dato['status_color']; ?> label-dot mr-2"></span>
															          			<b><?php echo $dato['status']; ?></b>
															          		</span>
																			<?php endif; ?>
															          </h4>
															          <h5><?php echo $dato['documento']; ?></h5>
															          <p class="mb-0" style="text-align: justify;"><?php echo $dato['observacion']; ?></p>
															        </div>
															        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															    </div>
															</div>
														</div>
													</div>
													<?php endif; ?>
												</div>
												<?php endif; ?>
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

												<?php if( !empty($vcapitalContable)): ?>
												<ol class="lstEspc">
													<?php $__currentLoopData = $vcapitalContable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php $vflEspecialidades=\App\Http\Models\Catalogos\C_Especialidad::findOrFail($value); ?>
													  	<li>												    
													    	<p><strong class="ml-12 mr-5"><?php echo e($vflEspecialidades->clave); ?></strong><?php echo e($vflEspecialidades->nombre); ?></p>
													  	</li>
													  	<?php unset($vflEspecialidades); ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</ol>
												<?php endif; ?>
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

												<?php if( !empty($vflRTEC)): ?>
												<ol class="lstEspc">
													<?php $vespecialidadesRTEC=json_decode($vflRTEC->especialidades); ?>
													<?php $__currentLoopData = $vespecialidadesRTEC; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php $vflEspecialidades=\App\Http\Models\Catalogos\C_Especialidad::findOrFail($value); ?>
													  	<li>												    
													    	<p><strong class="ml-12 mr-5"><?php echo e($vflEspecialidades->clave); ?></strong><?php echo e($vflEspecialidades->nombre); ?></p>
													  	</li>
													  	<?php unset($vflEspecialidades); ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</ol>
												<?php endif; ?>
												<?php unset($vflRTEC, $vespecialidadesRTEC); ?>
											</div>
										</div>
									</div>
								</div>
							</div>	
						<!-- End: Contenido detalle -->
						<?php endif; ?>
					<?php endif; ?>

			</div>
		</div>
		
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('script'); ?>

	$('._avance_tramite').addClass('menu-item-active');

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\apps\sircse\resources\views/backend/mis-tramites-seguimiento/index.blade.php ENDPATH**/ ?>