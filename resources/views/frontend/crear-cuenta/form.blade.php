<div class="row row-space-10">

	<div class="col-md-6">
		<div class="form-group row align-items-center">
			<label class="col-md-3 col-form-label">Sujeto</label>
			<div class="col-md-9">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="id_sujeto" id="id_sujeto_1" onclick="cargar_documentacion_requerida($('#id_tipo_tramite').val(),this.value);" value="1" {{ $chk_id_sujeto_1 }} >
					<label class="form-check-label" for="id_sujeto_1">Contratista</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="id_sujeto" id="id_sujeto_2" onclick="cargar_documentacion_requerida($('#id_tipo_tramite').val(),this.value);" value="2" {{ $chk_id_sujeto_2 }}>
					<label class="form-check-label" for="id_sujeto_2">Supervisor</label>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group row align-items-center">
			<label class="col-md-3 col-form-label">Tipo de persona</label>
			<div class="col-md-9">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="id_tipo_persona" id="id_tipo_persona_1" onclick="tipo_persona(this.value);" value="1" {{ $chk_id_tipo_persona_1 }}>
					<label class="form-check-label" for="id_tipo_persona_1">Física</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="id_tipo_persona" id="id_tipo_persona_2" onclick="tipo_persona(this.value);" value="2" {{ $chk_id_tipo_persona_2 }}>
					<label class="form-check-label" for="id_tipo_persona_2">Moral</label>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		
		<div class="form-group row m-b-15 d-none moral">
			<label for="razon_social_o_nombre" class="col-form-label col-md-3">Razón social*</label>
			<div class="col-md-9">
				{!! Form::text('razon_social_o_nombre', null, ['id'=>'razon_social_o_nombre', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}				
				<div id="el-razon_social_o_nombre" class="invalid-feedback lbl-error"></div>
			</div>
		</div>
		
		<div class="form-group row m-b-15 fisica">
			<label for="nombre" class="col-form-label col-md-3">Nombre*</label>
			<div class="col-md-9">
				{!! Form::text('nombre', null, ['id'=>'nombre', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}				
				<div id="el-nombre" class="invalid-feedback lbl-error"></div>
			</div>
		</div>
		<div class="form-group row m-b-15 fisica">
			<label for="ap_paterno" class="col-form-label col-md-3">A. paterno*</label>
			<div class="col-md-9">
				{!! Form::text('ap_paterno', null, ['id'=>'ap_paterno', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}				
				<div id="el-ap_paterno" class="invalid-feedback lbl-error"></div>
			</div>
		</div>
		<div class="form-group row m-b-15 fisica">
			<label for="ap_materno" class="col-form-label col-md-3">A. materno*</label>
			<div class="col-md-9">
				{!! Form::text('ap_materno', null, ['id'=>'ap_materno', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}				
				<div id="el-ap_materno" class="invalid-feedback lbl-error"></div>
			</div>
		</div>

		<div class="form-group row m-b-15 fisica">
			<label for="curp" class="col-form-label col-md-3">Curp*</label>
			<div class="col-md-9">
				{!! Form::text('curp', null, ['id'=>'curp', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}			
				<div id="el-curp" class="invalid-feedback lbl-error"></div>
			</div>
		</div>

		<div class="form-group row m-b-15">
			<label for="rfc" class="col-form-label col-md-3">R.F.C.*</label>
			<div class="col-md-9">
				{!! Form::text('rfc', null, ['id'=>'rfc', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}
				<div id="el-rfc" class="invalid-feedback lbl-error"></div>
			</div>
		</div>

		<div class="form-group row m-b-15 fisica">
			<label for="id_nacionalidad" class="col-form-label col-md-3">Nacionalidad*</label>
			<div class="col-md-9">
				{!! Form::select('id_nacionalidad', $nacionalidades, $default_nacionalidad, ['id' => 'id_nacionalidad', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control']) !!}			
				<div id="el-id_nacionalidad" class="invalid-feedback lbl-error"></div>
			</div>
		</div>



	</div>
	<div class="col-md-6">
		<div class="form-group row m-b-15">
			<label for="telefono" class="col-form-label col-md-3">Teléfono*</label>
			<div class="col-md-9">
				{!! Form::text('telefono', null, ['id'=>'telefono', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}
				<div id="el-telefono" class="invalid-feedback lbl-error"></div>
			</div>
		</div>
		<div class="form-group row m-b-15">
			<label for="correo" class="col-form-label col-md-3">Correo electrónico*</label>
			<div class="col-md-9">
				{!! Form::text('correo', null, ['id'=>'correo', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}
				<div id="el-correo" class="invalid-feedback lbl-error"></div>
				<small class="f-s-12 text-grey-darker">Nota: A este correo se enviaran notificaciones del sistema. </small>				
			</div>
		</div>		

		<div class="form-group row m-b-15 fisica">
			<label for="id_tipo_identificacion" class="col-form-label col-md-3">Tipo de identificación*</label>
			<div class="col-md-9">
				{!! Form::select('id_tipo_identificacion', $tipo_identificaciones, null, ['id' => 'id_tipo_identificacion', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control']) !!}			
				<div id="el-id_tipo_identificacion" class="invalid-feedback lbl-error"></div>			
			</div>
		</div>	

		<div class="form-group row m-b-15 fisica">
			<label for="numero_identificacion" class="col-form-label col-md-3">Número de identificación*</label>
			<div class="col-md-9">
				{!! Form::text('numero_identificacion', null, ['id'=>'numero_identificacion', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}
				<div id="el-numero_identificacion" class="invalid-feedback lbl-error"></div>			
			</div>
		</div>	
		
		<div class="form-group row  m-b-15 fisica">
			<label class="col-form-label col-md-3">Sexo*</label>
			<div class="col-md-9">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="sexo" id="sexo_1" value="1" {{ $chk_sexo_1 }}>
					<label class="form-check-label" for="sexo_1">Hombre</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="sexo" id="sexo_2" value="2" {{ $chk_sexo_2 }}>
					<label class="form-check-label" for="sexo_2">Mujer</label>
				</div>
			</div>
		</div>		

	</div>
	
</div>



<legend>Cuenta de usuario</legend>
<p><b>Advertencia:</b> La contraseña deberá tener por lo menos <b>10 caracteres</b> de longitud, contener por lo menos <b>1 número</b>, <b>1 letra minúscula</b>, <b>1 letra mayúscula</b> y <b>1 caracter especial</b>(@$!%*#?&.).</p>
<div class="row">
	<div class="col-md-6">
		<div class="form-group row m-b-15">
			<label for="nickname" class="col-form-label col-md-3">Usuario*</label>
			<div class="col-md-9">
				{!! Form::text('nickname', null, ['id'=>'nickname', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}				
				<div id="el-nickname" class="invalid-feedback lbl-error"></div>
			</div>
		</div>
	</div>
	<div class="col-md-6"></div>
</div>
<div class="row">
	
	<div class="col-md-6">
		<div class="form-group row m-b-15">
			<label for="password" class="col-form-label col-md-3">Contraseña*</label>
			<div class="col-md-9">
				{!! Form::password('password', ['id'=>'password', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}				
				<div id="el-password" class="invalid-feedback lbl-error"></div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row m-b-15">
			<label for="password_confirmation" class="col-form-label col-md-3">Confirmación*</label>
			<div class="col-md-9">
				{!! Form::password('password_confirmation', ['id'=>'password_confirmation', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}				
				<div id="el-password_confirmation" class="invalid-feedback lbl-error"></div>
			</div>
		</div>		
	</div>
</div>

<div class="form-group row m-b-0">
	
	<div class="col-md-12 col-sm-12 text-right">
		{!! Form::button('Crear cuenta', ['class' => 'btn btn-primary', 'type' => 'button', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Guardar', 'onclick'=>'save(this);']) !!}
	</div>
</div>