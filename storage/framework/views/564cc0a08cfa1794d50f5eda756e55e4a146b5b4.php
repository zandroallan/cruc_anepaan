<div id="documentacion_areas_spinner">

<h4 class="m-t-10">Expedición de la Constancia de <?php echo $lbl_tramite_siguiente; ?> en el Registro de <?php echo e($lbl_contratista_supervisor); ?>.</h4>

<div class="row">
	<div class="col-md-12">
		<p class="text-primary"><b>Notas:</b></p>
		<div class="activity-block">
			<ul class="task-list">
				<li>
					<i class="task-icon bg-secondary"></i>
					<h6>Los documentos presentados deben ser legibles para evitar ser observados. El tamaño maximo de <b>cada archivo no debe sobrepasar los 40mb</b>. Los archivos deben ser subidos en formato <b>PDF</b>.</h6>					
				</li>
				<li>
					<i class="task-icon bg-secondary"></i>
					<h6>Derivado de los cambios del <b>SAT</b>: En su declaración ISR 2022, adjuntar al final de su declaración, el total de fojas que integra el <b>Concepto Estados Financieros</b>, presentada ante el SAT en un solo PDF.</h6>
				</li>														
			</ul>
		</div>
	</div>
</div>



<h5 class="mb-1 mt-3">Documentación legal</h5><hr />
<div class="form-group row m-b-10">
    <div id="doctos-legal" class="col-md-12"></div>
</div>

<?php if($datos->id_sujeto==1): ?>
<h5 class="mb-1 mt-3">Documentación financiera</h5><hr />
<p>
	Los Suscritos manifestamos, bajo protesta de decir verdad, si la empresa esta obligada a presentar la Declaración Anual del Impuesto Sobre la Renta. motivo por el cual asumimos cualquier responsabilidad administrativa y/o penal derivada de cualquier declaración en falso sobre las mismas
</p>



<div  class="col-md-12">
	<div class="form-group row align-items-center">
		<label style="display:none" class="col-md-2 col-form-label">
			Los Suscritos manifestamos, bajo protesta de decir verdad, que la empresa no estamos obligados a presentar la Declaración Anual del Impuesto Sobre la Renta. motivo por el cual asumimos cualquier responsabilidad administrativa y/o penal derivada de cualquier declaración en falso sobre las mismas
		</label>
		<div class="col-md-10">
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="obligado_dec_isr" id="obligado_dec_isr_1" onclick="obligado_dec_isr(<?php echo $id_tipo_tramite; ?>,<?php echo $datos->id; ?>,this.value);" value="1" <?php echo e($chk_obligado_dec_isr_1); ?>>

				<label class="form-check-label" for="obligado_dec_isr_1">
					<span class="badge badge-success">Si</span> estoy obligado a presentar la Declaración Anual del Impuesto Sobre la Renta
				</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="obligado_dec_isr" id="obligado_dec_isr_2" onclick="obligado_dec_isr(<?php echo $id_tipo_tramite; ?>, <?php echo $datos->id; ?>,this.value);" value="2" <?php echo e($chk_obligado_dec_isr_2); ?>>
				<label class="form-check-label" for="obligado_dec_isr_2"><span class="badge badge-danger">No</span> estoy obligado a presentar la Declaración Anual del Impuesto Sobre la Renta</label>
			</div>
		</div>
	</div>
</div>

<div class="form-group row m-b-10">
	<div id="doctos-financiera" class="col-md-12"></div>
</div>
<?php endif; ?>

<h5 class="mb-1 mt-3">Documentación técnica</h5><hr />

<?php if($id_tipo_tramite==1): ?>
<div style="display:none" class="col-md-12">
	<div class="form-group row align-items-center">
		<label class="col-md-2 col-form-label">Quien acredita las especialidades?</label>
		<div class="col-md-10">
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="tec_acredita_tmp" id="tec_acredita_tmp_1" onclick="tec_acredita(<?php echo $id_tipo_tramite; ?>,<?php echo $datos->id; ?>,this.value);" value="1" <?php echo e($chk_tec_acredita_tmp_1); ?>>
				<label class="form-check-label" for="tec_acredita_tmp_1">Empresa contratista</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="tec_acredita_tmp" id="tec_acredita_tmp_2" onclick="tec_acredita(<?php echo $id_tipo_tramite; ?>, <?php echo $datos->id; ?>,this.value);" value="2" <?php echo e($chk_tec_acredita_tmp_2); ?>>
				<label class="form-check-label" for="tec_acredita_tmp_2">Representante Técnico de Empresas Constructoras</label>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if($id_tipo_tramite!=1): ?>
