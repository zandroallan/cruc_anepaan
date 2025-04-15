

	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="col-md">
				
					<form id="frmContacto" name="frmContacto">
						@csrf
						<input type="hidden" id="hdIdRegistro" name="hdIdRegistro" value="{{ $datos->id }}">
						<input type="hidden" id="hdIdContacto" name="hdIdContacto">
						<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Datos del contacto</legend>

						<div class="alert alert-custom alert-light-dark" role="alert">
						    <div class="alert-icon">
						    	<span class="svg-icon svg-icon-3x svg-icon-dark">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
											<rect fill="#000000" x="11" y="10" width="2" height="7" rx="1" />
											<rect fill="#000000" x="11" y="7" width="2" height="2" rx="1" />
										</g>
									</svg>
								</span>
						    </div>
						    <div class="alert-text">
						      	<b>Nota:</b> Con el fin de que se atiendan a personas autorizadas y den buen uso de la información, es obligatorio capturar un contacto.
						    </div>
						</div>

						<div class="form-group row">
					    	<label  class="col-2 col-form-label"><b>Nombre</b></label>
						    <div class="col-10">
						    	{!! Form::text('nombre_contacto', null, ['id'=>'nombre_contacto', 'class'=>'form-control inp-udi m-b-5']) !!}
						    </div>
					    </div>

					    <div class="form-group row">
					    	<label  class="col-2 col-form-label"><b>A. paterno</b></label>
						    <div class="col-10">
						    	{!! Form::text('ap_paterno_contacto', null, ['id'=>'ap_paterno_contacto', 'class'=>'form-control inp-udi m-b-5']) !!}
						    </div>
					    </div>

					    <div class="form-group row">
					    	<label  class="col-2 col-form-label"><b>A. materno</b></label>
						    <div class="col-10">
						    	{!! Form::text('ap_materno_contacto', null, ['id'=>'ap_materno_contacto', 'class'=>'form-control inp-udi m-b-5']) !!}
						    </div>
					    </div>

					    <div class="form-group row">
					    	<label  class="col-2 col-form-label"><b>Cargo</b></label>
						    <div class="col-10">
						    	{!! Form::text('cargo_contacto', null, ['id'=>'cargo_contacto', 'class'=>'form-control inp-udi m-b-5']) !!}
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
	</div>
