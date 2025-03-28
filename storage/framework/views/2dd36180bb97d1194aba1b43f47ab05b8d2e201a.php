<div class="modal fade" id="mdl_dtrtec_esp">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Especialidades del Representante técnico</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
            <div class="modal-body">                        
                <form id="frmAddEspRtec" name="frmAddEspRtec">
                    <?php echo csrf_field(); ?>
                    <?php echo Form::hidden('dtsp_id_tramite_esp', 0, ['id'=>'dtsp_id_tramite_esp', 'class'=>'form-control gui-input']); ?>	
                    <?php echo Form::hidden('dtsp_id_tramite_rtec', $datos->id, ['id'=>'dtsp_id_tramite_rtec', 'class'=>'form-control gui-input']); ?>	
                    <div class="form-group row m-b-15">
                        <label for="dfcp_id_contador_b_rtec" class="col-form-label col-md-1">Especialidad</label>
                        <div class="col-md-9">
                            <?php echo Form::select('dtsp_id_especialidad_esp', $colegio_especialidades, null, ['id' => 'dtsp_id_especialidad_esp', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control']); ?>

                            <div id="el-dtsp_id_especialidad_esp" class="invalid-feedback lbl-error"></div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" onclick="AddEspRtec()"><i class="fa fa-plus"></i> Agregar</button>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div  class="col-md-4">
                        <div class="form-group row m-b-10">
                            <div id="dtec_especialidades1_esp" class="col-md-12"></div>
                        </div>
                    </div> 
                    <div  class="col-md-4">
                        <div class="form-group row m-b-10">
                            <div id="dtec_especialidades2_esp" class="col-md-12"></div>
                        </div>
                    </div>
                    <div  class="col-md-4">
                        <div class="form-group row m-b-10">
                            <div id="dtec_especialidades3_esp" class="col-md-12"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
			   <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Cerrar</a>
		   </div>
        </div>
    </div>
</div><?php /**PATH C:\AppServ\apps\sircse\resources\views/backend/mis-tramites/mdl_esp_rtec.blade.php ENDPATH**/ ?>