
<div class="row">
	<div class="col-xl-12 col-lg-12 col-md-12">
		<div class="card custom-card overflow-hidden">
			<div class="card-body">
				<div class="border">
					<div class="bg-light">
						<nav class="nav nav-tabs">
							<a class="nav-link active" data-toggle="tab" href="#tab1">
								<i class="fe fe-layers"></i> Mis datos
								<b><i id="iconDatos" class="fas fa-check-circle text-success fa-lg"></i></b>
							</a>
							<a class="nav-link" data-toggle="tab" href="#tab2">
								<i class="far fa-address-book"></i> Documentación
								<b><i id="iconDocumentacion" class="fas fa-check-circle text-success fa-lg" style="display: none;"></i></b>
							</a>
							<a class="nav-link" data-toggle="tab" href="#tab3">
								<i class="fas fa-users"></i> Socios legales <b>
								<i id="iconSocio" class="fas fa-check-circle text-success fa-lg" style="display: none;"></i></b>
							</a>
							<a class="nav-link" data-toggle="tab" href="#tab4">
								<i class="fas fa-university"></i> Area legal
								<b><i id="iconLegal" class="fas fa-check-circle text-success fa-lg" style="display: none;"></i></b>
							</a>
							<a class="nav-link" data-toggle="tab" href="#tab5">
								<i class="fas fa-diagnoses"></i> Area técnica
								<b><i id="iconTecnica" class="fas fa-check-circle text-success fa-lg" style="display: none;"></i></b>
							</a>
							<a class="nav-link" data-toggle="tab" href="#tab6">
								<i class="far fa-user"></i> Contacto 
								<b><i id="iconContacto" class="fas fa-check-circle text-success fa-lg" style="display: none;"></i></b>
							</a>
						</nav>
					</div>
					<div class="card-body tab-content">
						<div class="tab-pane active show" id="tab1">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12">
									<div class="card-body">
										@include('backend.mis-tramites.tabs-general')
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="tab2">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12">
									<div class="card-body">
										@include('backend.mis-tramites.tabs-documentacion')
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="tab3">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12">
									<div class="card-body">
										@include('backend.mis-tramites.tabs-socios')
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="tab4">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12">
									<div class="card-body">
										@include('backend.mis-tramites.tabs-legal')
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="tab5">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12">
									<div class="card-body">
										@include('backend.mis-tramites.tabs-tecnica')
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="tab6">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12">
									<div class="card-body">
										@include('backend.mis-tramites.tabs-contacto')
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
