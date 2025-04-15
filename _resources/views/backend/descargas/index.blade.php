@extends('layouts.backend')

	@section('styles')

	@endsection

	@section('js')

	    <script src="{{ asset('public/js/backend/descargas.js') }}"></script>
	    
	@endsection

	@section('buttons')	

	@endsection

	@section('title')

		<h2 class="main-content-title tx-24 mg-b-5">Formatos</h2>

	@endsection

	@section('breadcrumb')

		<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
			{!! html_entity_decode(link_to_route($current_route.'.index', $title, null, [])) !!}
		</h5>	
		<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
		<span class="text-muted font-weight-bold mr-4">Formatos</span>

	@endsection

	@section('script')

		$('._formatos').addClass('menu-item-active');
		cargarTabla();
		
	@endsection

	@section('content')

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
								<div class="alert alert-dark mb-2" role="alert">
								  	<h4 class="alert-heading"><b>Notas.</b></h4>
								  	<p class="text-justify">
								  		El tamaño maximo de los archivos es <strong>5 MB</strong>.
								  	</p>
								  	<hr>
								  	<p class="mb-0 text-justify">
								  		Los Archivos (<strong>DOCX, PDF</strong>) son los permitidos para descargas.
								  	</p>
								  	<hr>
								  	<p class="mb-0 text-justify">
								  		Los archivos cargados estaran disponibles para su descarga desde el portal.
								  	</p>
								</div>
							</div>
						</div>
						<div class="table-responsive _response"></div>
					</div>
				</div>
			</div>
		</div>

	@endsection