<div class="alert alert-custom alert-light-dark fade show mb-10" role="alert">
	<div class="alert-icon">
		<span class="svg-icon svg-icon-3x svg-icon-dark">
			<!--begin::Svg Icon | path:assets/media/svg/icons/Code/Info-circle.svg-->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24" />
					<circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
					<rect fill="#000000" x="11" y="10" width="2" height="7" rx="1" />
					<rect fill="#000000" x="11" y="7" width="2" height="2" rx="1" />
				</g>
			</svg>
			<!--end::Svg Icon-->
		</span>
	</div>
	<div class="alert-text font-weight-bold">
		<h6><span class="label label-dot label-dark"></span>
		El folio de pago requerido es obligatorio, porque es mediante el cual su tramite se llevara a cabo.</h6>
		
		<h6><span class="label label-dot label-dark"></span>
		El correo electrónico es importante por que es a través del cual se enviaran notificaciones del sistema</h6>
<<<<<<< HEAD


	</div>
</div>

<div class="row">
	<div class="col-md-12 col-lg-12 col-xl-12">
		<div class="">			
			
			<div class="form-group">

				<div class="row row-sm">
					<div class="col-sm-6 mg-t-20 mg-sm-t-0">
						
					</div>

					<?php if($chk_id_tipo_persona_1): ?>
						<input type="hidden" name="id_tipo_persona" value="1">
					<?php endif; ?>
					<?php if($chk_id_tipo_persona_2): ?>
						<input type="hidden" name="id_tipo_persona" value="2">
					<?php endif; ?>
				</div>



				<div class="row">
					<div class="col-md-6">
						<div class="mb-15">
						    <div class="form-group row">
						    	<label class="col-lg-3 col-form-label text-right"><b>RFC:</b></label>
						    	<div class="col-lg-6">
						     		<input type="text" class="form-control inp-udi" value="<?php echo e($datos->rfc); ?>" disabled />
						     		<input type="hidden" id="rfc" name="rfc" class="rfc" value="<?php echo e($datos->rfc); ?>">
						    	</div>
						    </div>
						
						    <div class="form-group row">
						    	<label class="col-lg-3 col-form-label text-right"><b>Folio de pago *:</b></label>
						    	<div class="col-lg-6">
						     		<?php echo Form::text('folio_pago_temp', null, ['id'=>'folio_pago_temp', 'class'=>'form-control inp-udi input-sm']); ?>

						    	</div>
						    </div>

						    <div class="form-group row">
						    	<label class="col-lg-3 col-form-label text-right"><b>Tel&eacute;fono *:</b></label>
						    	<div class="col-lg-6">
						     		<?php echo Form::text('telefono', null, ['id'=>'telefono',  'class'=>'form-control inp-udi input-sm']); ?>

						    	</div>
						    </div>

						    <div class="form-group row moral">
						    	<label class="col-lg-3 col-form-label text-right"><b>Razon social:</b></label>
						    	<div class="col-lg-6">
						     		<input type="text" class="form-control inp-udi" value="<?php echo e($datos->razon_social_o_nombre); ?>" disabled />
						     		<input type="hidden" id="razon_social_o_nombre" name="razon_social_o_nombre" class="razon_social_o_nombre" value="<?php echo e($datos->razon_social_o_nombre); ?>">
						    	</div>
						    </div>

						    <div class="form-group row fisica">
						    	<label class="col-lg-3 col-form-label text-right"><b>Nombre:</b></label>
						    	<div class="col-lg-6">
						     		<input type="text" class="form-control inp-udi" value="<?php echo e($datos->nombre); ?>" disabled />
									<input type="hidden" id="nombre" name="nombre" class="nombre" value="<?php echo e($datos->nombre); ?>">
						    	</div>
						    </div>

						    <div class="form-group row fisica">
						    	<label class="col-lg-3 col-form-label text-right"><b>Materno:</b></label>
						    	<div class="col-lg-6">
						     		<input type="text" class="form-control inp-udi" value="<?php echo e($datos->ap_materno); ?>" disabled />
									<input type="hidden" id="ap_materno" name="ap_materno" class="ap_materno" value="<?php echo e($datos->ap_materno); ?>">
						    	</div>
						    </div>

						    <div class="form-group row fisica">
						    	<label class="col-lg-3 col-form-label text-right"><b>Tipo identificación:</b></label>
						    	<div class="col-lg-6">
						     		<?php echo Form::select('id_tipo_identificacion', $tipo_identificaciones, null, ['id' => 'id_tipo_identificacion', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi']); ?>

						    	</div>
						    </div>

						    <div class="form-group row fisica">
						    	<label class="col-lg-3 col-form-label text-right"><b>Nacionalidad:</b></label>
						    	<div class="col-lg-6">
						     		<?php echo Form::select('id_nacionalidad', $nacionalidades, $default_nacionalidad, ['id' => 'id_nacionalidad', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi']); ?>

						    	</div>
						    </div>

						</div>
					</div>

					<div class="col-md-6">
						<div class="mb-15">
							<div class="form-group row">
						    	<label class="col-lg-3 col-form-label text-right"><b>Sujeto:</b></label>
						    	<div class="col-lg-6">
						     		
						    		<?php if(!isset($datos)): ?>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-3">
												<label class="tx-12 tx-medium tx-gray-700"><b>Sujeto</b></label>
											</div>
											<div class="col-md-9 mg-t-5 mg-md-t-0">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="id_sujeto" id="id_sujeto_1" onclick="cargar_documentacion_requerida($('#id_tipo_tramite').val(),this.value);" value="1" <?php echo e($chk_id_sujeto_1); ?> >
													<label class="form-check-label" for="id_sujeto_1">Contratista</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="id_sujeto" id="id_sujeto_2" onclick="cargar_documentacion_requerida($('#id_tipo_tramite').val(),this.value);" value="2" <?php echo e($chk_id_sujeto_2); ?>>
													<label class="form-check-label" for="id_sujeto_2">Supervisor</label>
												</div>
											</div>
										</div>
									<?php else: ?>
										<?php if($datos->id_sujeto==1): ?> <span class="label label-lg label-light-primary label-inline font-weight-bold py-4"><b>CONTRATISTA</b></span> <?php else: ?> <span class="label label-lg label-light-primary label-inline font-weight-bold py-4"><b>SUPERVISOR</b></span> <?php endif; ?>											
									<?php endif; ?>

						    	</div>
						    </div>

							<div class="form-group row">
						    	<label class="col-lg-3 col-form-label text-right"><b>Fecha de pago*:</b></label>
						    	<div class="col-lg-6">
						     		<?php echo Form::text('fecha_pago_temp', null, ['id'=>'fecha_pago_temp', 'class'=>'form-control  fc-datepicker inp-udi']); ?>

						    	</div>
							</div>

							<div class="form-group row">
						    	<label class="col-lg-3 col-form-label text-right"><b>Correo *:</b></label>
						    	<div class="col-lg-6">
						     		<?php echo Form::text('correo', null, ['id'=>'correo', 'class'=>'form-control inp-udi']); ?>

						    	</div>
						   	</div>

						    <div class="form-group row fisica">
						    	<label class="col-lg-3 col-form-label text-right"><b>Paterno:</b></label>
						    	<div class="col-lg-6">
						     		<input type="text" class="form-control inp-udi" value="<?php echo e($datos->ap_paterno); ?>" disabled />
									<input type="hidden" id="ap_paterno" name="ap_paterno" class="ap_paterno" value="<?php echo e($datos->ap_paterno); ?>">
						    	</div>
						    </div>

						    <div class="form-group row fisica">
						    	<label class="col-lg-3 col-form-label text-right"><b>CURP:</b></label>
						    	<div class="col-lg-6">
						     		<input type="text" class="form-control inp-udi" value="<?php echo e($datos->curp); ?>" disabled />
									<input type="hidden" name="curp" value="<?php echo $datos->curp; ?>">
						    	</div>
						    </div>

						    <div class="form-group row fisica">
						    	<label class="col-lg-3 col-form-label text-right"><b>Número identificación:</b></label>
						    	<div class="col-lg-6">
									<?php echo Form::text('numero_identificacion', null, ['id'=>'numero_identificacion', 'class'=>'form-control inp-udi']); ?>

						    	</div>
						    </div>

						    <div class="form-group row fisica">
							    <label class="col-lg-3 col-form-label text-right"><b>Sexo</b></label>
							    <div class="col-lg-6">
								    <div class="radio-inline pt-2">
								        <label class="radio radio-rounded">
								            <input type="radio" name="sexo" id="sexo_1" value="1" <?php echo e($chk_sexo_1); ?>/>
								            <span></span>
								            Masculino
								        </label>
								        <label class="radio radio-rounded">
								            <input type="radio" name="sexo" id="sexo_2" value="2" <?php echo e($chk_sexo_2); ?>/>
								            <span></span>
								            Femenino
								        </label>								        
								    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			
=======
	</div>
</div>


<?php if($chk_id_tipo_persona_1): ?>
	<input type="hidden" name="id_tipo_persona" value="1">
<?php endif; ?>
<?php if($chk_id_tipo_persona_2): ?>
	<input type="hidden" name="id_tipo_persona" value="2">
<?php endif; ?>


<div class="row">
	<div class="col-md-6">
		<div class="mb-15">
		    <div class="form-group row">
		    	<label class="col-lg-3 col-form-label text-right"><b>RFC:</b></label>
		    	<div class="col-lg-6">
		     		<input type="text" class="form-control inp-udi" value="<?php echo e($datos->rfc); ?>" disabled />
		     		<input type="hidden" id="rfc" name="rfc" class="rfc" value="<?php echo e($datos->rfc); ?>">
		    	</div>
		    </div>
		
		    <div class="form-group row">
		    	<label class="col-lg-3 col-form-label text-right"><b>Folio de pago *:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('folio_pago_temp', null, ['id'=>'folio_pago_temp', 'class'=>'form-control inp-udi input-sm']); ?>

		    	</div>
		    </div>

		    <div class="form-group row">
		    	<label class="col-lg-3 col-form-label text-right"><b>Tel&eacute;fono *:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('telefono', null, ['id'=>'telefono',  'class'=>'form-control inp-udi input-sm']); ?>

		    	</div>
		    </div>

		    <div class="form-group row moral">
		    	<label class="col-lg-3 col-form-label text-right"><b>Razon social:</b></label>
		    	<div class="col-lg-6">
		     		<input type="text" class="form-control inp-udi" value="<?php echo e($datos->razon_social_o_nombre); ?>" disabled />
		     		<input type="hidden" id="razon_social_o_nombre" name="razon_social_o_nombre" class="razon_social_o_nombre" value="<?php echo e($datos->razon_social_o_nombre); ?>">
		    	</div>
		    </div>

		    <div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>Nombre:</b></label>
		    	<div class="col-lg-6">
		     		<input type="text" class="form-control inp-udi" value="<?php echo e($datos->nombre); ?>" disabled />
					<input type="hidden" id="nombre" name="nombre" class="nombre" value="<?php echo e($datos->nombre); ?>">
		    	</div>
		    </div>

		    <div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>Materno:</b></label>
		    	<div class="col-lg-6">
		     		<input type="text" class="form-control inp-udi" value="<?php echo e($datos->ap_materno); ?>" disabled />
					<input type="hidden" id="ap_materno" name="ap_materno" class="ap_materno" value="<?php echo e($datos->ap_materno); ?>">
		    	</div>
		    </div>

		    <div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>Tipo identificación:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::select('id_tipo_identificacion', $tipo_identificaciones, null, ['id' => 'id_tipo_identificacion', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi']); ?>

		    	</div>
		    </div>

		    <div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>Nacionalidad:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::select('id_nacionalidad', $nacionalidades, $default_nacionalidad, ['id' => 'id_nacionalidad', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi']); ?>

		    	</div>
		    </div>

		</div>
	</div>

	<div class="col-md-6">
		<div class="mb-15">
			<div class="form-group row">
		    	<label class="col-lg-3 col-form-label text-right"><b>Sujeto:</b></label>
		    	<div class="col-lg-6">
		     		
		    		<?php if(!isset($datos)): ?>
						<div class="row row-xs align-items-center mg-b-20">
							<div class="col-md-3">
								<label class="tx-12 tx-medium tx-gray-700"><b>Sujeto</b></label>
							</div>
							<div class="col-md-9 mg-t-5 mg-md-t-0">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="id_sujeto" id="id_sujeto_1" onclick="cargar_documentacion_requerida($('#id_tipo_tramite').val(),this.value);" value="1" <?php echo e($chk_id_sujeto_1); ?> >
									<label class="form-check-label" for="id_sujeto_1">Contratista</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="id_sujeto" id="id_sujeto_2" onclick="cargar_documentacion_requerida($('#id_tipo_tramite').val(),this.value);" value="2" <?php echo e($chk_id_sujeto_2); ?>>
									<label class="form-check-label" for="id_sujeto_2">Supervisor</label>
								</div>
							</div>
						</div>
					<?php else: ?>
						<?php if($datos->id_sujeto==1): ?> <span class="label label-lg label-light-primary label-inline font-weight-bold py-4"><b>CONTRATISTA</b></span> <?php else: ?> <span class="label label-lg label-light-primary label-inline font-weight-bold py-4"><b>SUPERVISOR</b></span> <?php endif; ?>											
					<?php endif; ?>

		    	</div>
		    </div>

			<div class="form-group row">
		    	<label class="col-lg-3 col-form-label text-right"><b>Fecha de pago*:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('fecha_pago_temp', null, ['id'=>'fecha_pago_temp', 'class'=>'form-control  fc-datepicker inp-udi']); ?>

		    	</div>
			</div>

			<div class="form-group row">
		    	<label class="col-lg-3 col-form-label text-right"><b>Correo *:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('correo', null, ['id'=>'correo', 'class'=>'form-control inp-udi']); ?>

		    	</div>
		   	</div>

		    <div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>Paterno:</b></label>
		    	<div class="col-lg-6">
		     		<input type="text" class="form-control inp-udi" value="<?php echo e($datos->ap_paterno); ?>" disabled />
					<input type="hidden" id="ap_paterno" name="ap_paterno" class="ap_paterno" value="<?php echo e($datos->ap_paterno); ?>">
		    	</div>
		    </div>

		    <div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>CURP:</b></label>
		    	<div class="col-lg-6">
		     		<input type="text" class="form-control inp-udi" value="<?php echo e($datos->curp); ?>" disabled />
					<input type="hidden" name="curp" value="<?php echo $datos->curp; ?>">
		    	</div>
		    </div>

		    <div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>Número identificación:</b></label>
		    	<div class="col-lg-6">
					<?php echo Form::text('numero_identificacion', null, ['id'=>'numero_identificacion', 'class'=>'form-control inp-udi']); ?>

		    	</div>
		    </div>

		    <div class="form-group row fisica">
			    <label class="col-lg-3 col-form-label text-right"><b>Sexo</b></label>
			    <div class="col-lg-6">
				    <div class="radio-inline pt-2">
				        <label class="radio radio-rounded">
				            <input type="radio" name="sexo" id="sexo_1" value="1" <?php echo e($chk_sexo_1); ?>/>
				            <span></span>
				            Masculino
				        </label>
				        <label class="radio radio-rounded">
				            <input type="radio" name="sexo" id="sexo_2" value="2" <?php echo e($chk_sexo_2); ?>/>
				            <span></span>
				            Femenino
				        </label>								        
				    </div>
				</div>
			</div>
>>>>>>> branch_adrian
		</div>
	</div>
</div>

<<<<<<< HEAD

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
						<?php echo Form::select('id_estado_particular', $estados, null, ['id' => 'id_estado_particular', 'style'=>'width: 100%;', 'class' => 'form-control select2 select-sm', 'onchange'=>'cargar_municipios_particular(this);']); ?>	
						<div id="el-id_estado_particular" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="id_municipio_particular" class="tx-12 tx-medium tx-gray-700">Municipio*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::select('id_municipio_particular', $municipios_p, null, ['id' => 'id_municipio_particular', 'style'=>'width: 100%;', 'class' => 'form-control select2 select-sm']); ?>

						<div id="el-id_municipio_particular" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="ciudad_particular" class="tx-12 tx-medium tx-gray-700">Ciudad*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::text('ciudad_particular', null, ['id'=>'ciudad_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

						<div id="el-ciudad_particular" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="calle_particular" class="tx-12 tx-medium tx-gray-700">Calle*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::text('calle_particular', null, ['id'=>'calle_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

						<div id="el-calle_particular" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="ext_particular" class="tx-12 tx-medium tx-gray-700">Núm. exterior*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::text('ext_particular', null, ['id'=>'ext_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

						<div id="el-ext_particular" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="int_particular" class="tx-12 tx-medium tx-gray-700">Núm. interior*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::text('int_particular', null, ['id'=>'int_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

						<div id="el-int_particular" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="colonia_particular" class="tx-12 tx-medium tx-gray-700">Colonia*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::text('colonia_particular', null, ['id'=>'colonia_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

						<div id="el-colonia_particular" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="cp_particular" class="tx-12 tx-medium tx-gray-700">CP*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::text('cp_particular', null, ['id'=>'cp_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

						<div id="el-cp_particular" class="invalid-feedback lbl-error"></div>
					</div>
				</div>	

				<div class="row row-xs align-items-center mg-b-20 fisica">
					<div class="col-md-3">
						<label for="referencias_particular" class="tx-12 tx-medium tx-gray-700">Referencias*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::text('referencias_particular', null, ['id'=>'referencias_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

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
						<?php echo Form::select('id_estado_fiscal', $estados, null, ['id' => 'id_estado_fiscal', 'style'=>'width: 100%;', 'class' => 'form-control select2 select-sm', 'onchange'=>'cargar_municipios_fiscal(this);']); ?>	
						<div id="el-id_estado_fiscal" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="id_municipio_fiscal" class="tx-12 tx-medium tx-gray-700">Municipio*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::select('id_municipio_fiscal', $municipios_f, null, ['id' => 'id_municipio_fiscal', 'style'=>'width: 100%;', 'class' => 'form-control select2 select-sm']); ?>		
						<div id="el-id_municipio_fiscal" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="ciudad_fiscal" class="tx-12 tx-medium tx-gray-700">Ciudad*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::text('ciudad_fiscal', null, ['id'=>'ciudad_fiscal', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

						<div id="el-ciudad_fiscal" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="calle_fiscal" class="tx-12 tx-medium tx-gray-700">Calle*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::text('calle_fiscal', null, ['id'=>'calle_fiscal', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

						<div id="el-calle_fiscal" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="ext_fiscal" class="tx-12 tx-medium tx-gray-700">Núm. exterior*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::text('ext_fiscal', null, ['id'=>'ext_fiscal', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

						<div id="el-ext_fiscal" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="int_fiscal" class="tx-12 tx-medium tx-gray-700">Núm. interior*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::text('int_fiscal', null, ['id'=>'int_fiscal', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

						<div id="el-int_fiscal" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="colonia_fiscal" class="tx-12 tx-medium tx-gray-700">Colonia*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::text('colonia_fiscal', null, ['id'=>'colonia_fiscal', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

						<div id="el-colonia_fiscal" class="invalid-feedback lbl-error"></div>	
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="cp_fiscal" class="tx-12 tx-medium tx-gray-700">CP*</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::text('cp_fiscal', null, ['id'=>'cp_fiscal', 'placeholder'=>'', 'class'=>'form-control input-sm']); ?>

						<div id="el-cp_fiscal" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

				<div class="row row-xs align-items-center mg-b-20">
					<div class="col-md-3">
						<label for="referencias_fiscal" class="tx-12 tx-medium tx-gray-700">Referencias</label>
					</div>
					<div class="col-md-9 mg-t-5 mg-md-t-0">
						<?php echo Form::text('referencias_fiscal', null, ['id'=>'referencias_fiscal', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

						<div id="el-referencias_fiscal" class="invalid-feedback lbl-error"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

=======
<div class="row">	
	<div class="col-md-6 fisica">
		<h3 class="font-size-lg text-dark font-weight-bold mb-6">Domicilio particular</h3>
		<div class="mb-15">
			<div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>Estado:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::select('id_estado_particular', $estados, null, ['id' => 'id_estado_particular', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi', 'onchange'=>'cargar_municipios_particular(this);']); ?>	
		    	</div>
		    </div>

		    <div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>Municipio:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::select('id_municipio_particular', $municipios_p, null, ['id' => 'id_municipio_particular', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi']); ?>	
		    	</div>
		    </div>

		    <div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>Ciudad:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('ciudad_particular', null, ['id'=>'ciudad_particular', 'class'=>'form-control inp-udi']); ?>	
		    	</div>
		    </div>

		    <div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>Calle:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('calle_particular', null, ['id'=>'calle_particular', 'class'=>'form-control inp-udi']); ?>	
		    	</div>
		    </div>

		    <div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>Num. exterior:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('ext_particular', null, ['id'=>'ext_particular', 'class'=>'form-control inp-udi']); ?>	
		    	</div>
		    </div>

		    <div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>Num. interior:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('int_particular', null, ['id'=>'int_particular', 'class'=>'form-control inp-udi']); ?>	
		    	</div>
		    </div>

		    <div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>Colonia:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('colonia_particular', null, ['id'=>'colonia_particular', 'class'=>'form-control inp-udi']); ?>	
		    	</div>
		    </div>

		    <div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>CP:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('cp_particular', null, ['id'=>'cp_particular', 'class'=>'form-control inp-udi']); ?>	
		    	</div>
		    </div>

		    <div class="form-group row fisica">
		    	<label class="col-lg-3 col-form-label text-right"><b>Referencias:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('referencias_particular', null, ['id'=>'referencias_particular', 'class'=>'form-control inp-udi']); ?>	
		    	</div>
		    </div>
		</div>
	</div>

	<div class="col-md-6">
		<h3 class="font-size-lg text-dark font-weight-bold mb-6">Domicilio fiscal</h3>
		<div class="mb-15">
			<div class="form-group row">
		    	<label class="col-lg-3 col-form-label text-right"><b>Estado:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::select('id_estado_fiscal', $estados, null, ['id' => 'id_estado_fiscal', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi', 'onchange'=>'cargar_municipios_fiscal(this);']); ?>	
		    	</div>
		    </div>

		    <div class="form-group row">
		    	<label class="col-lg-3 col-form-label text-right"><b>Municipio:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::select('id_municipio_fiscal', $municipios_f, null, ['id' => 'id_municipio_fiscal', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi']); ?>		
		    	</div>
		    </div>

		    <div class="form-group row">
		    	<label class="col-lg-3 col-form-label text-right"><b>Ciudad:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('ciudad_fiscal', null, ['id'=>'ciudad_fiscal', 'class'=>'form-control inp-udi']); ?>		
		    	</div>
		    </div>

		    <div class="form-group row">
		    	<label class="col-lg-3 col-form-label text-right"><b>Calle:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('calle_fiscal', null, ['id'=>'calle_fiscal', 'class'=>'form-control inp-udi']); ?>		
		    	</div>
		    </div>

		    <div class="form-group row">
		    	<label class="col-lg-3 col-form-label text-right"><b>Num. exterior:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('ext_fiscal', null, ['id'=>'ext_fiscal', 'class'=>'form-control inp-udi']); ?>		
		    	</div>
		    </div>

		    <div class="form-group row">
		    	<label class="col-lg-3 col-form-label text-right"><b>Num. interior:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('int_fiscal', null, ['id'=>'int_fiscal', 'class'=>'form-control inp-udi']); ?>		
		    	</div>
		    </div>

		    <div class="form-group row">
		    	<label class="col-lg-3 col-form-label text-right"><b>Colonia:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('colonia_fiscal', null, ['id'=>'colonia_fiscal', 'class'=>'form-control inp-udi']); ?>		
		    	</div>
		    </div>

		    <div class="form-group row">
		    	<label class="col-lg-3 col-form-label text-right"><b>CP:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('cp', null, ['id'=>'cp', 'class'=>'form-control inp-udi']); ?>		
		    	</div>
		    </div>

		    <div class="form-group row">
		    	<label class="col-lg-3 col-form-label text-right"><b>Referencias:</b></label>
		    	<div class="col-lg-6">
		     		<?php echo Form::text('referencias_fiscal', null, ['id'=>'referencias_fiscal', 'class'=>'form-control inp-udi']); ?>		
		    	</div>
		    </div>
		</div>
	</div>
>>>>>>> branch_adrian
</div><?php /**PATH C:\AppServ\www\sircse\resources\views/backend/mis-tramites/form.blade.php ENDPATH**/ ?>