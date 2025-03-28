
		<input id="tab1" type="radio" name="tabs" checked>
		<label class="tablabel label1" for="tab1">Mis datos</label>
		    
		<input id="tab2" type="radio" name="tabs">
		<label class="tablabel label2" for="tab2">Documentaci&oacute;n</label>
		    
		<input id="tab3" type="radio" name="tabs">
		<label class="tablabel label3" for="tab3">Socios legales</label>
		    
		<input id="tab4" type="radio" name="tabs">
		<label class="tablabel label4" for="tab4">Legal</label>

		<input id="tab5" type="radio" name="tabs">
		<label class="tablabel label5" for="tab5">Tecnica</label>

		<input id="tab6" type="radio" name="tabs">
		<label class="tablabel label6" for="tab6">Financiera</label>

		<input id="tab7" type="radio" name="tabs">
		<label class="tablabel label7" for="tab7">Contacto</label>


		<section id="content1">
			<?php echo $__env->make('backend.mis-tramites.tabs-general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</section>

		<section id="content2">
			<?php echo $__env->make('backend.mis-tramites.tabs-documentacion', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</section>

		<section id="content3">
			<?php echo $__env->make('backend.mis-tramites.tabs-socios', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</section>

		<section id="content4">
			<?php echo $__env->make('backend.mis-tramites.tabs-legal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</section>

		<section id="content5">
			<?php echo $__env->make('backend.mis-tramites.tabs-tecnica', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</section>

		<section id="content6">
			<?php echo $__env->make('backend.mis-tramites.tabs-financiera', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</section>

		<section id="content7">
			<?php echo $__env->make('backend.mis-tramites.tabs-contacto', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</section>
<?php /**PATH C:\AppServ\apps\sircse\resources\views/backend/mis-tramites/tabs.blade.php ENDPATH**/ ?>