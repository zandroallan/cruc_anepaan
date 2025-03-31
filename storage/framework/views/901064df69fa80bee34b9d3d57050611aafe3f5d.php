
	<div class="row">
		<div class="col-lg-12">
			<div class="accordion accordion-toggle-arrow" id="accordionExample1">
				<div class="card">
					<div class="card-header">
						<div class="card-title" data-toggle="collapse" data-target="#collapseOne1">Informaci&oacute;n importante</div>
					</div>
					<div id="collapseOne1" class="collapse" data-parent="#accordionExample1">
						<div class="alert alert-custom alert-outline-info fade show mb-1" role="alert">
						    <div class="alert-text">
						    	<p>La Secretaría procederá al análisis de la documentación proporcionada, en caso de que no cumpla con los requisitos aplicables o se le requiera alguna aclaración. La Secretaría prevendrá por una sola vez, para que subsane la omisión u observaciones dentro del término de <b>cinco días hábiles</b>, contados a partir de que haya surtido efectos la notificación; transcurrido el plazo sin que el solicitante desahogue la prevención, se desechará el trámite de la solicitud, pudiendo el interesado solicitar nuevamente el trámite correspondiente.</p>
								  <hr>
								  <p class="mb-0">La Secretaría tendrá por recibida una solicitud y comenzará a correr el plazo de treinta días naturales, para que otorgue o niegue la constancia de inscripción, modificación o actualización en el registro de Contratistas o de Supervisores Externos, cuando el solicitante solvente las observaciones o presente la documentación completa con todos los requisitos.</p>
						    </div>					    
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
			
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
		<div class="card">
			<div class="card-body">
				<?php echo $__env->make('backend.mis-tramites.tabs-general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>		
			</div>
		</div>		
	</section>

	<section id="content2">
		<div class="card">
			<div class="card-body">
				<?php echo $__env->make('backend.mis-tramites.tabs-documentacion', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>			
			</div>
		</div>
	</section>

	<section id="content3">
		<div class="card">
			<div class="card-body">
				<?php echo $__env->make('backend.mis-tramites.tabs-socios', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		</div>
	</section>

	<section id="content4">
		<?php echo $__env->make('backend.mis-tramites.tabs-legal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</section>

	<section id="content5">
		<div class="card">
			<div class="card-body">
				<?php echo $__env->make('backend.mis-tramites.tabs-tecnica', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		</div>
	</section>

	<section id="content6">
		<div class="card">
			<div class="card-body">
				<?php echo $__env->make('backend.mis-tramites.tabs-financiera', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		</div>
	</section>

	<section id="content7">
		<div class="card">
			<div class="card-body">
				<?php echo $__env->make('backend.mis-tramites.tabs-contacto', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		</div>
	</section>
<?php /**PATH C:\AppServ\www\sircse\resources\views/backend/mis-tramites/tabs.blade.php ENDPATH**/ ?>