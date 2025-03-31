<!--Inicio modal RTEC -->
<div class="modal fade" id="mdl_dtrtec">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="color: #1f5c01; background-color: #ced7df; border-color: #ced7df;">
                <h4 class="modal-title">Información del representante técnico</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="frmRepresentanteTecnico" name="frmRepresentanteTecnico">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <div class="modal-body">
                    <?php echo Form::hidden('dtrtec_id', 0,['id'=>'dtrtec_id', 'class'=>'form-control gui-input']); ?>

                    <?php echo Form::hidden('dtrtec_id_tramite', $datos->id,['id'=>'dtrtec_id_tramite', 'class'=>'form-control gui-input']); ?>

                    <?php echo Form::hidden('dtrtec_id_d_personal', 0,['id'=>'dtrtec_id_d_personal', 'class'=>'form-control gui-input']); ?>

                    <!-- <?php echo Form::hidden('dtrtec_domicilio', 0,['id'=>'dtrtec_domicilio', 'class'=>'form-control gui-input']); ?> -->


                    <ul class="nav nav-success nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-rt-1" data-toggle="tab" href="#tbgralrtec">
                                <span class="nav-icon">
                                    <b><i class="far fa-user"></i></b>
                                </span>
                                <span class="nav-text"><b>Datos generales</b></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-rt-2" data-toggle="tab" href="#tbconst" aria-controls="profile">
                                <span class="nav-icon">
                                    <b><i class="fas fa-globe"></i></b>
                                </span>
                                <span class="nav-text"><b>Constancia de Representante Técnico (RTEC)</b></span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content mt-5">
                        <div class="tab-pane fade show active" id="tbgralrtec" role="tabpanel" aria-labelledby="tab-rt-1">                             
                            <h5 class="mb-1 mt-3 tx-gray-700">Datos generales</h5><hr />

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label><b>Nombre:</b></label>
                                    <?php echo Form::text('dtrtec_nombre', null, ['id'=>'dtrtec_nombre', 'class'=>'form-control inp-udi']); ?>

                                </div>
                                <div class="col-lg-6">
                                    <label><b>Paterno:</b></label>
                                    <?php echo Form::text('dtrtec_ap_paterno', null, ['id'=>'dtrtec_ap_paterno', 'class'=>'form-control inp-udi']); ?>

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label><b>Materno:</b></label>
                                    <?php echo Form::text('dtrtec_ap_materno', null, ['id'=>'dtrtec_ap_materno', 'class'=>'form-control inp-udi']); ?>

                                </div>
                                <div class="col-lg-6">
                                    <label><b>Curp:</b></label>
                                    <?php echo Form::text('dtrtec_curp', null, ['id'=>'dtrtec_curp', 'class'=>'form-control inp-udi']); ?>

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label><b>Sexo:</b></label>
                                    <div class="radio-inline pt-2">
                                        <label class="radio radio-rounded">
                                            <input type="radio" name="dtrtec_sexo" id="dtrtec_sexo_1" value="1" checked />
                                            <span></span>
                                            Hombre
                                        </label>
                                        <label class="radio radio-rounded">
                                            <input type="radio" name="dtrtec_sexo" id="dtrtec_sexo_2" value="2" />
                                            <span></span>
                                            Mujer
                                        </label>                                        
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <small>Nota:  El campo  CURP es importante pues sirve para validar si el RTEC ya uso su constancia en el año. </small>

                                </div>                                
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tbconst" role="tabpanel" aria-labelledby="tab-rt-2">
                            <h5 class="mb-1 mt-4 tx-gray-700">Constancia</h5><hr />

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label><b>Tipo de constancia:</b></label>
                                    <?php echo Form::select('dtrtec_id_tipo_constancia', [1=>"Propia", 2=>"Ajena"], null, ['id' => 'dtrtec_id_tipo_constancia', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi']); ?>  
                                </div>
                                <div class="col-lg-6">
                                    <label><b>Número de constancia:</b></label>
                                    <?php echo Form::text('dtrtec_num_constancia', null, ['id'=>'dtrtec_num_constancia', 'class'=>'form-control inp-udi']); ?>

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label><b>Reposición:</b></label>
                                    <?php echo Form::select('dtrtec_reposicion', [0=>"No", 1=>"Si"], null, ['id' => 'dtrtec_reposicion', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi']); ?>    
                                </div>
                                <div class="col-lg-6">
                                    <label><b>Profesión:</b></label>
                                    <?php echo Form::select('dtrtec_id_profesion', $profesiones, null, ['id' => 'dtrtec_id_profesion', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi']); ?>

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label><b>Colegio:</b></label>
                                    <?php echo Form::select('dtrtec_id_colegio', $colegios_rtecs, null, ['id' => 'dtrtec_id_colegio', 'style'=>'width: 100%;', 'class' => 'form-control inp-udi']); ?>    
                                </div>
                                <div class="col-lg-6">
                                    <label><b>Cédula profesional:</b></label>
                                    <?php echo Form::text('dtrtec_cedula', null, ['id'=>'dtrtec_cedula', 'class'=>'form-control inp-udi']); ?>

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label><b>Fecha de expedición de cédula:</b></label>
                                    <?php echo Form::text('dtrtec_fecha_cedula', null, ['id'=>'dtrtec_fecha_cedula', 'class'=>'form-control inp-udi datepicker']); ?>   
                                </div>
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
</div>                          <?php /**PATH C:\AppServ\www\sircse\resources\views/backend/mis-tramites/mdl_rep_tec.blade.php ENDPATH**/ ?>