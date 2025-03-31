   <form id="frmRecoverCapital" name="frmRecoverCapital">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="hdIdTramiteCapital" id="hdIdTramiteCapital" value="<?php echo e($datos->id); ?>">   
    </form>
	<form id="frmRecuperar" name="frmRecuperar">
        <?php echo csrf_field(); ?>
		<input type="hidden" name="txtidTramite" id="txtidTramite" value="<?php echo e($datos->id); ?>">
	</form>

	

        <div class="note note-warning m-b-15">
    <div class="note-icon"><i class="fa fa-lightbulb"></i></div>
    <div class="note-content">
      <h4><b>¡ Atenci&oacute;n !</b></h4>
      <p>
        Toda informaci&oacute;n que sea recuperada, debera usted verificar que sea la correcta. Una vez guardada no se podra eliminar.
      </p>
    </div>

  </div>

		<div class="panel panel-default">
	        <div class="panel-heading ">  
				<div class="col-md-8 "><h4 class="modal-title">Capital contable</h4></div>
				<div class="col-md-4 " style="text-align: right"> 
					
					
				</div>       
	        </div>
	                   
	        <div class="panel-body" style="background: #f9f9f9;"> 
	            <div class="row">
	                <div class="col-md-6">
						<div class="form-group row m-b-15">
	                        <label for="dfcc_capital" class="col-form-label col-md-3">Capital contable*</label>
	                        <div class="col-md-9">
	                            
	                            <input type= "text" id= "dfcc_capital" name = "dfcc_capital" class = "form-control m-b-5">
								<div id="el-dfcc_capital" class="invalid-feedback lbl-error"></div>											
	                        </div>
	                    </div>
						<div class="form-group row m-b-15">
	                        <label for="dfcc_fecha_elaboracion" class="col-form-label col-md-3">
	                        	Fecha de elaboración de estados financieros auditados*
	                    	</label>
	                        <div class="col-md-9">							
	                            <div class="input-group date">
	                                
	                                <input type= "date" id= "dfcc_fecha_elaboracion" name = "dfcc_fecha_elaboracion" class = "form-control m-b-5">
									
	                            </div>							
	                            <div id="el-dfcc_fecha_elaboracion" class="invalid-feedback lbl-error"></div>
	                        </div>
	                    </div>
	                    
						<div class="form-group row m-b-15">
	                        <label for="dfcc_fecha_declaracion" class="col-form-label col-md-3">
	                        	Fecha de declaración*
	                        </label>
	                        <div class="col-md-9">							
	                            <div class="input-group date">
	                                
	                                <input type= "date" id= "dfcc_fecha_declaracion" name = "dfcc_fecha_declaracion" class = "form-control m-b-5">
	                                
	                                
									
	                                <div id="el-dfcc_fecha_declaracion" class="invalid-feedback lbl-error"></div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                 
	                <div class="col-md-6 ">
						<div class="form-group row m-b-15">
	                        <label for="dfcc_observaciones" class="col-form-label col-md-3">Observaciones</label>
	                        <div class="col-md-9">							
	                            <div class="input-group date">
	                                
	                                <textarea rows= "5" id= "dfcc_observaciones" name = "dfcc_observaciones" class = "form-control m-b-5"></textarea>
	                                
	                                
									
	                            </div>							
	                            <div id="el-dfcc_observaciones" class="invalid-feedback lbl-error"></div>
	                        </div>
	                    </div>
					</div>
				</div>
			</div>
	    </div>          
    







    

	








	

	    <div class="panel panel-default">
	        <div class="panel-heading ">  
				<div class="col-md-10 "><h4 class="modal-title">Estado financiero </h4></div>
				<div class="col-md-2 " style="text-align: right">  
					
				</div>       
	        </div>
	                   
	        <div class="panel-body" style="background: #f9f9f9;"> 
				<div class="row">
					<div class="col-md-6 ">
						<legend>Actual</legend>
						

						<div class="form-group row m-b-15">
							<label for="dfef_utilidad_perdida_actual" class="col-form-label col-md-3">Utilidad o pérdida del ejercicio</label>
							<div class="col-md-9">							
								<div class="input-group date">
									
									<input type= "text" id= "dfef_utilidad_perdida_actual" name = "dfef_utilidad_perdida_actual" class = "form-control m-b-5">
									
									
									<div class="input-group-addon">
										<i class="fa fa-dollar-sign"></i>
									</div>
									<div id="el-dfef_utilidad_perdida_actual" class="invalid-feedback lbl-error"></div>
								</div>																
							</div>
						</div>

						<div class="form-group row m-b-15">
							<label for="dfef_balance_gral_actual" class="col-form-label col-md-3">Capital contable balance general</label>
							<div class="col-md-9">							
								<div class="input-group date">
									
									<input type= "text" id= "dfef_balance_gral_actual" name = "dfef_balance_gral_actual" class = "form-control m-b-5">
									
									
									<div class="input-group-addon">
										<i class="fa fa-dollar-sign"></i>
									</div>
									<div id="el-dfef_balance_gral_actual" class="invalid-feedback lbl-error"></div>
								</div>																
							</div>
						</div>


						<div class="form-group row m-b-15">
							<label for="dfef_razon_liquidez_actual" class="col-form-label col-md-3">Razón de liquidez</label>
							<div class="col-md-9">							
								<div class="input-group date">
									<input type= "text" id= "dfef_razon_liquidez_actual" name = "dfef_razon_liquidez_actual" class = "form-control m-b-5">
									
									
									
									<div class="input-group-addon">
										<i class="fa fa-percent"></i>
									</div>
									<div id="el-dfef_razon_liquidez_actual" class="invalid-feedback lbl-error"></div>
								</div>																
							</div>
						</div>	

						<div class="form-group row m-b-15">
							<label for="dfef_razon_endeudamiento_actual" class="col-form-label col-md-3">Razón de endeudamiento</label>
							<div class="col-md-9">							
								<div class="input-group date">
									
									<input type= "text" id= "dfef_razon_endeudamiento_actual" name = "dfef_razon_endeudamiento_actual" class = "form-control m-b-5">
									
									
									<div class="input-group-addon">
										<i class="fa fa-percent"></i>
									</div>
									<div id="el-dfef_razon_endeudamiento_actual" class="invalid-feedback lbl-error"></div>
								</div>																
							</div>
						</div>

						<div class="form-group row m-b-15">
							<label for="dfef_razon_rentabilidad_actual" class="col-form-label col-md-3">Razón de rentabilidad</label>
							<div class="col-md-9">							
								<div class="input-group date">
									<input type= "text" id= "dfef_razon_rentabilidad_actual" name = "dfef_razon_rentabilidad_actual" class = "form-control m-b-5">
									
									
									
									<div class="input-group-addon">
										<i class="fa fa-percent"></i>
									</div>
									<div id="el-dfef_razon_rentabilidad_actual" class="invalid-feedback lbl-error"></div>
								</div>																
							</div>
						</div>															
					
						<div class="form-group row m-b-15">
							<label for="dfef_capital_neto_actual" class="col-form-label col-md-3">Capital neto de trabajo</label>
							<div class="col-md-9">							
								<div class="input-group date">
									<input type= "text" id= "dfef_capital_neto_actual" name = "dfef_capital_neto_actual" class = "form-control m-b-5">
									
									
									
									<div class="input-group-addon">
										<i class="fa fa-dollar-sign"></i>
									</div>
									<div id="el-dfef_capital_neto_actual" class="invalid-feedback lbl-error"></div>
								</div>																
							</div>
						</div>
					</div>

					
	        </div>        
	    </div>
    
	







	 
	</div>



<?php /**PATH C:\AppServ\apps\sircse\resources\views/backend/mis-tramites/tabs-financiera.blade.php ENDPATH**/ ?>