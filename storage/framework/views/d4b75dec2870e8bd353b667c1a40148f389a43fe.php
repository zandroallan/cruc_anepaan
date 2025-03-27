

	<?php $__env->startSection('styles'); ?>

		<!-- <link href="<?php echo e(asset('dashlead/plugins/datatable/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet"/>
		<link href="<?php echo e(asset('dashlead/plugins/datatable/responsivebootstrap4.min.css')); ?>" rel="stylesheet"/>
		<link href="<?php echo e(asset('dashlead/plugins/datatable/fileexport/buttons.bootstrap4.min.css')); ?>" rel="stylesheet"/> -->

	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('buttons'); ?>

		<a href="<?php echo e(route($current_route.'.index')); ?>" class="btn ripple btn-outline-primary">
			Regresar
		</a>

	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('title'); ?>

		<h2 class="main-content-title tx-24 mg-b-5">Mi documentación enviada</h2>

	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('breadcrumb'); ?>

	    <li class="breadcrumb-item"><?php echo html_entity_decode(link_to_route($current_route.'.index', $title, null, [])); ?></li>
	    <li class="breadcrumb-item active">Mi documentación enviada</li>

	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('content'); ?>

		<?php echo $__env->make('backend.encabezado', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('js'); ?>

	    <script src="<?php echo e(asset('js/backend/mis-documentos.js')); ?>"></script>

	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('script'); ?>

		cargar_documentacion_lega(<?php echo e($id_tipo_tramite); ?>, <?php echo e($id_tramite); ?>);
		cargar_documentacion_financiera(<?php echo e($id_tipo_tramite); ?>, <?php echo e($id_tramite); ?>, <?php echo e($datos->obligado_dec_isr); ?>);
		cargar_documentacion_tecnica(<?php echo e($id_tipo_tramite); ?>, <?php echo e($id_tramite); ?>, <?php echo e($datos->tec_acredita_tmp); ?>);

		cargar_solventaciones(<?php echo e($id_tramite); ?>);

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/cores/c-sircse/resources/views/backend/mis-tramites/mis-documentos.blade.php ENDPATH**/ ?>