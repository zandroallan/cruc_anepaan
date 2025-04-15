@extends('layouts.frontend')

@section('styles')
@endsection

@section('js')
	{!! Html::script('public/template/admin/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js'); !!}
	{!! Html::script('public/template/admin/assets/plugins/sweetalert/dist/sweetalert.min.js'); !!}	
@endsection

@section('buttons')
	
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Videotutorial</li>
@endsection

@section('script')
	
@endsection

@section('content')
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

@endsection