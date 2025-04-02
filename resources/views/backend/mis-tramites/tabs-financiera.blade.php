<h5 class="mb-1 mt-3 tx-gray-700">Capital contable</h5><hr />

<div class="form-group row">
   	<div class="col-lg-4">
    	<label><b>Capital contable</b></label>
    	{!! Form::text('dfcc_capital', null, ['id'=>'dfcc_capital', 'class'=>'form-control inp-udi m-b-5']) !!}
    </div>
    <div class="col-lg-4">
    	<label><b>Fecha de elaboración de estados financieros auditados</b></label>
    	{!! Form::date('dfcc_fecha_elaboracion', null, ['id'=>'dfcc_fecha_elaboracion', 'class'=>'form-control inp-udi m-b-5']) !!}
    </div>
    <div class="col-lg-4">
    	<label><b>Fecha de declaración</b></label>
    	{!! Form::date('dfcc_fecha_declaracion', null, ['id'=>'dfcc_fecha_declaracion', 'class'=>'form-control inp-udi']) !!}
    </div>
</div>

<div class="form-group row">
   	<div class="col-lg-12">
    	<label><b>Observaciones</b></label>
    	{!! Form::textarea('dfcc_observaciones', null, ['id'=>'dfcc_observaciones', 'class'=>'form-control inp-udi', 'rows' => '5']) !!}
    </div>
</div>


<h5 class="mb-1 mt-3 tx-gray-700 pt-5">Estado financiero del año inmediato anterior</h5><hr />

<div class="form-group row">
   	<div class="col-lg-4">
    	<label><b>Utilidad o pérdida del ejercicio</b></label>
    	{!! Form::text('dfef_periodo_actual', null, ['id'=>'dfef_periodo_actual', 'class'=>'form-control inp-udi']) !!}
    </div>
    <div class="col-lg-4">
    	<label><b>Capital contable balance general</b></label>
    	{!! Form::text('dfef_balance_gral_actual', null, ['id'=>'dfef_balance_gral_actual', 'class'=>'form-control inp-udi']) !!}
    </div>
    <div class="col-lg-4">
    	<label><b>Razón de liquidez</b></label>
    	{!! Form::text('dfef_razon_liquidez_actual', null, ['id'=>'dfef_razon_liquidez_actual', 'class'=>'form-control inp-udi']) !!}
    </div>
</div>

<div class="form-group row">
   	<div class="col-lg-4">
    	<label><b>Razón de endeudamiento</b></label>
    	{!! Form::text('dfef_razon_endeudamiento_actual', null, ['id'=>'dfef_razon_endeudamiento_actual', 'class'=>'form-control inp-udi']) !!}
    </div>
    <div class="col-lg-4">
    	<label><b>Razón de rentabilidad</b></label>
    	{!! Form::text('dfef_razon_rentabilidad_actual', null, ['id'=>'dfef_razon_rentabilidad_actual', 'class'=>'form-control inp-udi']) !!}
    </div>
    <div class="col-lg-4">
    	<label><b>Capital neto de trabajo</b></label>
    	{!! Form::text('dfef_capital_neto_actual', null, ['id'=>'dfef_capital_neto_actual', 'class'=>'form-control inp-udi']) !!}
    </div>
</div>
