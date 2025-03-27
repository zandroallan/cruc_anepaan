@extends('layouts.frontend')

	@section('styles')

		{!! Html::style('public/dashlead/plugins/select2/css/select2.min.css'); !!}

	@endsection

	@section('js')

		{!! Html::script('public/dashlead/plugins/select2/css/select2.min.css'); !!}
		{!! Html::script('public/dashlead/js/select2.js'); !!}
		{!! Html::script('public/dashlead/plugins/sweetalert/dist/sweetalert.min.js'); !!}	
		{!! Html::script('public/js/frontend/general.js'); !!}
		{!! Html::script('public/js/frontend/crear-cuenta.js'); !!}

	@endsection

	@section('buttons')
		{!! Form::button('<i class="fa fa-save"></i> Guardar', ['class' => 'btn btn-white btn-sm', 'type' => 'button', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Guardar', 'onclick'=>'save(this);']) !!}
	@endsection

	@section('breadcrumbs')
	    <li class="breadcrumb-item active">Nuevo</li>
	@endsection

	@section('script')
		$(".default-select2").select2();
	@endsection

	@section('content')
		<h3>Crear cuenta</h3>
		<div class="panel panel-inverse">
			<div class="panel-heading ui-sortable-handle">			
				<h4 class="panel-title">Información del registro</h4>
			</div>		
			<div class="panel-body">
			    {!! Form::open(['route' => $current_route.'.store', 'method' => 'POST' , 'files' => true, 'id' => 'frm-1', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']) !!} 		    	
			        <div class="hpanel">
			            <div class="panel-body">
			                @include('frontend.crear-cuenta.form')
			            </div>
			        </div>
			    {!! Form::close() !!}
			</div>
		</div>

	@endsection