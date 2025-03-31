
	<div class="row">
		<div class="col-lg-12">
			<div class="accordion accordion-solid accordion-panel accordion-svg-toggle" id="accordionExample1">
				<div class="card">
					<div class="card-header">
						<div class="card-title" data-toggle="collapse" data-target="#collapseOne1">
							<i class="icon-xl far fa-hand-point-right"></i>
							Informaci&oacute;n importante
						</div>
					</div>
					<div id="collapseOne1" class="collapse" data-parent="#accordionExample1">
						<div class="alert alert-custom alert-outline-info fade show mb-1" role="alert">
						    <div class="alert-text">
						    	<p>
						    		La Secretaría procederá al análisis de la documentación proporcionada, en caso de que no cumpla con los requisitos aplicables o se le requiera alguna aclaración. La Secretaría prevendrá por una sola vez, para que subsane la omisión u observaciones dentro del término de <b>cinco días hábiles</b>, contados a partir de que haya surtido efectos la notificación; transcurrido el plazo sin que el solicitante desahogue la prevención, se desechará el trámite de la solicitud, pudiendo el interesado solicitar nuevamente el trámite correspondiente.
						    	</p>
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
		@include('backend.mis-tramites.tabs-general')
	</section>

	<section id="content2">
		<div class="card">
			<div class="card-body">
				@include('backend.mis-tramites.tabs-documentacion')
			</div>
		</div>
	</section>

	<section id="content3">
		@include('backend.mis-tramites.tabs-socios')
	</section>

	<section id="content4">
		@include('backend.mis-tramites.tabs-legal')
	</section>

	<section id="content5">
		@include('backend.mis-tramites.tabs-tecnica')
	</section>

	<section id="content6">
		@include('backend.mis-tramites.tabs-financiera')
	</section>

	<section id="content7">
		@include('backend.mis-tramites.tabs-contacto')
	</section>
