	{{ Form::model($datos, array(
			'route' => $current_route.'.store',
			'method' => 'POST',
			'files' => true,
			'id' => 'frm-1',
			'name'=>'myform',
			'class' => 'form-horizontal',
			'enctype'=>'multipart/form-data',
			'accept-charset'=>'UTF-8'
		), 
		array('role' => 'form')) 
	}}

		{!! Form::hidden('enviar_stt', 0,['id'=>'enviar_stt', 'class'=>'form-control gui-input']) !!}
		{!! Form::hidden('id', null,['id'=>'id', 'class'=>'form-control gui-input']) !!}
		{!! Form::hidden('id_tipo_tramite', $id_tipo_tramite,['id'=>'id_tipo_tramite', 'class'=>'form-control gui-input']) !!}
		{!! Form::hidden('id_d_personal', null,['id'=>'id_d_personal', 'class'=>'form-control gui-input']) !!}
		{!! Form::hidden('id_domicilio_fiscal', null,['id'=>'id_domicilio_fiscal', 'class'=>'form-control gui-input']) !!}
		{!! Form::hidden('id_domicilio_particular', null,['id'=>'id_domicilio_particular', 'class'=>'form-control gui-input']) !!}
		{!! Form::hidden('ssjjtt', $datos->id_sujeto,['id'=>'ssjjtt', 'class'=>'form-control gui-input']) !!}
		{!! Form::hidden('obligado_dec_isr', $datos->obligado_dec_isr,['id'=>'obligado_dec_isr', 'class'=>'form-control gui-input']) !!}

		@include('backend.mis-tramites.form')

	{!! Form::close() !!}
