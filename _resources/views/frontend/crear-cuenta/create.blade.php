@extends('layouts.app_cuenta')

	@section('styles')
	@endsection

	@section('js')
		{!! Html::script('public/js/frontend/wizard.js'); !!}
		{!! Html::script('public/js/frontend/general.js'); !!}
		{!! Html::script('public/js/frontend/crear-cuenta.js'); !!}
	@endsection

	@section('buttons')
		{!! Form::button('<i class="fa fa-save"></i> Guardar', ['class' => 'btn btn-white btn-sm', 'type' => 'button', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Guardar', 'onclick'=>'save(this);']) !!}
	@endsection


	@section('script')
	@endsection

	@section('content')
	@endsection