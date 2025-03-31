

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
						<i class="flaticon2-chat-1 text-primary"></i>
					</span>
					<h3 class="card-label">
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
							<span class="badge badge-<?php echo $datosTramite->status_legal_color; ?>" style="display: inline; color: #fff;">
								<?php echo $datosTramite->status_legal; ?>

							</span> 
						</div>
					</div>
				</div>
			</div>
			<?php if( $datosTramite->id_sujeto_tramite != 2 ): ?>
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
							<span class="badge badge-<?php echo $datosTramite->status_financiera_color; ?>" style="display: inline; color: #fff;">
								<?php echo $datosTramite->status_financiera; ?>

							</span>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
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
							<span class="badge badge-<?php echo $datosTramite->status_tecnica_color; ?>" style="display: inline; color: #fff;">
								<?php echo $datosTramite->status_tecnica; ?>

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
							<span class="badge badge-<?php echo $datosTramite->status_legal_color; ?>" style="display: inline; color: #fff;">
								<?php echo $folio; ?>

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
							<span class="badge badge-<?php echo $datosTramite->status_financiera_color; ?>" style="display: inline; color: #fff;">
								<?php echo $datosTramite->fecha_inicio; ?>

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
							<span class="badge badge-<?php echo $datosTramite->status_tecnica_color; ?>" style="display: inline; color: #fff;">
								div>ACTUAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $vcp; ?></div>
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
										<p> <?php echo $vtextoEspecialidades; ?> </p>
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
										<p> <?php echo $vtextoEspecialidadesRTEC; ?> </p>
									</div>
								</div>
							</div>
							
							<?php if( !empty($observaciones['obsLegal']) || !empty($observaciones['obsFinanciera']) || !empty($observaciones['obsTecnica'])): ?>
							<div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
								<?php if( !empty($observaciones['obsLegal']) && $datosTramite->id_status_area_legal >= 4 ): ?>
								<div class="card">
									<div class="card-header" id="headingOne6">
										<div class="card-title" data-toggle="collapse" data-target="#collapseOne6">
											<i class="flaticon2-notification"></i>
											Observaciones área legal <span class="badge badge-<?php echo $datosTramite->status_legal_color; ?>"><?php echo $datosTramite->status_legal; ?></span>
										</div>
									</div>
									<div id="collapseOne6" class="collapse show" data-parent="#accordionExample6">
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
									<div class="card-header" id="headingTwo6">
										<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo6">
											<i class="flaticon2-notification"></i>
											Observaciones área financiera <span class="badge badge-<?php echo $datosTramite->status_financiera_color; ?>"><?php echo $datosTramite->status_financiera; ?></span>
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
									<div class="card-header" id="headingThree6">
										<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree6">
											<i class="flaticon2-notification"></i>
											Observaciones área técnica <span class="badge badge-<?php echo $datosTramite->status_tecnica_color; ?>"><?php echo $datosTramite->status_tecnica; ?></span>
										</div>
									</div>
									<div id="collapseThree6" class="collapse" data-parent="#accordionExample6">
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
									</div>
								</div>
								<?php endif; ?>
							</div>
							<?php endif; ?>

						<!-- End: Contenido detalle -->
						<?php endif; ?>
					<?php endif; ?>

			</div>
		</div>
		
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('script'); ?>

	$('._avance_tramite').addClass('menu-item-active');

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\www\sircse\resources\views/backend/mis-tramites-seguimiento/index.blade.php ENDPATH**/ ?>