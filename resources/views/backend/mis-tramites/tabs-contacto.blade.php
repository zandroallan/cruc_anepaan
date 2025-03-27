

	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="col-md">
				
					<form id="frmContacto" name="frmContacto">
						@csrf
						<input type="hidden" id="hdIdRegistro" name="hdIdRegistro" value="{{ $datos->id }}">
						<input type="hidden" id="hdIdContacto" name="hdIdContacto">
						<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Datos del contacto</legend>
						<p><b>Nota:</b> Con el fin de que se atiendan a personas autorizadas y den buen uso de la información, es obligatorio capturar un contacto.</p>

						<div class="form-group row m-b-15">
							<label for="nombre_contacto" class="col-form-label col-md-3">Nombre*</label>
							<div class="col-md-9">
								{!! Form::text('nombre_contacto', null, ['id'=>'nombre_contacto', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}
								<div id="el-nombre_contacto" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label for="ap_paterno_contacto" class="col-form-label col-md-3">A. paterno*</label>
							<div class="col-md-9">
								{!! Form::text('ap_paterno_contacto', null, ['id'=>'ap_paterno_contacto', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}
								<div id="el-ap_paterno_contacto" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label for="ap_materno_contacto" class="col-form-label col-md-3">A. materno*</label>
							<div class="col-md-9">
								{!! Form::text('ap_materno_contacto', null, ['id'=>'ap_materno_contacto', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}
								<div id="el-ap_materno_contacto" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label for="cargo_contacto" class="col-form-label col-md-3">Cargo en la empresa*</label>
							<div class="col-md-9">
								{!! Form::text('cargo_contacto', null, ['id'=>'cargo_contacto', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}
								<div id="el-cargo_contacto" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
					</form>
					<div class="text-right form-group">
						<button id="btn-guardar-contacto" class="btn ripple btn-outline-success" onclick="AddContacto()">
							<i class="fa fa-save"></i> Agregar contacto
						</button>
					</div>
				</div>
			
		</div>
		<div class="col-md-2"></div>
	</div>
