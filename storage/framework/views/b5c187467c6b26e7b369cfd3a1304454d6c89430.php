
		<?php echo Form::hidden('enviar_stt2', 0, ['id'=>'enviar_stt2', 'class'=>'form-control gui-input']); ?>	
		<?php echo Form::hidden('id2', null,['id2'=>'id2', 'class'=>'form-control gui-input']); ?>

		<?php echo Form::hidden('id_tipo_tramite2', $id_tipo_tramite,['id'=>'id_tipo_tramite2', 'class'=>'form-control gui-input']); ?>

		<?php echo Form::hidden('id_d_personal2', null,['id'=>'id_d_personal2', 'class'=>'form-control gui-input']); ?>				
		<?php echo Form::hidden('ssjjtt2', $datos->id_sujeto,['id'=>'ssjjtt2', 'class'=>'form-control gui-input']); ?>				

		<?php echo $__env->make('backend.mis-tramites.form-socios', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<?php echo Form::open([
						'route' => [
							$current_route.'.destroy-socios-legales', 
							0
						],
						'id'=>'socios_frm_destroy',
						'name'=>'socios_frm_destroy',
						'method' => 'DELETE'
					], [ 'role' => 'form' ]); ?>


		<?php echo Form::close(); ?>

		            
<?php /**PATH C:\AppServ\apps\sircse\resources\views/backend/mis-tramites/tabs-socios.blade.php ENDPATH**/ ?>