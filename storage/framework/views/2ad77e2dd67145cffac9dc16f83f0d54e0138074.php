			


			<!-- Socios Legales -->		
			<div class="row">
                <div class="col-md-12 form-group text-right">
					<a href="#" class="btn ripple btn-outline-success" data-effect="effect-scale" onclick="modal_socio_legal(0)">
						<i class="fa fa-save"></i> Agregar socio legal
					</a> 
				</div>
            </div>

			<div class="panel-body" style="background: #f9f9f9;">    
				<div class="row">
					<div class="col-md-12 form-horizontal form-bordered profile-content">
						<div class="table-responsive">
							<table id="scs_tbl" class="table table-hover">
								<thead id="hdSocio" class="head-dark">
									<tr>
										<th style="padding: 15px 15px; color: #fff">#</th>
										<th style="padding: 15px 15px; color: #fff">Nombre</th>
										<th style="padding: 15px 15px; color: #fff">R.F.C</th>
										<th style="padding: 15px 15px; color: #fff">Correo electrónico</th>
										<th style="padding: 15px 15px; color: #fff"><i class="fa fa-list"></i></th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>		
					</div>
				</div>
			</div>
		


		<!-- Modal Socios Legales --> 
		<div class="modal fade" id="mdl_dlscs">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header" style="color: 1f5c01; background-color: #ced7df; border-color: #ced7df;">
						<h4 class="modal-title" >Socio legal</h4><br /><br />
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<?php echo Form::open([
						'route' => $current_route.'.store-socios-legales',
						'method' => 'POST',
						'files' => true,
						'id' => 'dlscs_frm',
						'enctype'=>'multipart/form-data',
						'accept-charset'=>'UTF-8'],
						['role' => 'form']); ?> 

					<div class="modal-body">
						<?php echo Form::hidden('dlscs_id', 0,['id'=>'dlscs_id', 'class'=>'form-control gui-input']); ?>

						<?php echo Form::hidden('dlscs_id_tramite', $datos->id,['id'=>'dlscs_id_tramite', 'class'=>'form-control gui-input']); ?>

						
						<h5 class="mb-1 mt-3 tx-gray-700">Datos generales</h5><hr />
						<div class="form-group row m-b-15">
							<label for="dlscs_nombre" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Nombre*</label>
							<div class="col-md-9">
								<?php echo Form::text('dlscs_nombre', null, ['id'=>'dlscs_nombre', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>				
								<div id="el-dlscs_nombre" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label for="dlscs_ap_paterno" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">A. paterno*</label>
							<div class="col-md-9">
								<?php echo Form::text('dlscs_ap_paterno', null, ['id'=>'dlscs_ap_paterno', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>				
								<div id="el-dlscs_ap_paterno" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label for="dlscs_ap_materno" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">A. materno*</label>
							<div class="col-md-9">
								<?php echo Form::text('dlscs_ap_materno', null, ['id'=>'dlscs_ap_materno', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>				
								<div id="el-dlscs_ap_materno" class="invalid-feedback lbl-error"></div>
							</div>
						</div>

						<div class="form-group row m-b-15">
							<label for="dlscs_curp" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Curp*</label>
							<div class="col-md-9">
								<?php echo Form::text('dlscs_curp', null, ['id'=>'dlscs_curp', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>			
								<div id="el-dlscs_curp" class="invalid-feedback lbl-error"></div>
							</div>
						</div>

						<div class="form-group row m-b-15">
							<label for="dlscs_rfc" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">R.F.C.*</label>
							<div class="col-md-9">
								<?php echo Form::text('dlscs_rfc', null, ['id'=>'dlscs_rfc', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

								<div id="el-dlscs_rfc" class="invalid-feedback lbl-error"></div>
							</div>
						</div>

						<div class="form-group row m-b-15">
							<label for="dlscs_id_nacionalidad" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Nacionalidad*</label>
							<div class="col-md-9">
								<?php echo Form::select('dlscs_id_nacionalidad', $nacionalidades, null, ['id' => 'dlscs_id_nacionalidad', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control']); ?>			
								<div id="el-dlscs_id_nacionalidad" class="invalid-feedback lbl-error"></div>
							</div>
						</div>

						<div class="form-group row m-b-15">
							<label for="dlscs_telefono" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Teléfono*</label>
							<div class="col-md-9">
								<?php echo Form::text('dlscs_telefono', null, ['id'=>'dlscs_telefono', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

								<div id="el-dlscs_telefono" class="invalid-feedback lbl-error"></div>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label for="dlscs_correo_electronico" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Correo electrónico*</label>
							<div class="col-md-9">
								<?php echo Form::text('dlscs_correo_electronico', null, ['id'=>'dlscs_correo_electronico', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

								<div id="el-dlscs_correo_electronico" class="invalid-feedback lbl-error"></div>				
							</div>
						</div>		

						<div class="form-group row m-b-15">
							<label for="dlscs_id_tipo_identificacion" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Tipo de identificación*</label>
							<div class="col-md-9">
								<?php echo Form::select('dlscs_id_tipo_identificacion', $tipo_identificaciones, null, ['id' => 'dlscs_id_tipo_identificacion', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control']); ?>			
								<div id="el-dlscs_id_tipo_identificacion" class="invalid-feedback lbl-error"></div>			
							</div>
						</div>	

						<div class="form-group row m-b-15">
							<label for="dlscs_numero_identificacion" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Número de identificación*</label>
							<div class="col-md-9">
								<?php echo Form::text('dlscs_numero_identificacion', null, ['id'=>'dlscs_numero_identificacion', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

								<div id="el-dlscs_numero_identificacion" class="invalid-feedback lbl-error"></div>			
							</div>
						</div>	
						
						<div class="form-group row  m-b-15">
							<label class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Sexo*</label>
							<div class="col-md-9">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="dlscs_sexo" id="dlscs_sexo_1" value="1" checked>
									<label class="form-check-label" for="dlscs_sexo_1">Hombre</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="dlscs_sexo" id="dlscs_sexo_2" value="2">
									<label class="form-check-label" for="dlscs_sexo_2">Mujer</label>
								</div>
							</div>
						</div>

						<h5 class="mb-1 mt-3 tx-gray-700">Domicilio</h5><hr />
						<div class="form-group row m-b-15">
							<label for="dlscs_id_estado_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Estado*</label>
							<div class="col-md-9">
								<?php echo Form::select('dlscs_id_estado_particular', $estados, null, ['id' => 'dlscs_id_estado_particular', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control', 'onchange'=>'cargar_municipios_general(this, $("#dlscs_id_municipio_particular"));']); ?>			
								<div id="el-dlscs_id_estado_particular" class="invalid-feedback lbl-error"></div>			
							</div>
						</div>	

						<div class="form-group row m-b-15">
							<label for="dlscs_id_municipio_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Municipio*</label>
							<div class="col-md-9">
								<?php echo Form::select('dlscs_id_municipio_particular', $municipios_p, null, ['id' => 'dlscs_id_municipio_particular', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control']); ?>			
								<div id="el-dlscs_id_municipio_particular" class="invalid-feedback lbl-error"></div>			
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label for="dlscs_ciudad_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Ciudad</label>
							<div class="col-md-9">
								<?php echo Form::text('dlscs_ciudad_particular', null, ['id'=>'dlscs_ciudad_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

								<div id="el-dlscs_ciudad_particular" class="invalid-feedback lbl-error"></div>			
							</div>
						</div>							
						<div class="form-group row m-b-15">
							<label for="dlscs_calle_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Calle*</label>
							<div class="col-md-9">
								<?php echo Form::text('dlscs_calle_particular', null, ['id'=>'dlscs_calle_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

								<div id="el-dlscs_calle_particular" class="invalid-feedback lbl-error"></div>			
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label for="dlscs_ext_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Núm. exterior*</label>
							<div class="col-md-3">
								<?php echo Form::text('dlscs_ext_particular', null, ['id'=>'dlscs_ext_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

								<div id="el-dlscs_ext_particular" class="invalid-feedback lbl-error"></div>			
							</div>

							<label for="dlscs_int_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Núm. interior</label>
							<div class="col-md-3">
								<?php echo Form::text('dlscs_int_particular', null, ['id'=>'dlscs_int_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

								<div id="el-dlscs_int_particular" class="invalid-feedback lbl-error"></div>			
							</div>
						</div>	
						<div class="form-group row m-b-15">
							<label for="dlscs_colonia_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Colonia*</label>
							<div class="col-md-3">
								<?php echo Form::text('dlscs_colonia_particular', null, ['id'=>'dlscs_colonia_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

								<div id="el-dlscs_colonia_particular" class="invalid-feedback lbl-error"></div>			
							</div>

							<label for="dlscs_cp_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">C.P.*</label>
							<div class="col-md-3">
								<?php echo Form::text('dlscs_cp_particular', null, ['id'=>'dlscs_cp_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

								<div id="el-dlscs_cp_particular" class="invalid-feedback lbl-error"></div>			
							</div>
						</div>	
						<div class="form-group row m-b-15">
							<label for="dlscs_referencias_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Referencias</label>
							<div class="col-md-9">
								<?php echo Form::text('dlscs_referencias_particular', null, ['id'=>'dlscs_referencias_particular', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

								<div id="el-dlscs_referencias_particular" class="invalid-feedback lbl-error"></div>			
							</div>
						</div>
					</div>
					<div class="modal-footer">
	                    <a href="javascript:;" class="btn ripple btn-outline-warning" data-dismiss="modal">
	                        Cerrar
	                    </a>
	                    <button type="submit" class="btn ripple btn-outline-success" >
	                        <i class="fa fa-save"></i> Guardar
	                    </button>                    
	                </div>

					<?php echo Form::close(); ?>	
				</div>
			</div>
		</div>

		<!-- Fin Modal Socios Legales --> <?php /**PATH /var/cores/c-sircse/resources/views/backend/mis-tramites/form-socios.blade.php ENDPATH**/ ?>