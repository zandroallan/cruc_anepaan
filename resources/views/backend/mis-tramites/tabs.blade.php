
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
			@include('backend.mis-tramites.tabs-documentacion')
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
