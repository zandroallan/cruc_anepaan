   <form id="frmRecoverCapital" name="frmRecoverCapital">
      @csrf
      <input type="hidden" name="hdIdTramiteCapital" id="hdIdTramiteCapital" value="{{$datos->id}}">   
    </form>
	<form id="frmRecuperar" name="frmRecuperar">
        @csrf
		<input type="hidden" name="txtidTramite" id="txtidTramite" value="{{ $datos->id }}">
	</form>

	{{-- {!! Form::open(['route' => 'tramites.store-capital-contable', 'method' => 'POST' , 'files' => true, 'id' => 'dfcc_frm', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']) !!} 			
	
		{!! Form::hidden('dfcc_id', 0,['id'=>'dfcc_id', 'class'=>'form-control gui-input']) !!}
		{!! Form::hidden('dfcc_id_tramite', $datos->id,['id'=>'dfcc_id_tramite', 'class'=>'form-control gui-input']) !!} --}}

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
					{{-- @if($tipo_tramite!=1)
			        <button type="button" class="btn btn-indigo" id="btnRecuperarCapital" onclick="RecoverCapital()">
			          <i class="fas fa-history"></i> Recuperar
			        </button> 
			        @endif  --}}
					{{-- {!! Form::button('<i class="fa fa-save"></i> Guardar', ['class' => 'btn btn-primary', 'type' => 'submit', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Guardar']) !!} --}}
				</div>       
	        </div>
	                   
	        <div class="panel-body" style="background: #f9f9f9;"> 
	            <div class="row">
	                <div class="col-md-6">
						<div class="form-group row m-b-15">
	                        <label for="dfcc_capital" class="col-form-label col-md-3">Capital contable*</label>
	                        <div class="col-md-9">
	                            {{-- {!! Form::text('dfcc_capital', null, ['id'=>'dfcc_capital', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!} --}}
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
	                                {{-- {!! Form::text('dfcc_fecha_elaboracion', null, ['id'=>'dfcc_fecha_elaboracion', 'placeholder'=>'',  'class'=>'form-control datepicker']) !!} --}}
	                                <input type= "date" id= "dfcc_fecha_elaboracion" name = "dfcc_fecha_elaboracion" class = "form-control m-b-5">
									{{-- <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div> --}}
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
	                                {{-- {!! Form::text('dfcc_fecha_declaracion', null, ['id'=>'dfcc_fecha_declaracion', 'placeholder'=>'',  'class'=>'form-control datepicker']) !!} --}}
	                                <input type= "date" id= "dfcc_fecha_declaracion" name = "dfcc_fecha_declaracion" class = "form-control m-b-5">
	                                {{-- {!! Form::text('dfcc_fecha_declaracion', null, ['id'=>'dfcc_fecha_declaracion', 'placeholder'=>'',  'class'=>'form-control']) !!} --}}
	                                {{-- {!! Form::text('dfcc_fecha_declaracion', null, ['id'=>'dfcc_fecha_declaracion', 'placeholder'=>'',  'class'=>'form-control']) !!} --}}
									{{-- <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div> --}}
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
	                                {{-- {!! Form::textArea('dfcc_observaciones', null, ['id'=>'dfcc_observaciones', 'placeholder'=>'',  'class'=>'form-control']) !!} --}}
	                                <textarea rows= "5" id= "dfcc_observaciones" name = "dfcc_observaciones" class = "form-control m-b-5"></textarea>
	                                {{-- {!! Form::text('dfcc_observaciones', null, ['id'=>'dfcc_observaciones', 'placeholder'=>'',  'class'=>'form-control']) !!} --}}
	                                {{-- {!! Form::text('dfcc_observaciones', null, ['id'=>'dfcc_observaciones', 'placeholder'=>'',  'class'=>'form-control']) !!} --}}
									{{-- <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div> --}}
	                            </div>							
	                            <div id="el-dfcc_observaciones" class="invalid-feedback lbl-error"></div>
	                        </div>
	                    </div>
					</div>
				</div>
			</div>
	    </div>          
    {{-- {!! Form::close() !!} --}}







    {{-- {!! Form::open(['route' => 'tramites.store-contador-publico', 'method' => 'POST' , 'files' => true, 'id' => 'dfcp_frm', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']) !!} 			
      	
      	{!! Form::hidden('dfcp_id', 0,['id'=>'dfcp_id', 'class'=>'form-control gui-input']) !!}
        {!! Form::hidden('dfcp_id_tramite', $datos->id,['id'=>'dfcp_id_tramite', 'class'=>'form-control gui-input']) !!}
		{!! Form::hidden('dfcp_id_d_personal', 0,['id'=>'dfcp_id_d_personal', 'class'=>'form-control gui-input']) !!}
		{!! Form::hidden('dfcp_domicilio', 0,['id'=>'dfcp_id_d_domicilio', 'class'=>'form-control gui-input']) !!} --}}

	{{-- {!! Form::close() !!}	 --}}








	{{-- {!! Form::open(['route' =>'tramites.store-estado-financiero', 'method' => 'POST' , 'files' => true, 'id' => 'dfef_frm', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']) !!} 			
    
    	{!! Form::hidden('dfef_id', 0,['id'=>'dfef_id', 'class'=>'form-control gui-input']) !!}
   		{!! Form::hidden('dfef_id_tramite', $datos->id,['id'=>'dfef_id_tramite', 'class'=>'form-control gui-input']) !!} --}}

	    <div class="panel panel-default">
	        <div class="panel-heading ">  
				<div class="col-md-10 "><h4 class="modal-title">Estado financiero </h4></div>
				<div class="col-md-2 " style="text-align: right">  
					{{-- {!! Form::button('<i class="fa fa-save"></i> Guardar', ['class' => 'btn btn-primary', 'type' => 'submit', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Guardar']) !!} --}}
				</div>       
	        </div>
	                   
	        <div class="panel-body" style="background: #f9f9f9;"> 
				<div class="row">
					<div class="col-md-6 ">
						<legend>Actual</legend>
						{{-- <div class="form-group row m-b-15">
							<label for="dfef_periodo_actual" class="col-form-label col-md-3">Período</label>
							<div class="col-md-9">
								{!! Form::text('dfef_periodo_actual', null, ['id'=>'dfef_periodo_actual', 'placeholder'=>'',  'class'=>'form-control']) !!}							
								<div id="el-dfef_periodo_actual" class="invalid-feedback lbl-error"></div>															
							</div>
						</div> --}}

						<div class="form-group row m-b-15">
							<label for="dfef_utilidad_perdida_actual" class="col-form-label col-md-3">Utilidad o pérdida del ejercicio</label>
							<div class="col-md-9">							
								<div class="input-group date">
									{{-- {!! Form::text('dfef_utilidad_perdida_actual', null, ['id'=>'dfef_utilidad_perdida_actual', 'placeholder'=>'',  'class'=>'form-control']) !!}							 --}}
									<input type= "text" id= "dfef_utilidad_perdida_actual" name = "dfef_utilidad_perdida_actual" class = "form-control m-b-5">
									{{-- {!! Form::text('dfef_utilidad_perdida_actual', null, ['id'=>'dfef_utilidad_perdida_actual', 'placeholder'=>'',  'class'=>'form-control']) !!} --}}
									{{-- {!! Form::text('dfef_utilidad_perdida_actual', null, ['id'=>'dfef_utilidad_perdida_actual', 'placeholder'=>'',  'class'=>'form-control']) !!} --}}
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
									{{-- {!! Form::text('dfef_balance_gral_actual', null, ['id'=>'dfef_balance_gral_actual', 'placeholder'=>'',  'class'=>'form-control']) !!}							 --}}
									<input type= "text" id= "dfef_balance_gral_actual" name = "dfef_balance_gral_actual" class = "form-control m-b-5">
									{{-- {!! Form::text('dfef_balance_gral_actual', null, ['id'=>'dfef_balance_gral_actual', 'placeholder'=>'',  'class'=>'form-control']) !!} --}}
									{{-- {!! Form::text('dfef_balance_gral_actual', null, ['id'=>'dfef_balance_gral_actual', 'placeholder'=>'',  'class'=>'form-control']) !!} --}}
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
									{{-- {!! Form::text('dfef_razon_liquidez_actual', null, ['id'=>'dfef_razon_liquidez_actual', 'placeholder'=>'',  'class'=>'form-control']) !!}							 --}}
									{{-- {!! Form::text('dfef_razon_liquidez_actual', null, ['id'=>'dfef_razon_liquidez_actual', 'placeholder'=>'',  'class'=>'form-control']) !!} --}}
									{{-- {!! Form::text('dfef_razon_liquidez_actual', null, ['id'=>'dfef_razon_liquidez_actual', 'placeholder'=>'',  'class'=>'form-control']) !!}							 --}}
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
									{{-- {!! Form::text('dfef_razon_endeudamiento_actual', null, ['id'=>'dfef_razon_endeudamiento_actual', 'placeholder'=>'',  'class'=>'form-control']) !!}							 --}}
									<input type= "text" id= "dfef_razon_endeudamiento_actual" name = "dfef_razon_endeudamiento_actual" class = "form-control m-b-5">
									{{-- {!! Form::text('dfef_razon_endeudamiento_actual', null, ['id'=>'dfef_razon_endeudamiento_actual', 'placeholder'=>'',  'class'=>'form-control']) !!} --}}
									{{-- {!! Form::text('dfef_razon_endeudamiento_actual', null, ['id'=>'dfef_razon_endeudamiento_actual', 'placeholder'=>'',  'class'=>'form-control']) !!} --}}
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
									{{-- {!! Form::text('dfef_razon_rentabilidad_actual', null, ['id'=>'dfef_razon_rentabilidad_actual', 'placeholder'=>'',  'class'=>'form-control']) !!}							 --}}
									{{-- {!! Form::text('dfef_razon_rentabilidad_actual', null, ['id'=>'dfef_razon_rentabilidad_actual', 'placeholder'=>'',  'class'=>'form-control']) !!} --}}
									{{-- {!! Form::text('dfef_razon_rentabilidad_actual', null, ['id'=>'dfef_razon_rentabilidad_actual', 'placeholder'=>'',  'class'=>'form-control']) !!}							 --}}
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
									{{-- {!! Form::text('dfef_capital_neto_actual', null, ['id'=>'dfef_capital_neto_actual', 'placeholder'=>'',  'class'=>'form-control']) !!}							 --}}
									{{-- {!! Form::text('dfef_capital_neto_actual', null, ['id'=>'dfef_capital_neto_actual', 'placeholder'=>'',  'class'=>'form-control']) !!} --}}
									{{-- {!! Form::text('dfef_capital_neto_actual', null, ['id'=>'dfef_capital_neto_actual', 'placeholder'=>'',  'class'=>'form-control']) !!}							 --}}
									<div class="input-group-addon">
										<i class="fa fa-dollar-sign"></i>
									</div>
									<div id="el-dfef_capital_neto_actual" class="invalid-feedback lbl-error"></div>
								</div>																
							</div>
						</div>
					</div>

					{{-- <div class="col-md-6 ">
						<legend>Anterior</legend>
						<div class="form-group row m-b-15">
							<label for="dfef_periodo_anterior" class="col-form-label col-md-3">Período</label>
							<div class="col-md-9">
								{!! Form::text('dfef_periodo_anterior', null, ['id'=>'dfef_periodo_anterior', 'placeholder'=>'',  'class'=>'form-control']) !!}							
								<div id="el-dfef_periodo_anterior" class="invalid-feedback lbl-error"></div>															
							</div>
						</div>				

						<div class="form-group row m-b-15">
							<label for="dfef_utilidad_perdida_anterior" class="col-form-label col-md-3">Utilidad o pérdida del ejercicio</label>
							<div class="col-md-9">							
								<div class="input-group date">
									{!! Form::text('dfef_utilidad_perdida_anterior', null, ['id'=>'dfef_utilidad_perdida_anterior', 'placeholder'=>'',  'class'=>'form-control']) !!}							
									<div class="input-group-addon">
										<i class="fa fa-dollar-sign"></i>
									</div>
									<div id="el-dfef_utilidad_perdida_anterior" class="invalid-feedback lbl-error"></div>
								</div>																
							</div>
						</div>

						<div class="form-group row m-b-15">
							<label for="dfef_balance_gral_anterior" class="col-form-label col-md-3">Capital contable balance general</label>
							<div class="col-md-9">							
								<div class="input-group date">
									{!! Form::text('dfef_balance_gral_anterior', null, ['id'=>'dfef_balance_gral_anterior', 'placeholder'=>'',  'class'=>'form-control']) !!}							
									<div class="input-group-addon">
										<i class="fa fa-dollar-sign"></i>
									</div>
									<div id="el-dfef_balance_gral_anterior" class="invalid-feedback lbl-error"></div>
								</div>																
							</div>
						</div>


						<div class="form-group row m-b-15">
							<label for="dfef_razon_liquidez_anterior" class="col-form-label col-md-3">Razón de liquidez</label>
							<div class="col-md-9">							
								<div class="input-group date">
									{!! Form::text('dfef_razon_liquidez_anterior', null, ['id'=>'dfef_razon_liquidez_anterior', 'placeholder'=>'',  'class'=>'form-control']) !!}							
									<div class="input-group-addon">
										<i class="fa fa-percent"></i>
									</div>
									<div id="el-dfef_razon_liquidez_anterior" class="invalid-feedback lbl-error"></div>
								</div>																
							</div>
						</div>	

						<div class="form-group row m-b-15">
							<label for="dfef_razon_endeudamiento_anterior" class="col-form-label col-md-3">Razón de endeudamiento</label>
							<div class="col-md-9">							
								<div class="input-group date">
									{!! Form::text('dfef_razon_endeudamiento_anterior', null, ['id'=>'dfef_razon_endeudamiento_anterior', 'placeholder'=>'',  'class'=>'form-control']) !!}							
									<div class="input-group-addon">
										<i class="fa fa-percent"></i>
									</div>
									<div id="el-dfef_razon_endeudamiento_anterior" class="invalid-feedback lbl-error"></div>
								</div>																
							</div>
						</div>

						<div class="form-group row m-b-15">
							<label for="dfef_razon_rentabilidad_anterior" class="col-form-label col-md-3">Razón de rentabilidad</label>
							<div class="col-md-9">							
								<div class="input-group date">
									{!! Form::text('dfef_razon_rentabilidad_anterior', null, ['id'=>'dfef_razon_rentabilidad_anterior', 'placeholder'=>'',  'class'=>'form-control']) !!}							
									<div class="input-group-addon">
										<i class="fa fa-percent"></i>
									</div>
									<div id="el-dfef_razon_rentabilidad_anterior" class="invalid-feedback lbl-error"></div>
								</div>																
							</div>
						</div>															
					
						<div class="form-group row m-b-15">
							<label for="dfef_capital_neto_anterior" class="col-form-label col-md-3">Capital neto de trabajo</label>
							<div class="col-md-9">							
								<div class="input-group date">
									{!! Form::text('dfef_capital_neto_anterior', null, ['id'=>'dfef_capital_neto_anterior', 'placeholder'=>'',  'class'=>'form-control']) !!}							
									<div class="input-group-addon">
										<i class="fa fa-dollar-sign"></i>
									</div>
									<div id="el-dfef_capital_neto_anterior" class="invalid-feedback lbl-error"></div>
								</div>																
							</div>
						</div>	
					</div>
				</div> --}}
	        </div>        
	    </div>
    
	{{-- {!! Form::close() !!} --}}







	 {{-- <div class="panel panel-default">
	    <div class="panel-heading ">  
			<div class="col-md-10 ">
				<h4 class="modal-title">Historial de estados financieros</h4>
			</div>
			<div class="col-md-2 " style="text-align: right"> </div>       
	    </div>
		<div class="panel-body" style="background: #f9f9f9;">
			<div class="row">
				<div class="col-md-12 form-horizontal form-bordered profile-content">		
					<div class="table-responsive">
						<table id="dfhef_tbl" class="table table-invoice">
							<thead>
								<tr>
									<th width="10px">#</th>
									<th>Periodo</th>
									<th>Utilidad o perdida</th>
									<th>Capital contable</th>
									<th>Razon de liquidez</th>
									<th>Razon endeudamiento	</th>
									<th>Razon rentabilidad</th>
									<th>Capital neto</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>		
				</div>
			</div>
		</div> --}}
	</div>



