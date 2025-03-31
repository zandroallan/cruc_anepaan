

	<?php $__env->startSection('styles'); ?>

		<link href="<?php echo e(asset('public/dashlead/plugins/datatable/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet"/>
		<link href="<?php echo e(asset('public/dashlead/plugins/datatable/responsivebootstrap4.min.css')); ?>" rel="stylesheet"/>
		<link href="<?php echo e(asset('public/dashlead/plugins/datatable/fileexport/buttons.bootstrap4.min.css')); ?>" rel="stylesheet"/>

	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('js'); ?>

		<script src="<?php echo e(asset('public/dashlead/plugins/datatable/jquery.dataTables.min.js')); ?>"></script>
	    <script src="<?php echo e(asset('public/dashlead/plugins/datatable/dataTables.bootstrap4.min.js')); ?>"></script>
	    <script src="<?php echo e(asset('public/dashlead/plugins/datatable/dataTables.responsive.min.js')); ?>"></script>
	    <script src="<?php echo e(asset('public/js/backend/general.js')); ?>"></script>
	    <script src="<?php echo e(asset('public/js/backend/mis-observaciones.js')); ?>"></script>

	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('buttons'); ?>	
		<?php if($status_t==5): ?>
			<a href="<?php echo e(Route('tramites.acuse-observacion-solventado', [$datos->id_ultimo_tramite, 'D'])); ?>" class="btn ripple btn-outline-dark" target="_blank">
					<i class="fa fa-file-pdf t-plus-1 text-danger fa-fw fa-lg"></i> Acuse de observaciones solventadas
			</a>
		<?php endif; ?>

		<?php if( ($id_c_tramites_seguimiento != 0) && ($id_c_tramites_seguimiento == 2)	): ?>
			<a href="<?php echo e(Route('impresion.tramite.observaciones', $datos->id_ultimo_tramite)); ?>" class="btn ripple btn-outline-dark">
				<i class="fa fa-file-pdf t-plus-1 text-danger fa-fw fa-lg"></i> Observaciones
			</a>
		<?php endif; ?>

		<?php if( $en_tiempo!=1 && $datos->id_ultimo_tramite != 0): ?>
			<?php if($si_o_no==1 ): ?>                                                
		 		<?php if($yano==0 ): ?>
					<?php if($en_tiempo!=1): ?>
						<?php echo html_entity_decode(link_to_route('tramites.enviar-solventacion-observacion','<i class="fa fa-paper-plane"></i> Enviar solventacion de observaciones', [$datos->id_ultimo_tramite],['class'=>'btn ripple btn-outline-warning', 'aria-expanded'=>'false'])); ?>           
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('title'); ?>
		<h2 class="main-content-title tx-24 mg-b-5">Mis Observaciones</h2>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('breadcrumb'); ?>

		<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?php echo html_entity_decode(link_to_route($current_route.'.index', $title, null, [])); ?></h5>	
		<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
		<span class="text-muted font-weight-bold mr-4">Observaciones</span>

	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('script'); ?>
		

		console.log('Ultimo tramite'+ <?php echo e($datos->id_ultimo_tramite); ?>);
		$('._observaciones').addClass('menu-item-active');
		cargar_mis_observaciones(<?php echo e($datos->id_ultimo_tramite); ?>);	

		var avisoEnvioSolventacion ="Los Archivos han sido cargados, a continuación proceda a enviar las solventaciones,";
			avisoEnvioSolventacion+="para la revisión de las áreas de la Coordinacion de Verificación de la Supervisión Externa de la Obra Pública Estatal.";

		<?php if( $en_tiempo!=1 && $datos->id_ultimo_tramite != 0): ?>
			<?php if( $si_o_no==1 ): ?>
				<?php if( $yano==0 ): ?>
					
					swal({
				        title: '¡ Advertencia !',
				        text: avisoEnvioSolventacion,
				        icon: 'warning',
				        buttons: {
				            cancel: {
				                text: 'Cancelar',
				                value: false,
				                visible: true,
				                className: 'btn btn-default',
				                closeModal: true,
				            },
				            confirm: {
				                text: 'Enviar solventacion de observaciones',
				                value: true,
				                visible: true,
				                className: 'btn btn-warning',
				                closeModal: true
				            }
				        }
				    }).then((result) => { 
				        if (result) {             
				            enviar_solventacion( <?php echo e($datos->id_ultimo_tramite); ?> );
				        }
				    });

					
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>

	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('content'); ?>
	<style>
		table.dataTable td {
	  		font-size: 12px;
		}
	</style>

		<?php echo $__env->make('backend.encabezado', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php if($en_tiempo!=1): ?>	
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12">
					<div class="pd-10 bg-gray-400" style="text-align: left;">	
						<p class="text-primary"><b>Notas:</b></p>
						<div class="activity-block">
							<ul class="task-list">
								<?php if($contar_observaciones!=0): ?>
									<?php if($si_o_no==1 ): ?>
										<li>
											<i class="task-icon bg-secondary"></i>
											<h6>Observaciones <?php if($yano==0 ): ?>-  Tiene hasta el dia <?php echo e($fecha_larga); ?> para solventar <?php endif; ?></h6>
										</li>
									<?php else: ?>
										<li>
											<i class="task-icon bg-secondary"></i>
											<h6>Revise periódicamente su correo electrónico proporcionado para avisos y notificaciones del Sistema.<br /> Tiene hasta el dia <?php echo e($fecha_larga); ?> para solventar. Gracias por su atención.</h6>
										</li>
									<?php endif; ?>
								<?php else: ?>
									<li>
										<i class="task-icon bg-secondary"></i>
										<h6>No tiene observaciones</h6>
									</li>
								<?php endif; ?>										
							</ul>
						</div>				
						
					</div>
				</div>
			</div><br/>

			<?php if($yano==1 ): ?>
				<div class="alert alert-dark mb-0" role="alert">
				  	<h4 class="alert-heading"><b>Las solventaciones han sido enviadas.</b></h4>
				  	<p class="text-justify">La Secretaría tendrá por recibida una solicitud y comenzará a correr el plazo de treinta días naturales, para que otorgue o niegue la constancia de inscripción, modificación o actualización en el registro de Contratistas o de Supervisores Externos, cuando el solicitante solvente las observaciones o presente la documentación completa con todos los requisitos.</p>
				  	<hr>
				  	<p class="mb-0 text-justify">Todos los seguimientos al trámite se le notificarán a su cuenta en el Portal del contratista y a este correo electrónico.</p>
				</div>				
			<?php endif; ?>	


		<?php elseif($en_tiempo==0 && $status_t==5): ?>
			<div class="alert alert-dark mb-0" role="alert">
			  	<h4 class="alert-heading"><b>Informaci&oacute;n.</b></h4>
			  	<p class="text-justify">La fecha limite para solventar sus observaciones ha vencido. Por lo anterior el tramite con folio: <b><?php echo $folio_t; ?></b> y fecha limite de solventaci&oacute;n: <b><?php echo $f_limite; ?></b> ha sido <b>cancelado</b>.</p>		  	
			</div>
		<?php endif; ?>

		<div class="row">
			<div class="col-lg-12">
				<div class="card custom-card overflow-hidden">
					<div class="card-body">
						<div>
							<h6 class="card-title mb-1">Observaciones del trámite</h6>
							<p class="text-muted card-sub-title">Listado observaciones realizadas al trámite.</p>
						</div>
						<div class="row">
							<div class="col-lg-6"></div>
							<div class="col-lg-6">
								<div class="search">
							      <input type="text" id="searchBox" class="searchTerm" name="searchBox">
							      <button type="submit" class="searchButton">
							        <i class="fa fa-search"></i>
							     </button>
							    </div>
							</div>
						</div>
							
						<div class="table-responsive">
							<table id="mis-observaciones" class="table table-hover">
								<thead style="background-color: #333333 !important;">
									<tr>
										<th style="color: #fff; padding: 15px 15px;">#</th>
										<th style="color: #fff; padding: 15px 15px;" class="wd-10p">Folio</th>
										<th style="color: #fff; padding: 15px 15px;">Documento observado</th>
										<th style="color: #fff; padding: 15px 15px;">Observación</th>
										<th style="color: #fff; padding: 15px 15px;">Area</th>
										<th style="color: #fff; padding: 15px 15px;">Status</th>
										<th style="color: #fff; padding: 15px 15px;">Solventar</th>
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
						<?php echo Form::open(['route' => ['tramites-adjuntos.eliminar', 0], 'id'=>'frm-destroy-adjunto', 'name'=>'frm-destroy-adjunto','method' => 'DELETE'], ['role' => 'form']); ?>

						<?php echo Form::close(); ?>					
					
		    				<?php echo Form::hidden('id_tramite', null,['id'=>'id_tramite', 'class'=>'form-control gui-input']); ?>

							<div class="form-group row m-b-15">
								<label for="id_documento" class="col-form-label col-md-1">Documento*</label>
								<div class="col-md-5">
									<?php echo Form::select('id_documento', $documentos_requeridos, null, ['id' => 'id_documento', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control']); ?>

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
						<?php echo Form::close(); ?>

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

	<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\www\sircse\resources\views/backend/mis-observaciones/index.blade.php ENDPATH**/ ?>