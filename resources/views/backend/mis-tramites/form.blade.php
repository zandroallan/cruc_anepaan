<div class="row">
	<div class="col-md-12">
		<p class="text-primary"><b>Notas:</b></p>
		<div class="activity-block">
			<ul class="task-list">
				<li>
					<i class="task-icon bg-secondary"></i>
					<h6>El folio de pago requerido es obligatorio, porque es mediante el cual su tramite se llevara a cabo.</h6>
					
				</li>
				<li>
					<i class="task-icon bg-secondary"></i>
					<h6>El correo electrónico es importante por que es a través del cual se enviaran notificaciones del sistema</h6>										
				</li>											
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 col-lg-12 col-xl-12">
		<div class="">			
			
			<div class="form-group">

				<div class="row row-sm">
					<div class="col-sm-6 mg-t-20 mg-sm-t-0">
						@if(!isset($datos))
							<div class="row row-xs align-items-center mg-b-20">
								<div class="col-md-3">
									<label class="tx-12 tx-medium tx-gray-700">Sujeto</label>
								</div>
								<div class="col-md-9 mg-t-5 mg-md-t-0">
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
						@else
							<div class="row row-xs align-items-center mg-b-20">
								<div class="col-md-3">
									<label class="tx-12 tx-medium tx-gray-700">Sujeto</label>
								</div>
								<div class="col-md-9 mg-t-5 mg-md-t-0">
									@if($datos->id_sujeto==1) <span class="badge badge-primary">CONTRATISTA</span> @else <span class="badge badge-secondary">SUPERVISOR</span> @endif
								</div>
							</div>
						@endif
					</div>

					@if($chk_id_tipo_persona_1)
						<input type="hidden" name="id_tipo_persona" value="1">
					@endif
					@if($chk_id_tipo_persona_2)
						<input type="hidden" name="id_tipo_persona" value="2">
					@endif

					<!--div class="col-sm-6 mg-t-20 mg-sm-t-0">						
						<div class="row row-xs align-items-center mg-b-20">
							<div class="col-md-3">
								<label class="tx-12 tx-medium tx-gray-700">Tipo persona</label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
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
					</div-->
				</div>

				<div class="row row-sm">
					<div class="col-sm-6 mg-t-20 mg-sm-t-0">						
						<div class="row row-xs align-items-center mg-b-20">
							<div class="col-md-3">
								<label for="rfc" class="tx-12 tx-medium tx-gray-700">RFC*</label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
								<label id="lblrfc" name="lblrfc" class="lblrfc" class="form-control">{!! $datos->rfc !!}</label>
								<input type="hidden" id="rfc" name="rfc" class="rfc" value="{{ $datos->rfc }}">
								<div id="el-rfc" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 mg-t-20 mg-sm-t-0">						
						<div class="row row-xs align-items-center mg-b-20 moral">
							<div class="col-md-3">
								<label for="razon_social_o_nombre" class="tx-12 tx-medium tx-gray-700">Razón social*</label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
								<label id="lblrazon_social_o_nombre" name="lblrazon_social_o_nombre" class="lblrazon_social_o_nombre">{!! $datos->razon_social_o_nombre !!}</label>
								<input type="hidden" id="razon_social_o_nombre" name="razon_social_o_nombre" class="razon_social_o_nombre" value="{{ $datos->razon_social_o_nombre }}">
								<div id="el-razon_social_o_nombre" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
					</div>					
				</div>

				<div class="row row-sm">
					<div class="col-sm-6 mg-t-20 mg-sm-t-0">						
						<div class="row row-xs align-items-center mg-b-20">
							<div class="col-md-3">
								<label for="folio_pago_temp" class="tx-12 tx-medium tx-gray-700">Folio de pago*</label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
								{!! Form::text('folio_pago_temp', null, ['id'=>'folio_pago_temp', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
								<div id="el-folio_pago_temp" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 mg-t-20 mg-sm-t-0">						
						<div class="row row-xs align-items-center mg-b-20">
							<div class="col-md-3">
								<label for="fecha_pago_temp" class="tx-12 tx-medium tx-gray-700">Fecha de pago*</label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
								{!! Form::text('fecha_pago_temp', null, ['id'=>'fecha_pago_temp', 'placeholder'=>'',  'class'=>'form-control  fc-datepicker input-sm']) !!}
								<div id="el-fecha_pago_temp" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="row row-sm">
					<div class="col-sm-6 mg-t-20 mg-sm-t-0">						
						<div class="row row-xs align-items-center mg-b-20">
							<div class="col-md-3">
								<label for="telefono" class="tx-12 tx-medium tx-gray-700">Teléfono*</label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
								{!! Form::text('telefono', null, ['id'=>'telefono', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
								<div id="el-telefono" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 mg-t-20 mg-sm-t-0">						
						<div class="row row-xs align-items-center mg-b-20">
							<div class="col-md-3">
								<label for="correo" class="tx-12 tx-medium tx-gray-700">Correo*</label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
								{!! Form::text('correo', null, ['id'=>'correo', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
								<div id="el-correo" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
					</div>
				</div>				

				<div class="row row-sm fisica">
					<div class="col-sm-6 mg-t-20 mg-sm-t-0">						
						<div class="row row-xs align-items-center mg-b-20 fisica">
							<div class="col-md-3">
								<label for="nombre" class="tx-12 tx-medium tx-gray-700">Nombre*</label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
								<label id="lblnombre" name="lblnombre" class="lblnombre" class="form-control">{!! $datos->nombre !!}</label>
								<input type="hidden" id="nombre" name="nombre" class="nombre" value="{{ $datos->nombre }}">
								<div id="el-nombre" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 mg-t-20 mg-sm-t-0">						
						<div class="row row-xs align-items-center mg-b-20 fisica">
							<div class="col-md-3">
								<label for="ap_paterno" class="tx-12 tx-medium tx-gray-700">A. Paterno*</label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
								<label id="lblap_paterno" name="lblap_paterno" class="lblap_paterno" class="form-control">{!! $datos->ap_paterno !!}</label>
								<input type="hidden" id="ap_paterno" name="ap_paterno" class="ap_paterno" value="{{ $datos->ap_paterno }}">
								<div id="el-ap_paterno" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="row row-sm fisica">
					<div class="col-sm-6 mg-t-20 mg-sm-t-0">						
						<div class="row row-xs align-items-center mg-b-20 fisica">
							<div class="col-md-3">
								<label for="ap_materno" class="tx-12 tx-medium tx-gray-700">A. Materno*</label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
								<label id="lblap_materno" name="lblap_materno" class="lblap_materno" class="form-control">{!! $datos->ap_materno !!}</label>
								<input type="hidden" id="ap_materno" name="ap_materno" class="ap_materno" value="{{ $datos->ap_materno }}">
								<div id="el-ap_materno" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 mg-t-20 mg-sm-t-0">						
						<div class="row row-xs align-items-center mg-b-20 fisica">
							<div class="col-md-3">
								<label for="curp" class="tx-12 tx-medium tx-gray-700">Curp*</label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
								<input type="hidden" name="curp" value="{!! $datos->curp !!}">
								<label id="lblcurp" name="lblcurp" class="lblcurp" class="form-control">{!! $datos->curp !!}</label>
								<div id="el-curp" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="row row-sm fisica">
					<div class="col-sm-6 mg-t-20 mg-sm-t-0">
						
						<div class="row row-xs align-items-center mg-b-20 fisica">
							<div class="col-md-3">
								<label for="id_tipo_identificacion" class="tx-12 tx-medium tx-gray-700">Tipo identificación</label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
								{!! Form::select('id_tipo_identificacion', $tipo_identificaciones, null, ['id' => 'id_tipo_identificacion', 'style'=>'width: 100%;', 'class' => 'form-control select2 select-sm']) !!}	
								<div id="el-id_tipo_identificacion" class="invalid-feedback lbl-error"></div>
							</div>
						</div>

					</div>
					<div class="col-sm-6 mg-t-20 mg-sm-t-0">
						
						<div class="row row-xs align-items-center mg-b-20 fisica">
							<div class="col-md-3">
								<label for="numero_identificacion" class="tx-12 tx-medium tx-gray-700">Número de identificación*</label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
								{!! Form::text('numero_identificacion', null, ['id'=>'numero_identificacion', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
								<div id="el-numero_identificacion" class="invalid-feedback lbl-error"></div>	
							</div>
						</div>

					</div>
				</div>

				<div class="row row-sm fisica">
					<div class="col-sm-6 mg-t-20 mg-sm-t-0">						
						<div class="row row-xs align-items-center mg-b-20 fisica">
							<div class="col-md-3">
								<label for="id_nacionalidad" class="tx-12 tx-medium tx-gray-700">Nacionalidad</label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
								{!! Form::select('id_nacionalidad', $nacionalidades, $default_nacionalidad, ['id' => 'id_nacionalidad', 'style'=>'width: 100%;', 'class' => 'form-control select2 select-sm']) !!}	
								<div id="el-id_nacionalidad" class="invalid-feedback lbl-error"></div>	
							</div>
						</div>
					</div>

					<div class="col-sm-6 mg-t-20 mg-sm-t-0">						
						<div class="row row-xs align-items-center mg-b-20 fisica">
							<div class="col-md-3">
								<label class="tx-12 tx-medium tx-gray-700">Genero</label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="sexo" id="sexo_1" value="1" {{ $chk_sexo_1 }}>
									<label class="form-check-label" for="sexo_1">Masculino</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="sexo" id="sexo_2" value="2" {{ $chk_sexo_2 }}>
									<label class="form-check-label" for="sexo_2">Femenino</label>
								</div>
							</div>
						</div>
					</div>					
				</div>

			</div>
			
		</div>
	</div>
</div>


<div class="row">
	
	<div class="col-md-6 col-lg-6 col-xl-6 fisica">
		<h5 class="mb-1 mt-3 tx-gray-700">Domicilio Particular</h5><hr />
		<div class="">
			<div class="form-group">			
						
				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="id_estado_particular" class="tx-12 tx-medium tx-gray-700">Estado*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::select('id_estado_particular', $estados, null, ['id' => 'id_estado_particular', 'style'=>'width: 100%;', 'class' => 'form-control select2 select-sm', 'onchange'=>'cargar_municipios_particular(this);']) !!}	
						<div id="el-id_estado_particular" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="id_municipio_particular" class="tx-12 tx-medium tx-gray-700">Municipio*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::select('id_municipio_particular', $municipios_p, null, ['id' => 'id_municipio_particular', 'style'=>'width: 100%;', 'class' => 'form-control select2 select-sm']) !!}
						<div id="el-id_municipio_particular" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="ciudad_particular" class="tx-12 tx-medium tx-gray-700">Ciudad*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::text('ciudad_particular', null, ['id'=>'ciudad_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
						<div id="el-ciudad_particular" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="calle_particular" class="tx-12 tx-medium tx-gray-700">Calle*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::text('calle_particular', null, ['id'=>'calle_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
						<div id="el-calle_particular" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="ext_particular" class="tx-12 tx-medium tx-gray-700">Núm. exterior*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::text('ext_particular', null, ['id'=>'ext_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
						<div id="el-ext_particular" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="int_particular" class="tx-12 tx-medium tx-gray-700">Núm. interior*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::text('int_particular', null, ['id'=>'int_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
						<div id="el-int_particular" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="colonia_particular" class="tx-12 tx-medium tx-gray-700">Colonia*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::text('colonia_particular', null, ['id'=>'colonia_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
						<div id="el-colonia_particular" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="cp_particular" class="tx-12 tx-medium tx-gray-700">CP*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::text('cp_particular', null, ['id'=>'cp_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
						<div id="el-cp_particular" class="invalid-feedback lbl-error"></div>
					</div>
				</div>	

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="referencias_particular" class="tx-12 tx-medium tx-gray-700">Referencias*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::text('referencias_particular', null, ['id'=>'referencias_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
						<div id="el-referencias_particular" class="invalid-feedback lbl-error"></div>
					</div>
				</div>				
			</div>
		</div>
	</div>

	<div class="col-md-6 col-lg-6 col-xl-6">
		<h5 class="mb-1 mt-3 tx-gray-700">Domicilio Fiscal</h5><hr />
		<div class="">
			<div class="form-group">
				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="id_estado_fiscal" class="tx-12 tx-medium tx-gray-700">Estado*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::select('id_estado_fiscal', $estados, null, ['id' => 'id_estado_fiscal', 'style'=>'width: 100%;', 'class' => 'form-control select2 select-sm', 'onchange'=>'cargar_municipios_fiscal(this);']) !!}	
						<div id="el-id_estado_fiscal" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="id_municipio_fiscal" class="tx-12 tx-medium tx-gray-700">Municipio*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::select('id_municipio_fiscal', $municipios_f, null, ['id' => 'id_municipio_fiscal', 'style'=>'width: 100%;', 'class' => 'form-control select2 select-sm']) !!}		
						<div id="el-id_municipio_fiscal" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="ciudad_fiscal" class="tx-12 tx-medium tx-gray-700">Ciudad*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::text('ciudad_fiscal', null, ['id'=>'ciudad_fiscal', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
						<div id="el-ciudad_fiscal" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="calle_fiscal" class="tx-12 tx-medium tx-gray-700">Calle*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::text('calle_fiscal', null, ['id'=>'calle_fiscal', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
						<div id="el-calle_fiscal" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="ext_fiscal" class="tx-12 tx-medium tx-gray-700">Núm. exterior*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::text('ext_fiscal', null, ['id'=>'ext_fiscal', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
						<div id="el-ext_fiscal" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="int_fiscal" class="tx-12 tx-medium tx-gray-700">Núm. interior*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::text('int_fiscal', null, ['id'=>'int_fiscal', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
						<div id="el-int_fiscal" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="colonia_fiscal" class="tx-12 tx-medium tx-gray-700">Colonia*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::text('colonia_fiscal', null, ['id'=>'colonia_fiscal', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
						<div id="el-colonia_fiscal" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="cp_fiscal" class="tx-12 tx-medium tx-gray-700">CP*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::text('cp_fiscal', null, ['id'=>'cp_fiscal', 'placeholder'=>'', 'class'=>'form-control input-sm']) !!}
						<div id="el-cp_fiscal" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="referencias_fiscal" class="tx-12 tx-medium tx-gray-700">Referencias</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						{!! Form::text('referencias_fiscal', null, ['id'=>'referencias_fiscal', 'placeholder'=>'',  'class'=>'form-control input-sm']) !!}
						<div id="el-referencias_fiscal" class="invalid-feedback lbl-error"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>