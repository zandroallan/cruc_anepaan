<!--Inicio modal RTEC -->
<div class="modal fade" id="mdl_dtrtec">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Representante técnico</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="frmRepresentanteTecnico" name="frmRepresentanteTecnico">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <div class="modal-body">
                    <?php echo Form::hidden('dtrtec_id', 0,['id'=>'dtrtec_id', 'class'=>'form-control gui-input']); ?>

                    <?php echo Form::hidden('dtrtec_id_tramite', $datos->id,['id'=>'dtrtec_id_tramite', 'class'=>'form-control gui-input']); ?>

                    <?php echo Form::hidden('dtrtec_id_d_personal', 0,['id'=>'dtrtec_id_d_personal', 'class'=>'form-control gui-input']); ?>

                    <!-- <?php echo Form::hidden('dtrtec_domicilio', 0,['id'=>'dtrtec_domicilio', 'class'=>'form-control gui-input']); ?> -->

                    <h5 class="mb-1 mt-3 tx-gray-700">Datos generales</h5><hr />
                    <div class="form-group row m-b-15">
                        <label for="dtrtec_nombre" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Nombre*</label>
                        <div class="col-md-8">
                            <?php echo Form::text('dtrtec_nombre', null, ['id'=>'dtrtec_nombre', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

                            <div id="el-dtrtec_nombre" class="invalid-feedback lbl-error"></div>
                        </div>
                    </div>
                    <div class="form-group row m-b-15">
                        <label for="dtrtec_ap_paterno" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">A. paterno*</label>
                        <div class="col-md-8">
                            <?php echo Form::text('dtrtec_ap_paterno', null, ['id'=>'dtrtec_ap_paterno', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

                            <div id="el-dtrtec_ap_paterno" class="invalid-feedback lbl-error"></div>
                        </div>
                    </div>
                    <div class="form-group row m-b-15">
                        <label for="dtrtec_ap_materno" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">A. materno*</label>
                        <div class="col-md-8">
                            <?php echo Form::text('dtrtec_ap_materno', null, ['id'=>'dtrtec_ap_materno', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

                            <div id="el-dtrtec_ap_materno" class="invalid-feedback lbl-error"></div>
                        </div>
                    </div>

                    <div class="form-group row m-b-15">
                        <label for="dtrtec_curp" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Curp*</label>
                        <div class="col-md-8">
                            <?php echo Form::text('dtrtec_curp', null, ['id'=>'dtrtec_curp', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

                            <div id="el-dtrtec_curp" class="invalid-feedback lbl-error"></div>
                            <small class="f-s-12 text-grey-darker">Nota: A este campo es importante pues sirve para validar si el RTEC ya uso su constancia en el año. </small>
                        </div>
                    </div>

                    <!-- <div class="form-group row m-b-15">
                        <label for="dtrtec_rfc" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">R.F.C.</label>
                        <div class="col-md-8">
                            <?php echo Form::text('dtrtec_rfc', null, ['id'=>'dtrtec_rfc', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

                            <div id="el-dtrtec_rfc" class="invalid-feedback lbl-error"></div>
                        </div>
                    </div> -->

                    <div class="form-group row  m-b-15 ">
                        <label class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Sexo*</label>
                        <div class="col-md-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="dtrtec_sexo" id="dtrtec_sexo_1" value="1" checked>
                                <label class="form-check-label" for="dtrtec_sexo_1">Hombre</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="dtrtec_sexo" id="dtrtec_sexo_2" value="2">
                                <label class="form-check-label" for="dtrtec_sexo_2">Mujer</label>
                            </div>
                        </div>
                    </div>

                    <h5 class="mb-1 mt-3 tx-gray-700">Constancia de Representante Técnico (RTEC)</h5><hr />
                    <div class="form-group row m-b-15">
                        <label for="dtrtec_id_tipo_constancia" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Tipo de constancia*</label>
                        <div class="col-md-8">
                            <?php echo Form::select('dtrtec_id_tipo_constancia', [1=>"Propia", 2=>"Ajena"], null, ['id' => 'dtrtec_id_tipo_constancia', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control']); ?>           
                            <div id="el-dtrtec_id_tipo_constancia" class="invalid-feedback lbl-error"></div>
                        </div>
                    </div>

                    <div class="form-group row m-b-15">
                        <label for="dtrtec_num_constancia" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Número de constancia*</label>
                        <div class="col-md-8">
                            <?php echo Form::text('dtrtec_num_constancia', null, ['id'=>'dtrtec_num_constancia', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

                            <div id="el-dtrtec_num_constancia" class="invalid-feedback lbl-error"></div>
                        </div>
                    </div>

                    <div class="form-group row m-b-15">
                        <label for="dtrtec_reposicion" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Reposición*</label>
                        <div class="col-md-8">
                            <?php echo Form::select('dtrtec_reposicion', [0=>"No", 1=>"Si"], null, ['id' => 'dtrtec_reposicion', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control']); ?>          
                            <div id="el-dtrtec_reposicion" class="invalid-feedback lbl-error"></div>
                        </div>
                    </div>

                    <div class="form-group row m-b-15">
                        <label for="dtrtec_id_profesion" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Profesión*</label>
                        <div class="col-md-8">
                            <?php echo Form::select('dtrtec_id_profesion', $profesiones, null, ['id' => 'dtrtec_id_profesion', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control']); ?>

                            <div id="el-dtrtec_id_profesion" class="invalid-feedback lbl-error"></div>
                        </div>
                    </div>

                    <div class="form-group row m-b-15">
                        <label for="dtrtec_id_colegio" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Colegio*</label>
                        <div class="col-md-8">
                            <?php echo Form::select('dtrtec_id_colegio', $colegios_rtecs, null, ['id' => 'dtrtec_id_colegio', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control']); ?>

                            <div id="el-dtrtec_id_colegio" class="invalid-feedback lbl-error"></div>
                        </div>
                    </div>

                    <div class="form-group row m-b-15">
                        <label for="dtrtec_cedula" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Cédula profesional*</label>
                        <div class="col-md-8">
                            <?php echo Form::text('dtrtec_cedula', null, ['id'=>'dtrtec_cedula', 'placeholder'=>'',  'class'=>'form-control input-sm']); ?>

                            <div id="el-dtrtec_cedula" class="invalid-feedback lbl-error"></div>
                        </div>
                    </div>
                    <div class="form-group row m-b-15">
                        <label for="dtrtec_fecha_cedula" class="col-form-label tx-12 tx-medium tx-gray-700 col-md-4">Fecha de expedición de cédula*</label>
                        <div class="col-md-8">
                            <div class="input-group date">
                                <?php echo Form::text('dtrtec_fecha_cedula', null, ['id'=>'dtrtec_fecha_cedula', 'placeholder'=>'',  'class'=>'form-control datepicker']); ?>

                                <div id="el-dtrtec_fecha_cedula" class="invalid-feedback lbl-error"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn ripple btn-outline-warning" data-dismiss="modal">
                        Cerrar
                    </a>
                    <button type="button" class="btn ripple btn-outline-success" onclick="addRepresentanteTecnico()">
                        <i class="fa fa-save"></i> Guardar
                    </button>                    
                </div>
            </form>  
        </div>
    </div>
</div>                          <?php /**PATH /var/cores/c-sircse/resources/views/backend/mis-tramites/mdl_rep_tec.blade.php ENDPATH**/ ?>