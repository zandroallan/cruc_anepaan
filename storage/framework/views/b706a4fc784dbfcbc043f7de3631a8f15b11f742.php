	<?php $__env->startSection('styles'); ?>

		<?php echo Html::style('dashlead/plugins/select2/css/select2.min.css');; ?>


	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('js'); ?>

		<?php echo Html::script('dashlead/plugins/select2/css/select2.min.css');; ?>

		<?php echo Html::script('dashlead/js/select2.js');; ?>

		<?php echo Html::script('dashlead/plugins/sweetalert/dist/sweetalert.min.js');; ?>	
		<?php echo Html::script('js/frontend/general.js');; ?>

		<?php echo Html::script('js/frontend/crear-cuenta.js');; ?>


	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('buttons'); ?>
		<?php echo Form::button('<i class="fa fa-save"></i> Guardar', ['class' => 'btn btn-white btn-sm', 'type' => 'button', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Guardar', 'onclick'=>'save(this);']); ?>

	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('breadcrumbs'); ?>
	    <li class="breadcrumb-item active">Nuevo</li>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('script'); ?>
		$(".default-select2").select2();
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('content'); ?>
		<h3>Crear cuenta</h3>
		<div class="panel panel-inverse">
			<div class="panel-heading ui-sortable-handle">			
				<h4 class="panel-title">Información del registro</h4>
			</div>		
			<div class="panel-body">
			    <?php echo Form::open(['route' => $current_route.'.store', 'method' => 'POST' , 'files' => true, 'id' => 'frm-1', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']); ?> 		    	
			        <div class="hpanel">
			            <div class="panel-body">
			                <?php echo $__env->make('frontend.crear-cuenta.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			            </div>
			        </div>
			    <?php echo Form::close(); ?>

			</div>
		</div>

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/cores/c-sircse/resources/views/frontend/crear-cuenta/create.blade.php ENDPATH**/ ?>