

	<?php $__env->startSection('styles'); ?>        
	         
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('js'); ?>
			
		<?php echo Html::script('public/js/backend/general.js');; ?>

		<?php echo Html::script('public/js/backend/mis-observaciones.js');; ?>

		<?php echo Html::script('public/js/backend/tramite.observaciones.js');; ?>


	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('title'); ?>

		<h2 class="main-content-title tx-24 mg-b-5">Observacion</h2>

	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('breadcrumb'); ?>

	    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?php echo html_entity_decode(link_to_route($current_route.'.index', $title, null, [])); ?></h5>	
		<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
		<span class="text-muted font-weight-bold mr-4">Observaciones</span>
		
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('script'); ?>
		cargarInputs(<?php echo e($observacion->id_documentacion); ?>);
		cargar_solventaciones( <?php echo e($observacion->id); ?>);
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('content'); ?>

		<?php echo $__env->make('backend.encabezado', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<style>
			table td {
		  		font-size: 12px;
			}
		</style>
		<hr />

		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12">
				<div class="pd-10 bg-gray-400" style="text-align: justify;">
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
						<b><?php echo $vdocumentoPadreHijo; ?></b>
					</p>
					<?php echo e($observacion->observacion); ?>

				</div>
			</div>
		</div>
		<hr/>

		<?php if( $observacion->id_status_tramite == 4): ?>
	    <!-- Cargar documentos  -->
	    <?php echo Form::open(['route' => 'tramites.subir-documento-observacion', 'id'=>'myformdocumento','class'=>'form-horizontal myformdocumento', 'method' => 'post' , 'files' => true, 'enctype'=>'multipart/form-data']); ?>

			<?php echo Form::hidden('id_observacion', $observacion->id,['id'=>'id_observacion']); ?>               
			<?php echo Form::hidden('id_tramite', $observacion->id_tramite,['id'=>'id_tramite']); ?>               
			<?php echo Form::hidden('id_documentacion', $observacion->id_documentacion,['id'=>'id_documentacion']); ?>


			<div class="row">
				<div class="col-xl-12 col-lg-12 col-sm-12">
					<div class="card custom-card" >
						<div class="card-body">
							<input type="hidden" name="inputShowButton" id="inputShowButton" value="0">
							
							<div class="text-wrap">
								<div class="example" style="text-align: right;">
									<div class="btn btn-list">									
										<button type="button" id="btnterminarSolventacion" class="btn ripple btn-outline-info" style="display: none;">
											<i class="fa fa-save"></i> Solventar esta observación
										</button>
										<button type="summit" class="btn ripple btn-outline-primary">
											<i class="fa fa-search fa-upload"></i> Cargar documento
										</button>
									</div>
								</div><br>
								
								<div class="panel-body" id="vcargarInputsArray"></div>
							</div>
						</div>
					</div>
				</div>
			</div>    
	    <?php echo Form::close(); ?>

		<!-- Fin Cargar documentos  -->
		<?php endif; ?>

		<div class="row">
			<div class="col-lg-12">
				<div class="card custom-card">
					<div class="card-body">
						<div>
							<h6 class="card-title mb-1">Documentos</h6>
							<p class="text-muted card-sub-title">Documentos cargados de la observación.</p>
						</div>
						<div class="table-responsive">
							<table id="solventaciones_tbl" class="table table-hover">
								<thead style="background-color: #333333 !important;">
									<tr>
										<th style="padding: 15px; color: #fff;">#</th>
										<th style="padding: 15px; color: #fff;">Area</th>
										<th style="padding: 15px; color: #fff;">Status</th>
										<th style="padding: 15px; color: #fff;">Observación</th>
										<th style="padding: 15px; color: #fff;">Soporte</th>
										<th style="padding: 15px; color: #fff;">Eliminar</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- <div class="col-md-4"></div>
		</div> -->

	<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\www\sircse\resources\views/backend/mis-observaciones/observacion.blade.php ENDPATH**/ ?>