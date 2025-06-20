    <form class="frm-contador-publico" name="frm-contador-publico">
        <div class="row">
            <div class="col-md-6 form-group">
                <label><b>Contador público certificado *</b></label>
                <select class="form-control inp-udi" name="id_contador" id="id_contador">
                    <option value="">-- Seleccionar --</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label><b>Numero de constancia emitida por el colegio *</b></label>
                <input type="text" name="no_constancia_cp" id="no_constancia_cp" class="form-control inp-udi m-b-5">
            </div>
            <div class="col-md-12 form-group text-center">
                <button type="button" class="btn ripple btn-outline-success btn_store_cpc">
                    <i class="fa fa-save"></i> Agregar contador certificado
                </button>
            </div>
        </div>
    </form>

    <div class="_tbl_response_cpc">
        

        <!-- <div class="card card-custom gutter-b card-stretch">
            <div class="card-body">
                <div class="d-flex justify-content-between flex-column pt-4 h-100">
                    <div class="pb-5">
                        <div class="d-flex flex-column flex-center">
                            <div class="symbol symbol-120 symbol-circle symbol-success overflow-hidden">
                                <span class="symbol-label">
                                    <img src="assets/media/svg/avatars/007-boy-2.svg" class="h-75 align-self-end" alt="">
                                </span>
                            </div>
                            <a href="#" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">Jerry Kane</a>
                            <div class="font-weight-bold text-dark-50 font-size-sm pb-6">Grade 8, AE3 Student</div>
                        </div>
                        <div class="pt-1">
                            <div class="d-flex align-items-center pb-9">
                                <div class="symbol symbol-45 symbol-light mr-4">
                                    <span class="symbol-label">
                                        <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                            <i class="flaticon2-bell-4"></i>
                                        </span>
                                    </span>
                                </div>
                                <div class="d-flex flex-column flex-grow-1">
                                    <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Nombre</a>
                                    <span class="text-muted font-weight-bold">PHP, SQLite, Artisan CLI</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pb-9">
                                <div class="symbol symbol-45 symbol-light mr-4">
                                    <span class="symbol-label">
                                        <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                            <i class="flaticon2-bell-4"></i>
                                        </span>
                                    </span>
                                </div>
                                <div class="d-flex flex-column flex-grow-1">
                                    <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Modules</a>
                                    <span class="text-muted font-weight-bold">Successful Fellas</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pb-9">
                                <div class="symbol symbol-45 symbol-light mr-4">
                                    <span class="symbol-label">
                                        <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                            <i class="flaticon2-bell-4"></i>
                                        </span>
                                    </span>
                                </div>
                                <div class="d-flex flex-column flex-grow-1">
                                    <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Progress</a>
                                    <span class="text-muted font-weight-bold">Successful Fellas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


    </div>


<!-- <form class="frm-capital-contable" name="frm-capital-contable">
    <input type="hidden" value="0" name="id_capital_contable" id="id_capital_contable">
    <h5 class="mb-1 mt-3 tx-gray-700">Capital contable</h5><hr />
    
    <div class="row">
        <div class="col-md-12 form-group text-right">
            <a href="#" class="btn ripple btn-outline-success btn-store-capital-contable">
                <i class="fa fa-save"></i> Guardar capital contable
            </a> 
        </div>
    </div>  

    <div class="form-group row">
        <div class="col-lg-4">
            <label><b>Capital contable</b></label>
            <input type="text" name="capital" id="capital" class="form-control inp-udi m-b-5">
        </div>
        <div class="col-lg-4">
            <label><b>Fecha de elaboración de estados financieros auditados</b></label>
            <input type="date" name="fecha_elaboracion" id="fecha_elaboracion" class="form-control inp-udi m-b-5">
        </div>
        <div class="col-lg-4">
            <label><b>Fecha de declaración</b></label>
            <input type="date" name="fecha_declaracion" id="fecha_declaracion" class="form-control inp-udi m-b-5">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label><b>Observaciones</b></label>
            <textarea class="form-control inp-udi" name="observaciones" id="observaciones" rows="5"></textarea>
        </div>
    </div>
</form>


<form class="frm-estados-financieros" name="frm-estados-financieros">
    <input type="hidden" value="0" name="id_estado_financiero" id="id_estado_financiero">
    <h5 class="mb-1 mt-3 tx-gray-700 pt-5">Estado financiero del año inmediato anterior</h5><hr />

    <div class="row">
        <div class="col-md-12 form-group text-right">
            <a href="#" class="btn ripple btn-outline-success btn-store-estados-financieros">
                <i class="fa fa-save"></i> Guardar estados financieros
            </a> 
        </div>
    </div>    

    <div class="form-group row">
       	<div class="col-lg-4">
        	<label><b>Utilidad o pérdida del ejercicio</b></label>
            <input type="text" name="utilidad_perdida" id="utilidad_perdida" class="form-control inp-udi m-b-5">
        </div>
        <div class="col-lg-4">
        	<label><b>Capital contable balance general</b></label>
            <input type="text" name="balance_gral" id="balance_gral" class="form-control inp-udi m-b-5">
        </div>
        <div class="col-lg-4">
        	<label><b>Razón de liquidez</b></label>
            <input type="text" name="razon_liquidez" id="razon_liquidez" class="form-control inp-udi m-b-5">
        </div>
    </div>
    <div class="form-group row">
       	<div class="col-lg-4">
        	<label><b>Razón de endeudamiento</b></label>
            <input type="text" name="razon_endeudamiento" id="razon_endeudamiento" class="form-control inp-udi m-b-5">
        </div>
        <div class="col-lg-4">
        	<label><b>Razón de rentabilidad</b></label>
            <input type="text" name="razon_rentabilidad" id="razon_rentabilidad" class="form-control inp-udi m-b-5">
        </div>
        <div class="col-lg-4">
        	<label><b>Capital neto de trabajo</b></label>
            <input type="text" name="capital_neto" id="capital_neto" class="form-control inp-udi m-b-5">
        </div>
    </div>
</form> -->