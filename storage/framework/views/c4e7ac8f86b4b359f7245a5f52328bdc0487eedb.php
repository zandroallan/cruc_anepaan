		<div class="row">
            <div class="col-md-12 form-group text-right">
				<a href="#" class="btn btn-outline-info btn-sm" data-effect="effect-scale" onclick="modal_socio_legal(0)">
					<i class="fa fa-save"></i> Agregar socio legal
				</a> 
			</div>
        </div>
		<table id="scs_tbl" class="table">
			<thead id="hdSocio" class="thead-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Nombre</th>
					<th scope="col">RFC</th>
					<th scope="col">Correo electrónico</th>
					<th scope="col"><i class="fa fa-list"></i></th>
				</tr>
			</thead>
			<tbody>						
			</tbody>
		</table>


		<!-- Modal Socios Legales --> 
		<div class="modal fade" id="mdl_dlscs">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header" style="color: #1f5c01; background-color: #ced7df; border-color: #ced7df;">
						<h4 class="modal-title" >Informaci&oacute;n del Socio legal</h4><br /><br />
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

						

						<ul class="nav nav-success nav-pills" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="tab-1" data-toggle="tab" href="#tbgral">
									<span class="nav-icon">
										<b><i class="far fa-user"></i></b>
									</span>
									<span class="nav-text"><b>Datos generales</b></span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="tab-2" data-toggle="tab" href="#tbdom" aria-controls="profile">
									<span class="nav-icon">
										<b><i class="fas fa-globe"></i></b>
									</span>
									<span class="nav-text"><b>Domicilio</b></span>
								</a>
							</li>
						</ul>
						<div class="tab-content mt-5" id="myTabContent2">
							<div class="tab-pane fade show active" id="tbgral" role="tabpanel" aria-labelledby="tab-1">
								
								<h5 class="mb-1 mt-3 tx-gray-700">Datos generales</h5><hr />

								<div class="form-group row">
								   	<div class="col-lg-6">
								    	<label><b>Nombre:</b></label>
								    	<?php echo Form::text('dlscs_nombre', null, ['id'=>'dlscs_nombre', 'class'=>'form-control inp-udi']); ?>

								    </div>
								    <div class="col-lg-6">
								    	<label><b>Paterno:</b></label>
								    	<?php echo Form::text('dlscs_ap_paterno', null, ['id'=>'dlscs_ap_paterno', 'class'=>'form-control inp-udi']); ?>

								    </div>
								</div>

								<div class="form-group row">
								   	<div class="col-lg-6">
								    	<label><b>Materno:</b></label>
								    	<?php echo Form::text('dlscs_ap_materno', null, ['id'=>'dlscs_ap_materno','class'=>'form-control inp-udi']); ?>

								    </div>
								    <div class="col-lg-6">
								    	<label><b>CURP:</b></label>
								    	<?php echo Form::text('dlscs_curp', null, ['id'=>'dlscs_curp', 'class'=>'form-control inp-udi']); ?>

								    </div>
								</div>

								<div class="form-group row">
								   	<div class="col-lg-6">
								    	<label><b>RFC:</b></label>
								    	<?php echo Form::text('dlscs_rfc', null, ['id'=>'dlscs_rfc', 'class'=>'form-control inp-udi']); ?>

								    </div>
								    <div class="col-lg-6">
								    	<label><b>Nacionalidad:</b></label>
								    	<?php echo Form::select('dlscs_id_nacionalidad', $nacionalidades, null, ['id' => 'dlscs_id_nacionalidad', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi']); ?>

								    </div>
								</div>

								<div class="form-group row">
								   	<div class="col-lg-6">
								    	<label><b>Teléfono:</b></label>
								    	<?php echo Form::text('dlscs_telefono', null, ['id'=>'dlscs_telefono', 'class'=>'form-control inp-udi']); ?>

								    </div>
								    <div class="col-lg-6">
								    	<label><b>Correo electrónico:</b></label>
								    	<?php echo Form::text('dlscs_correo_electronico', null, ['id'=>'dlscs_correo_electronico', 'class'=>'form-control inp-udi']); ?>

								    </div>
								</div>

								<div class="form-group row">
								   	<div class="col-lg-6">
								    	<label><b>Tipo de identificación:</b></label>
								    	<?php echo Form::select('dlscs_id_tipo_identificacion', $tipo_identificaciones, null, ['id' => 'dlscs_id_tipo_identificacion', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi']); ?>

								    </div>
								    <div class="col-lg-6">
								    	<label><b>Número de identificación:</b></label>
								    	<?php echo Form::text('dlscs_numero_identificacion', null, ['id'=>'dlscs_numero_identificacion', 'class'=>'form-control inp-udi']); ?>

								    </div>
								</div>

								<div class="form-group row">
								   	<div class="col-lg-6">
								    	<label><b>Sexo:</b></label>
								    	<div class="radio-inline pt-2">
									        <label class="radio radio-rounded">
									            <input type="radio" name="dlscs_sexo" id="dlscs_sexo_1" value="1" />
									            <span></span>
									            Hombre
									        </label>
									        <label class="radio radio-rounded">
									            <input type="radio" name="dlscs_sexo" id="dlscs_sexo_2" value="2" />
									            <span></span>
									            Mujer
									        </label>								        
									    </div>
								    </div>
								</div>

							</div>
							<div class="tab-pane fade" id="tbdom" role="tabpanel" aria-labelledby="tab-2">
								
								<h5 class="mb-1 mt-4 tx-gray-700">Domicilio</h5><hr />


								<div class="form-group row">
								   	<div class="col-lg-6">
								    	<label><b>Estado:</b></label>
								    	<?php echo Form::select('dlscs_id_estado_particular', $estados, null, ['id' => 'dlscs_id_estado_particular', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi', 'onchange'=>'cargar_municipios_general(this, $("#dlscs_id_municipio_particular"));']); ?>	
								    </div>
								    <div class="col-lg-6">
								    	<label><b>Municipio:</b></label>
								    	<?php echo Form::select('dlscs_id_municipio_particular', $municipios_p, null, ['id' => 'dlscs_id_municipio_particular', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi']); ?>		
								    </div>
								</div>

								<div class="form-group row">
								   	<div class="col-lg-6">
								    	<label><b>Ciudad:</b></label>
								    	<?php echo Form::text('dlscs_ciudad_particular', null, ['id'=>'dlscs_ciudad_particular', 'class'=>'form-control inp-udi']); ?>	
								    </div>
								    <div class="col-lg-6">
								    	<label><b>Calle:</b></label>
								    	<?php echo Form::text('dlscs_calle_particular', null, ['id'=>'dlscs_calle_particular', 'class'=>'form-control inp-udi']); ?>		
								    </div>
								</div>

								<div class="form-group row">
								   	<div class="col-lg-6">
								    	<label><b>Núm. exterior:</b></label>
								    	<?php echo Form::text('dlscs_ext_particular', null, ['id'=>'dlscs_ext_particular', 'class'=>'form-control inp-udi']); ?>	
								    </div>
								    <div class="col-lg-6">
								    	<label><b>Núm. interior:</b></label>
								    	<?php echo Form::text('dlscs_int_particular', null, ['id'=>'dlscs_int_particular', 'class'=>'form-control inp-udi']); ?>

								    </div>
								</div>

								<div class="form-group row">
								   	<div class="col-lg-6">
								    	<label><b>Colonia:</b></label>
								    	<?php echo Form::text('dlscs_colonia_particular', null, ['id'=>'dlscs_colonia_particular', 'class'=>'form-control inp-udi']); ?>	
								    </div>
								    <div class="col-lg-6">
								    	<label><b>CP:</b></label>
								    	<?php echo Form::text('dlscs_cp_particular', null, ['id'=>'dlscs_cp_particular', 'class'=>'form-control inp-udi']); ?>

								    </div>
								</div>

								<div class="form-group row">
								   	<div class="col-lg-6">
								    	<label><b>Referencias:</b></label>
								    	<?php echo Form::text('dlscs_referencias_particular', null, ['id'=>'dlscs_referencias_particular', 'class'=>'form-control inp-udi']); ?>	
								    </div>
								</div>

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

		<!-- Fin Modal Socios Legales --> <?php /**PATH C:\AppServ\apps\sircse\resources\views/backend/mis-tramites/form-socios.blade.php ENDPATH**/ ?>