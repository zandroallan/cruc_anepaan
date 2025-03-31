

	<?php $__env->startSection('styles'); ?>

	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('js'); ?>

	    <script src="<?php echo e(asset('public/js/backend/descargas.js')); ?>"></script>
	    
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('buttons'); ?>	

	<?php $__env->stopSection(); ?>


	<?php $__env->startSection('title'); ?>

		<h2 class="main-content-title tx-24 mg-b-5">Formatos</h2>

	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('breadcrumb'); ?>

	    <li class="breadcrumb-item"><?php echo html_entity_decode(link_to_route($current_route.'.index', $title, null, [])); ?></li>
	    <li class="breadcrumb-item active">Documentos</li>

	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('script'); ?>
		cargarTabla();
		
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('content'); ?>

		<style>
			.bg-gray{
				background-color: #334151; color: #fff
			}
		</style>

		<div class="row">
			<div class="col-lg-12">
				<div class="card custom-card">
					<div class="card-body">
						<div>
							<h6 class="card-title mb-1">Documentación</h6>
							<p class="text-muted card-sub-title">Formatos cargados en el sistema.</p>
						</div>
						<div class="row">
							<div class="col-md-12">
								<p class="text-primary"><b>Notas:</b></p>
								<div class="activity-block">
									<ul class="task-list">
										<li>
											<i class="task-icon bg-secondary"></i>
											<h6>El tamaño maximo de los archivos es <strong>5 MB</strong>.</h6>					
										</li>
										<li>
											<i class="task-icon bg-secondary"></i>
											<h6>Los Archivos (<strong>DOCX, PDF</strong>) son los permitidos para descargas.</h6>										
										</li>
										<li>
											<i class="task-icon bg-secondary"></i>
											<h6>Los archivos cargados estaran disponibles para su descarga desde el portal.</h6>										
										</li>										
									</ul>
								</div>
							</div>
						</div>

						<div class="table-responsive">					
							<div id="dvFormatos" name="dvFormatos"></div>						
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\AppServ\www\sircse\resources\views/backend/descargas/index.blade.php ENDPATH**/ ?>