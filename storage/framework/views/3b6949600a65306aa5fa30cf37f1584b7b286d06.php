

<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<?php echo Html::script('template/admin/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js');; ?>

	<?php echo Html::script('template/admin/assets/plugins/sweetalert/dist/sweetalert.min.js');; ?>	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('buttons'); ?>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item active">Videotutorial</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="panel panel-inverse">
		<div class="panel-heading ui-sortable-handle">
			<center>
				<h4 class="panel-title">Videotutorial Tutorial del Sistema <b>(SIRCSE)</b></h4>
			</center>			
		</div>		
		<div class="panel-body">
		    <!--
		    <center>
				<iframe width="560" height="315" src="https://apps.shyfpchiapas.gob.mx/img/sircse.mp4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
				</iframe>
			</center>
			-->

<center>
	<video width="820" height="500" controls="true" poster="" id="video_ii">
		<source type="video/mp4" src="http://apps.shyfpchiapas.gob.mx/sircse/img/sircse.mp4"></source>
	</video>
</center>

			
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/cores/c-sircse/resources/views/frontend/videotutorial/index.blade.php ENDPATH**/ ?>