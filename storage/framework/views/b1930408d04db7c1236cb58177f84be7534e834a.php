				
				<input type="hidden" name="_acordionOne" id="_acordionOne">
				<input type="hidden" name="_acordionTwo" id="_acordionTwo">
				<input type="hidden" name="_acordionThree" id="_acordionThree">
				<input type="hidden" name="_tipoPersona" id="_tipoPersona" value="<?php echo e($datos->id_tipo_persona); ?>">

				<div aria-multiselectable="true" class="accordion" id="accordionLegal" role="tablist">
					<div class="card">
						<div class="card-header" id="headingDatosGenerales" role="tab">
							<a aria-controls="collapseDatosGeneral" aria-expanded="true" data-toggle="collapse" href="#collapseDatosGeneral" style="background-color: #333333; color: #fff;" id="datosGenerales">Datos Generales</a>
						</div>
						<div aria-labelledby="headingDatosGenerales" class="collapse show" data-parent="#accordionLegal" id="collapseDatosGeneral" role="tabpanel">
							<div class="card-body">
								<!-- Begin accordion DATOS GENERALES -->

								<?php echo Form::open([
										'route' => 'tramites-area-legal.store-datos-legales',
										'method' => 'POST',
										'files' => true,
										'id' => 'dlg_frm',
										'enctype'=>'multipart/form-data',
										'accept-charset'=>'UTF-8'
									], 
									['role' => 'form']); ?>

					        	
					        	<div class="row">
					        		<div class="col-md-12 form-group text-right">
										<button type="submit" class="btn ripple btn-outline-success">
											<i class="fa fa-save"></i> <b>Guardar datos generales</b>
										</button>
									</div>
								</div>

					    		<?php echo Form::hidden('dlg_id', 0, ['id'=>'dlg_id', 'class'=>'form-control input-sm gui-input']); ?>

					    		<?php echo Form::hidden('id', 0, ['id'=>'id', 'class'=>'form-control input-sm gui-input']); ?>

					            <div class="row" >
					                <div class="col-md-6">
										<div class="form-group row ">
											<label for="dlg_imss" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-6">Número de registro patronal IMSS*</label>
											<div class="col-md-6">
												<?php echo Form::text('dlg_imss', null, ['id'=>'dlg_imss', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlg_imss" class="invalid-feedback lbl-error"></div>
											</div>
										</div>	
										<div class="form-group row">
											<label for="dlg_boleta_pago" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-6">Folio de boleta de pago*</label>
											<div class="col-md-6">
												<?php echo Form::text('dlg_boleta_pago', null, ['id'=>'dlg_boleta_pago', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlg_boleta_pago" class="invalid-feedback lbl-error"></div>
											</div>
										</div>	
										<div class="form-group row">
											<label for="dlg_fecha_pago" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-6">Folio de Fecha de pago*</label>
											<div class="col-md-6">							
												<div class="input-group date">
													<?php echo Form::text('dlg_fecha_pago', null, ['id'=>'dlg_fecha_pago', 'placeholder'=>'',  'class'=>'form-control input-sm fc-datepicker']); ?>

													<div id="el-dlg_fecha_pago" class="invalid-feedback lbl-error"></div>
												</div>
											</div>
										</div>					
										<h5 class="mb-1 mt-3 tx-gray-700">Datos del RFC</h5><hr />
										<div class="form-group row">
											<label for="dlg_fecha_inicio" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-6">Fecha de inicio*</label>
											<div class="col-md-6">							
												<div class="input-group date">
													<?php echo Form::text('dlg_fecha_inicio', null, ['id'=>'dlg_fecha_inicio', 'placeholder'=>'',  'class'=>'form-control input-sm fc-datepicker']); ?>

												</div>							
												<div id="el-dlg_fecha_inicio" class="invalid-feedback lbl-error"></div>											
											</div>
										</div>
										<div class="form-group row">
											<label for="dlg_fecha_inscripcion" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-6">Fecha de inscripción*</label>
											<div class="col-md-6">							
												<div class="input-group date">
													<?php echo Form::text('dlg_fecha_inscripcion', null, ['id'=>'dlg_fecha_inscripcion', 'placeholder'=>'',  'class'=>'form-control input-sm fc-datepicker']); ?>

												</div>							
												<div id="el-dlg_fecha_inscripcion" class="invalid-feedback lbl-error"></div>
											</div>
										</div>
										<div class="form-group row">
											<label for="dlg_actividad" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-6">Actividad preponderante*</label>
											<div class="col-md-6">
												<?php echo Form::text('dlg_actividad', null, ['id'=>'dlg_actividad', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlg_actividad" class="invalid-feedback lbl-error"></div>											
											</div>
										</div>
									</div>
									<div class="col-md-6">  
										<div class="form-group row ">
											<label for="dlg_rec" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-6">Fecha de registro estatal de contribuyentes*</label>
											<div class="col-md-6">							
												<div class="input-group date">
													<?php echo Form::text('dlg_rec', null, ['id'=>'dlg_rec', 'placeholder'=>'',  'class'=>'form-control input-sm fc-datepicker']); ?>

												</div>							
												<div id="el-dlg_rec" class="invalid-feedback lbl-error"></div>											
											</div>
										</div>	
										<div class="form-group row ">
											<label for="dlg_num_constancia" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-6">Núm. de constancia de no adeudos fiscales*</label>
											<div class="col-md-6">
												<?php echo Form::text('dlg_num_constancia', null, ['id'=>'dlg_num_constancia', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlg_num_constancia" class="invalid-feedback lbl-error"></div>											
											</div>
										</div>
										<div class="form-group row ">
											<label for="dlg_num_control" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-6">Núm. de control*</label>
											<div class="col-md-6">
												<?php echo Form::text('dlg_num_control', null, ['id'=>'dlg_num_control', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlg_num_control" class="invalid-feedback lbl-error"></div>											
											</div>
										</div>	
										<div class="form-group row ">
											<label for="dlg_vigencia_de" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-6">Vigencia de inicio*</label>
											<div class="col-md-6">							
												<div class="input-group date">
													<?php echo Form::text('dlg_vigencia_de', null, ['id'=>'dlg_vigencia_de', 'placeholder'=>'',  'class'=>'form-control input-sm fc-datepicker']); ?>

												</div>							
												<div id="el-dlg_vigencia_de" class="invalid-feedback lbl-error"></div>											
											</div>
										</div>
										<div class="form-group row ">
											<label for="dlg_vigencia_al" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-6">Vigencia de término*</label>
											<div class="col-md-6">							
												<div class="input-group date">
													<?php echo Form::text('dlg_vigencia_al', null, ['id'=>'dlg_vigencia_al', 'placeholder'=>'',  'class'=>'form-control input-sm fc-datepicker']); ?>

												</div>							
												<div id="el-dlg_vigencia_al" class="invalid-feedback lbl-error"></div>											
											</div>
										</div>
									</div>
					            </div>
								<?php echo Form::close(); ?>	


								<!-- End accordion -->
							</div>
						</div>
					</div>
					<?php if( $datos->id_tipo_persona != 1): ?>
					<div class="card">
						<div class="card-header" id="headingTwo" role="tab">
							<a aria-controls="collapseTwo" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapseTwo" style="background-color: #333333; color: #fff;" id="actaConstitutiva">
								<?php if( $id_tipo_tramite == 3 ): ?> Modificaciones al <?php endif; ?> Acta Constitutiva
							</a>
						</div>
						<div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionLegal" id="collapseTwo" role="tabpanel">
							<div class="card-body">
								<!-- Begin accordion DATOS GENERALES -->
								<div class="row">
					        		<div class="col-md-12 form-group text-right">
										<?php if( $id_tipo_tramite != 1 ): ?>
										<button type="button" class="btn ripple btn-outline-info" id="btnRecuperarActaC" onclick="RecoverActaConstitutiva()">
											<i class="fas fa-history"></i> Recuperar
										</button> 
										<?php endif; ?>  
										<button type="button" class="btn ripple btn-outline-success" onclick="AddActaConstitutiva()">
											<i class="fa fa-save"></i> Guardar <?php if( $id_tipo_tramite == 3 ): ?> Modificaciones al <?php endif; ?> Acta Constitutiva
										</button>
									</div>
								</div>

								<form id="frmAddActaConstitutiva" name="frmAddActaConstitutiva" enctype="multipart/form-data" accept-charset="UTF-8">
									<?php echo csrf_field(); ?>       
									<?php echo Form::hidden('dlac_id', 0,['id'=>'dlac_id', 'class'=>'form-control input-sm gui-input']); ?>    
									<?php echo Form::hidden('dlac_id_m', 0,['id'=>'dlac_id_m', 'class'=>'form-control input-sm gui-input']); ?>

									<?php echo Form::hidden('dlac_id_tramite', $datos->id,['id'=>'dlac_id_tramite', 'class'=>'form-control input-sm gui-input']); ?>

									<div class="row">
										<div class="col-md-6 ">
											<h5 class="mb-1 mt-3 tx-gray-700">Acta</h5><hr />
											<div class="form-group row ">
												<label for="dlac_num_escritura" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Núm. de escritura*</label>
												<div class="col-md-8">
													<?php echo Form::text('dlac_num_escritura', null, ['id'=>'dlac_num_escritura', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

													<div id="el-dlac_num_escritura" class="invalid-feedback lbl-error"></div>                     
												</div>
											</div>
											<div class="form-group row ">
												<label for="dlac_fecha_escritura" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Fecha de escritura*</label>
												<div class="col-md-8">              
													<div class="input-group date">
														<?php echo Form::text('dlac_fecha_escritura', null, ['id'=>'dlac_fecha_escritura', 'placeholder'=>'',  'class'=>'form-control input-sm fc-datepicker']); ?>

														<div id="el-dlac_fecha_escritura" class="invalid-feedback lbl-error"></div>
													</div>
												</div>
											</div>  
											<div class="form-group row ">
												<label for="dlac_notario_nombre" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Nombre del notario*</label>
												<div class="col-md-8">
													<?php echo Form::text('dlac_notario_nombre', null, ['id'=>'dlac_notario_nombre', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

													<div id="el-dlac_notario_nombre" class="invalid-feedback lbl-error"></div>                      
												</div>
											</div>
											<div class="form-group row ">
												<label for="dlac_notario_numero" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Número de notario*</label>
												<div class="col-md-8">
													<?php echo Form::text('dlac_notario_numero', null, ['id'=>'dlac_notario_numero', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

													<div id="el-dlac_notario_numero" class="invalid-feedback lbl-error"></div>                      
												</div>
											</div>        
											<div class="form-group row ">
												<label for="dlac_id_estado" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Estado*</label>
												<div class="col-md-8">
													<?php echo Form::select('dlac_id_estado', $estados, null, ['id' => 'dlac_id_estado', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control input-sm']); ?>      
													<div id="el-dlac_id_estado" class="invalid-feedback lbl-error"></div>     
												</div>
											</div>
										</div>
										<div class="col-md-6 "> 
											<h5 class="mb-1 mt-3 tx-gray-700">Registro público de la propiedad</h5><hr />
											<div class="form-group row ">
												<label for="dlac_num_registro_publico" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Número de registro público*</label>
												<div class="col-md-8">
													<?php echo Form::text('dlac_num_registro_publico', null, ['id'=>'dlac_num_registro_publico', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

													<div id="el-dlac_num_registro_publico" class="invalid-feedback lbl-error"></div>                      
												</div>
											</div>
											<div class="form-group row ">
												<label for="dlac_seccion" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Sección*</label>
												<div class="col-md-8">
													<?php echo Form::text('dlac_seccion', null, ['id'=>'dlac_seccion', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

													<div id="el-dlac_seccion" class="invalid-feedback lbl-error"></div>                     
												</div>
											</div>
											<div class="form-group row ">
												<label for="dlac_ciudad" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Ciudad*</label>
												<div class="col-md-8">
													<?php echo Form::text('dlac_ciudad', null, ['id'=>'dlac_ciudad', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

													<div id="el-dlac_ciudad" class="invalid-feedback lbl-error"></div>                      
												</div>
											</div>
											<div class="form-group row ">
												<label for="dlac_fecha_registro_publico" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Fecha de registro público*</label>
												<div class="col-md-8">
													<div class="input-group date">
														<?php echo Form::text('dlac_fecha_registro_publico', null, ['id'=>'dlac_fecha_registro_publico', 'placeholder'=>'',  'class'=>'form-control input-sm fc-datepicker']); ?>

														<div id="el-dlac_fecha_registro_publico" class="invalid-feedback lbl-error"></div>  
													</div>
												</div>
											</div>  
											<div class="form-group row ">
												<label for="dlac_id_estado_registro" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Estado*</label>
												<div class="col-md-8">
													<?php echo Form::select('dlac_id_estado_registro', $estados, null, ['id' => 'dlac_id_estado_registro', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control input-sm']); ?>      
													<div id="el-dlac_id_estado_registro" class="invalid-feedback lbl-error"></div>      
												</div>
											</div>
										</div>
									</div>
									<hr /> 

									<div class="row">
										<div class="col-md-6 ">
											<h5 class="mb-1 mt-3 tx-gray-700">Modificaciones  al Acta</h5><hr />
											<div class="form-group row ">
												<label for="dlac_num_escritura_m" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Núm. de escritura*</label>
												<div class="col-md-8">
													<?php echo Form::text('dlac_num_escritura_m', null, ['id'=>'dlac_num_escritura_m', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

													<div id="el-dlac_num_escritura_m" class="invalid-feedback lbl-error"></div>                     
												</div>
											</div>
											<div class="form-group row ">
												<label for="dlac_fecha_escritura_m" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Fecha de escritura*</label>
												<div class="col-md-8">              
													<div class="input-group date">
														<?php echo Form::text('dlac_fecha_escritura_m', null, ['id'=>'dlac_fecha_escritura_m', 'placeholder'=>'',  'class'=>'form-control input-sm fc-datepicker']); ?>

														<div id="el-dlac_fecha_escritura_m" class="invalid-feedback lbl-error"></div>
													</div>
												</div>
											</div>  
											<div class="form-group row ">
												<label for="dlac_notario_nombre_m" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Nombre del notario*</label>
												<div class="col-md-8">
													<?php echo Form::text('dlac_notario_nombre_m', null, ['id'=>'dlac_notario_nombre_m', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

													<div id="el-dlac_notario_nombre_m" class="invalid-feedback lbl-error"></div>                      
												</div>
											</div>
											<div class="form-group row ">
												<label for="dlac_notario_numero_m" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Número de notario*</label>
												<div class="col-md-8">
													<?php echo Form::text('dlac_notario_numero_m', null, ['id'=>'dlac_notario_numero_m', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

													<div id="el-dlac_notario_numero_m" class="invalid-feedback lbl-error"></div>                      
												</div>
											</div>        
											<div class="form-group row ">
												<label for="dlac_id_estado_m" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Estado*</label>
												<div class="col-md-8">
													<?php echo Form::select('dlac_id_estado_m', $estados_m, null, ['id' => 'dlac_id_estado_m', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control input-sm']); ?>      
													<div id="el-dlac_id_estado_m" class="invalid-feedback lbl-error"></div>     
												</div>
											</div>
										</div>
										<div class="col-md-6 "> 
											<h5 class="mb-1 mt-3 tx-gray-700">Registro público de la propiedad</h5><hr />
											<div class="form-group row ">
												<label for="dlac_num_registro_publico_m" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Número de registro público*</label>
												<div class="col-md-8">
													<?php echo Form::text('dlac_num_registro_publico_m', null, ['id'=>'dlac_num_registro_publico_m', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

													<div id="el-dlac_num_registro_publico_m" class="invalid-feedback lbl-error"></div>                      
												</div>
											</div>
											<div class="form-group row ">
												<label for="dlac_seccion_m" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Sección*</label>
												<div class="col-md-8">
													<?php echo Form::text('dlac_seccion_m', null, ['id'=>'dlac_seccion_m', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

													<div id="el-dlac_seccion_m" class="invalid-feedback lbl-error"></div>                     
												</div>
											</div>
											<div class="form-group row ">
												<label for="dlac_ciudad_m" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Ciudad*</label>
												<div class="col-md-8">
													<?php echo Form::text('dlac_ciudad_m', null, ['id'=>'dlac_ciudad_m', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

													<div id="el-dlac_ciudad_m" class="invalid-feedback lbl-error"></div>                      
												</div>
											</div>
											<div class="form-group row ">
												<label for="dlac_fecha_registro_publico_m" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Fecha de registro público*</label>
												<div class="col-md-8">
													<div class="input-group date">
														<?php echo Form::text('dlac_fecha_registro_publico_m', null, ['id'=>'dlac_fecha_registro_publico_m', 'placeholder'=>'',  'class'=>'form-control input-sm fc-datepicker']); ?>

														<div id="el-dlac_fecha_registro_publico_m" class="invalid-feedback lbl-error"></div>  
													</div>
												</div>
											</div>  
											<div class="form-group row ">
												<label for="dlac_id_estado_registro_m" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Estado*</label>
												<div class="col-md-8">
													<?php echo Form::select('dlac_id_estado_registro_m', $estados_m, null, ['id' => 'dlac_id_estado_registro_m', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control input-sm']); ?>      
													<div id="el-dlac_id_estado_registro_m" class="invalid-feedback lbl-error"></div>      
												</div>
											</div>
										</div>
									</div>
								</form>

								<!-- End accordion -->
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingThree" role="tab">
							<a aria-controls="collapseThree" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapseThree" style="background-color: #333333; color: #fff;" id="datosRepresentanteLegal">Representante Legal</a>
						</div>
						<div aria-labelledby="headingThree" class="collapse" data-parent="#accordionLegal" id="collapseThree" role="tabpanel">
							<div class="card-body">
								<!-- Begin accordion DATOS GENERALES -->
							<?php echo Form::open([
									'route'=>'tramites-area-legal.store-representante-legal',
									'method'=>'POST',
									'files'=>true,
									'id'=>'dlrepl_frm',
									'enctype'=>'multipart/form-data',
									'accept-charset'=>'UTF-8'
									],
									['role'=>'form']); ?>


								<?php echo Form::hidden('dlrepl_id', 0,['id'=>'dlrepl_id']); ?>

								<?php echo Form::hidden('dlrepl_id_tramite', $datos->id,['id'=>'dlrepl_id_tramite']); ?>

								<?php echo Form::hidden('dlrepl_id_d_personal', 0,['id'=>'dlrepl_id_d_personal']); ?>

								<?php echo Form::hidden('dlrepl_id_d_domicilio', 0,['id'=>'dlrepl_id_d_domicilio']); ?>

						     	

								<div class="row">
					        		<div class="col-md-12 form-group text-right">
										<button type="submit" class="btn ripple btn-outline-success">
											<i class="fa fa-save"></i> <b>Guardar datos representante legal</b>
										</button>
									</div>
								</div>
					  
								<div class="row">
									<div class="col-md-6 ">
										<h5 class="mb-1 mt-3 tx-gray-700">Generales</h5><hr />
										<div class="form-group row">
											<label for="dlrepl_nombre" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Nombre*</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_nombre', null, ['id'=>'dlrepl_nombre', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>				
												<div id="el-dlrepl_nombre" class="invalid-feedback lbl-error"></div>
											</div>
										</div>
										<div class="form-group row">
											<label for="dlrepl_ap_paterno" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">A. paterno*</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_ap_paterno', null, ['id'=>'dlrepl_ap_paterno', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>				
												<div id="el-dlrepl_ap_paterno" class="invalid-feedback lbl-error"></div>
											</div>
										</div>
										<div class="form-group row">
											<label for="dlrepl_ap_materno" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">A. materno*</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_ap_materno', null, ['id'=>'dlrepl_ap_materno', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>				
												<div id="el-dlrepl_ap_materno" class="invalid-feedback lbl-error"></div>
											</div>
										</div>
										<div class="form-group row">
											<label for="dlrepl_curp" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Curp*</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_curp', null, ['id'=>'dlrepl_curp', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>			
												<div id="el-dlrepl_curp" class="invalid-feedback lbl-error"></div>
											</div>
										</div>
										<div class="form-group row">
											<label for="dlrepl_rfc" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">R.F.C.*</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_rfc', null, ['id'=>'dlrepl_rfc', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_rfc" class="invalid-feedback lbl-error"></div>
											</div>
										</div>
										<div class="form-group row">
											<label for="dlrepl_id_nacionalidad" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Nacionalidad*</label>
											<div class="col-md-8">
												<?php echo Form::select('dlrepl_id_nacionalidad', $nacionalidades, null, ['id' => 'dlrepl_id_nacionalidad', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control input-sm']); ?>			
												<div id="el-dlrepl_id_nacionalidad" class="invalid-feedback lbl-error"></div>
											</div>
										</div>
										<div class="form-group row">
											<label for="dlrepl_telefono" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Teléfono*</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_telefono', null, ['id'=>'dlrepl_telefono', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_telefono" class="invalid-feedback lbl-error"></div>
											</div>
										</div>
										<div class="form-group row">
											<label for="dlrepl_correo_electronico" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Correo electrónico*</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_correo_electronico', null, ['id'=>'dlrepl_correo_electronico', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_correo_electronico" class="invalid-feedback lbl-error"></div>
												<small class="f-s-12 text-grey-darker">Nota: Este campo es importante por que a este correo se enviaran notificaciones del sistema. </small>				
											</div>
										</div>
										<div class="form-group row">
											<label for="dlrepl_id_tipo_identificacion" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Tipo de identificación*</label>
											<div class="col-md-8">
												<?php echo Form::select('dlrepl_id_tipo_identificacion', $tipo_identificaciones, null, ['id' => 'dlrepl_id_tipo_identificacion', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control input-sm']); ?>			
												<div id="el-dlrepl_id_tipo_identificacion" class="invalid-feedback lbl-error"></div>			
											</div>
										</div>	
										<div class="form-group row">
											<label for="dlrepl_numero_identificacion" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Número de identificación*</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_numero_identificacion', null, ['id'=>'dlrepl_numero_identificacion', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_numero_identificacion" class="invalid-feedback lbl-error"></div>			
											</div>
										</div>	
										<div class="form-group row ">
											<label class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Sexo*</label>
											<div class="col-md-8">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="dlrepl_sexo" id="dlrepl_sexo_1" value="1" checked>
													<label class="form-check-label" for="dlrepl_sexo_1">Hombre</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="dlrepl_sexo" id="dlrepl_sexo_2" value="2">
													<label class="form-check-label" for="dlrepl_sexo_2">Mujer</label>
												</div>
											</div>
										</div>
										<div class="form-group row ">
											<label for="dlrepl_id_tipo_rep_legal" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Tipo de representante legal*</label>
											<div class="col-md-8">
												<?php echo Form::select('dlrepl_id_tipo_rep_legal', $tipos_rep_legal, null, ['id' => 'dlrepl_id_tipo_rep_legal', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control input-sm']); ?>			
												<div id="el-dlrepl_id_tipo_rep_legal" class="invalid-feedback lbl-error"></div>
											</div>
										</div>	
										
										<h5 class="mb-1 mt-3 tx-gray-700">Registro público de la propiedad</h5><hr />
										<div class="form-group row ">
											<label for="dlrepl_num_registro_publico" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Número de registro público*</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_num_registro_publico', null, ['id'=>'dlrepl_num_registro_publico', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_num_registro_publico" class="invalid-feedback lbl-error"></div>											
											</div>
										</div>
										<div class="form-group row ">
											<label for="dlrepl_seccion" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Sección*</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_seccion', null, ['id'=>'dlrepl_seccion', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_seccion" class="invalid-feedback lbl-error"></div>											
											</div>
										</div>
										<div class="form-group row ">
											<label for="dlrepl_ciudad" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Ciudad*</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_ciudad', null, ['id'=>'dlrepl_ciudad', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_ciudad" class="invalid-feedback lbl-error"></div>											
											</div>
										</div>
										<div class="form-group row ">
											<label for="dlrepl_fecha_registro_publico" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Fecha de registro público*</label>
											<div class="col-md-8">							
												<div class="input-group date">
													<?php echo Form::text('dlrepl_fecha_registro_publico', null, ['id'=>'dlrepl_fecha_registro_publico', 'placeholder'=>'',  'class'=>'form-control input-sm fc-datepicker']); ?>

													<div id="el-dlrepl_fecha_registro_publico" class="invalid-feedback lbl-error"></div>	
												</div>																	
											</div>
										</div>	
										<div class="form-group row ">
											<label for="dlrepl_id_estado_registro" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Estado*</label>
											<div class="col-md-8">
												<?php echo Form::select('dlrepl_id_estado_registro', $estados, null, ['id' => 'dlrepl_id_estado_registro', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control input-sm']); ?>			
												<div id="el-dlrepl_id_estado_registro" class="invalid-feedback lbl-error"></div>			
											</div>
										</div>
									</div>

									<div class="col-md-6 ">  
										<h5 class="mb-1 mt-3 tx-gray-700">Domicilio</h5><hr />
										<div class="form-group row ">
											<label for="dlrepl_id_estado_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Estado*</label>
											<div class="col-md-8">
												<?php echo Form::select('dlrepl_id_estado_particular', $estados, null, ['id' => 'dlrepl_id_estado_particular', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control input-sm', 'onchange'=>'cargar_municipios_general(this, $("#dlrepl_id_municipio_particular"));']); ?>			
												<div id="el-dlrepl_id_estado_particular" class="invalid-feedback lbl-error"></div>			
											</div>
										</div>
										<div class="form-group row ">
											<label for="dlrepl_id_municipio_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Municipio*</label>
											<div class="col-md-8">
												<?php echo Form::select('dlrepl_id_municipio_particular', $municipios_p, null, ['id' => 'dlrepl_id_municipio_particular', 'style'=>'width: 100%;', 'class' => ' form-control input-sm']); ?>			
												<div id="el-dlrepl_id_municipio_particular" class="invalid-feedback lbl-error"></div>			
											</div>
										</div>
										<div class="form-group row ">
											<label for="dlrepl_ciudad_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Ciudad</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_ciudad_particular', null, ['id'=>'dlrepl_ciudad_particular', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_ciudad_particular" class="invalid-feedback lbl-error"></div>			
											</div>
										</div>							
										<div class="form-group row ">
											<label for="dlrepl_calle_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Calle*</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_calle_particular', null, ['id'=>'dlrepl_calle_particular', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_calle_particular" class="invalid-feedback lbl-error"></div>			
											</div>
										</div>
										<div class="form-group row ">
											<label for="dlrepl_ext_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Núm. exterior*</label>
											<div class="col-md-3">
												<?php echo Form::text('dlrepl_ext_particular', null, ['id'=>'dlrepl_ext_particular', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_ext_particular" class="invalid-feedback lbl-error"></div>			
											</div>

											<label for="dlrepl_int_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Núm. interior*</label>
											<div class="col-md-3">
												<?php echo Form::text('dlrepl_int_particular', null, ['id'=>'dlrepl_int_particular', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_int_particular" class="invalid-feedback lbl-error"></div>			
											</div>
										</div>	
										<div class="form-group row ">
											<label for="dlrepl_colonia_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-3">Colonia*</label>
											<div class="col-md-4">
												<?php echo Form::text('dlrepl_colonia_particular', null, ['id'=>'dlrepl_colonia_particular', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_colonia_particular" class="invalid-feedback lbl-error"></div>			
											</div>
											<label for="dlrepl_cp_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-2">C.P.*</label>
											<div class="col-md-3">
												<?php echo Form::text('dlrepl_cp_particular', null, ['id'=>'dlrepl_cp_particular', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_cp_particular" class="invalid-feedback lbl-error"></div>			
											</div>
										</div>	
										<div class="form-group row ">
											<label for="dlrepl_referencias_particular" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Referencias</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_referencias_particular', null, ['id'=>'dlrepl_referencias_particular', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_referencias_particular" class="invalid-feedback lbl-error"></div>			
											</div>
										</div>

										<h5 class="mb-1 mt-3 tx-gray-700">Instrumento legal</h5><hr />
										<div class="form-group row ">
											<label for="dlrepl_num_escritura" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Núm. de escritura*</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_num_escritura', null, ['id'=>'dlrepl_num_escritura', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_num_escritura" class="invalid-feedback lbl-error"></div>											
											</div>
										</div>
										<div class="form-group row ">
											<label for="dlrepl_fecha_escritura" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Fecha de escritura*</label>
											<div class="col-md-8">							
												<div class="input-group date">
													<?php echo Form::text('dlrepl_fecha_escritura', null, ['id'=>'dlrepl_fecha_escritura', 'placeholder'=>'',  'class'=>'form-control input-sm fc-datepicker']); ?>

													<div id="el-dlrepl_fecha_escritura" class="invalid-feedback lbl-error"></div>
												</div>									
											</div>
										</div>	
										<div class="form-group row ">
											<label for="dlrepl_notario_nombre" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Nombre del notario*</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_notario_nombre', null, ['id'=>'dlrepl_notario_nombre', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_notario_nombre" class="invalid-feedback lbl-error"></div>											
											</div>
										</div>
										<div class="form-group row ">
											<label for="dlrepl_notario_numero" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Número de notario*</label>
											<div class="col-md-8">
												<?php echo Form::text('dlrepl_notario_numero', null, ['id'=>'dlrepl_notario_numero', 'placeholder'=>'',  'class'=>'form-control input-sm ']); ?>

												<div id="el-dlrepl_notario_numero" class="invalid-feedback lbl-error"></div>											
											</div>
										</div>				
										<div class="form-group row ">
											<label for="dlrepl_id_estado" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Estado*</label>
											<div class="col-md-8">
												<?php echo Form::select('dlrepl_id_estado', $estados, null, ['id' => 'dlrepl_id_estado', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control input-sm']); ?>			
												<div id="el-dlrepl_id_estado" class="invalid-feedback lbl-error"></div>			
											</div>
										</div>
									</div>
					            </div>

								<?php echo Form::close(); ?>


								<!-- End accordion -->
							</div>
						</div><!-- collapse -->
					</div>
					<?php endif; ?>
				</div><?php /**PATH C:\AppServ\apps\sircse\resources\views/backend/mis-tramites/tabs-legal.blade.php ENDPATH**/ ?>