<div class="col-md-12">
	<p><b>(OP)</b>: En caso de pretender acreditar especialidades adicionales la empresa contratista o el representante técnico.</p>
</div>
<?php endif; ?>
<div class="form-group row m-b-10">
    <div id="doctos-tecnica" class="col-md-12"></div>
</div>



<?php echo Form::open(['route' => ['tramites-adjuntos.eliminar', 0], 'id'=>'frm-destroy-adjunto-tmp', 'name'=>'frm-destroy-adjunto-tmp','method' => 'DELETE'], ['role' => 'form']); ?>

<?php echo Form::close(); ?>


<!-- Inicio modal Subir unico documento -->
<div class="modal fade" id="mdl_documento_1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Subir documento 1</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>

            <?php echo Form::open(['route' => 'mis-tramites.store-document-tmp', 'method' => 'POST' , 'files' => true, 'id' => 'frm-subir-adjunto-tmp', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']); ?>

                <?php echo Form::hidden('id_registro', $datos->id,['id'=>'id', 'class'=>'form-control gui-input']); ?>

                <?php echo Form::hidden('id_documento', 0,['id'=>'id_documento', 'class'=>'form-control gui-input']); ?>

			<div class="modal-body">
                <h4 id="mdl_lbl_documento"></h4><br>

				<div class="form-group row m-b-15">
					<label for="archivosubido" class="col-form-label col-md-3">Archivo*</label>
					<div class="col-md-9">
                        <input type="file" id="archivosubido" name="archivosubido" class="form-control">
                        <div id="el-archivosubido" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

			</div>

			<div class="modal-footer">



				<div class="spinner_no_wait">
                	<button type="button" class="btn btn-primary" onclick="upload_tmp('frm-subir-adjunto-tmp')"><i class="fa fa-search fa-upload"></i> Subir</button>
				</div>

				<div class="spinner_wait"  style="display:none">
					<button class="btn ripple btn-secondary" disabled type="button"><span aria-hidden="true" class="spinner-border spinner-border-sm" role="status"></span> Subiendo, por favor espere...</button>
				</div>
				
				<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Cerrar</a>

			</div>


			<?php echo Form::close(); ?>

		</div>
	</div>
</div>
<!-- Fin modal documentos del trámite -->

<!-- Inicio modal Declaracion anual -->
<div class="modal fade" id="mdl_documento_declaracion_anual">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Subir documento anual</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>

            <?php echo Form::open(['route' => 'mis-tramites.store-document-tmp', 'method' => 'POST' , 'files' => true, 'id' => 'frm-subir-adjunto-tmp-dec-anual', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']); ?>

                <?php echo Form::hidden('id_registro', $datos->id,['id'=>'id', 'class'=>'form-control gui-input']); ?>

			<div class="modal-body">
                <h4 id="mdl_lbl_documento_declaracion_anual"></h4><br>

				<div class="form-group row m-b-15">
					<label class="col-form-label col-md-3">Documento*</label>
                    <div class="col-md-9">
                        <?php echo Form::select('id_documento', [], null, ['id' => 'id_documento_dec_anual', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control']); ?>

                    </div>
				</div>

				<div class="form-group row m-b-15">
					<label for="archivosubido" class="col-form-label col-md-3">Archivo*</label>
					<div class="col-md-9">
                        <input type="file" id="archivosubido" name="archivosubido" class="form-control">
                        <div id="el-archivosubido" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

			</div>
			<div class="modal-footer">

				<div class="spinner_no_wait">
					<button type="button" class="btn btn-primary" onclick="upload_tmp('frm-subir-adjunto-tmp-dec-anual')"><i class="fa fa-search fa-upload"></i> Subir</button>
				</div>

				<div class="spinner_wait"  style="display:none">
					<button class="btn ripple btn-secondary" disabled type="button"><span aria-hidden="true" class="spinner-border spinner-border-sm" role="status"></span> Subiendo, por favor espere...</button>
				</div>




				<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Cerrar</a>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
</div>
<!-- Fin modal documentos del trámite -->

<!-- Inicio modal Subir unico documento -->
<div class="modal fade" id="mdl_documento_agregar_n">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Subir documento 2</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>

            <?php echo Form::open(['route' => 'mis-tramites.store-document-tmp', 'method' => 'POST' , 'files' => true, 'id' => 'frm-subir-adjunto-tmp', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']); ?>

                <?php echo Form::hidden('id_registro', $datos->id,['id'=>'id', 'class'=>'form-control gui-input']); ?>

                <?php echo Form::hidden('id_documento', 0,['id'=>'id_documento', 'class'=>'form-control gui-input']); ?>

			<div class="modal-body">
                <h4 id="mdl_lbl_documento"></h4><br>

				<div class="form-group row m-b-15">
					<label for="archivosubido" class="col-form-label col-md-3">Archivo*</label>
					<div class="col-md-9">
                        <input type="file" id="archivosubido" name="archivosubido" class="form-control">
                        <div id="el-archivosubido" class="invalid-feedback lbl-error"></div>
					</div>
				</div>

			</div>
			<div class="modal-footer">


				<div class="spinner_no_wait">
					<button type="button" class="btn btn-primary" onclick="upload_tmp('frm-subir-adjunto-tmp')"><i class="fa fa-search fa-upload"></i> Subir</button>
				</div>

				<div class="spinner_wait"  style="display:none">
					<button class="btn ripple btn-secondary" disabled type="button"><span aria-hidden="true" class="spinner-border spinner-border-sm" role="status"></span> Subiendo, por favor espere...</button>
				</div>
				
				
				<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Cerrar</a>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
</div>
<!-- Fin modal documentos del trámite -->



<!-- Inicio modal Subir unico documento -->
<div class="modal fade" id="mdl_documento_soporte">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Subir documento 3</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>

            <?php echo Form::open(['route' => 'mis-tramites.store-document-soporte', 'method' => 'POST' , 'files' => true, 'id' => 'frm-subir-adjunto-soporte', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']); ?>

                <?php echo Form::hidden('id_registro', $datos->id,['id'=>'id', 'class'=>'form-control gui-input']); ?>

                <?php echo Form::hidden('id_documento_soporte', null,['id'=>'id_documento_soporte', 'class'=>'form-control gui-input']); ?>

			<div class="modal-body">
					<h4 id="mdl_lbl_documento_soporte"></h4><br>

					<div class="form-group row m-b-15" id="div_alias" name="div_alias">
						<label for="alias" class="col-form-label col-md-3">Nombre de la cuenta*</label>
						<div class="col-md-9">
							<?php echo Form::text('files-alias', null, ['id'=>'files-alias', 'placeholder'=>'',  'class'=>'form-control m-b-5']); ?>

							<div id="el-files-alias" class="invalid-feedback lbl-error"></div>
						</div>
					</div>

					<div id="soporte_variable">

					</div>
			</div>
			<div class="modal-footer">

				<div class="spinner_no_wait">
					<button type="button" class="btn btn-primary" onclick="upload_soporte('frm-subir-adjunto-soporte')"><i class="fa fa-search fa-upload"></i> Subir</button>
				</div>

				<div class="spinner_wait"  style="display:none">
					<button class="btn ripple btn-secondary" disabled type="button"><span aria-hidden="true" class="spinner-border spinner-border-sm" role="status"></span> Subiendo, por favor espere...</button>
				</div>
				
				<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Cerrar</a>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
</div>
<!-- Fin modal documentos del trámite -->

</div><?php /**PATH C:\AppServ\apps\sircse\resources\views/backend/mis-tramites/tabs-documentacion.blade.php ENDPATH**/ ?>