<div id="documentacion_areas_spinner">

<h4 class="m-t-10">Documentación para la Constancia de <span class="text-primary">{!! $lbl_tramite_siguiente !!}</span> en el Registro de {{$lbl_contratista_supervisor}}.</h4>



<div class="alert alert-custom alert-light-dark fade show mb-10" role="alert">
	<div class="alert-icon">
		<span class="svg-icon svg-icon-3x svg-icon-dark">
			<!--begin::Svg Icon | path:assets/media/svg/icons/Code/Info-circle.svg-->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24"></rect>
					<circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"></circle>
					<rect fill="#000000" x="11" y="10" width="2" height="7" rx="1"></rect>
					<rect fill="#000000" x="11" y="7" width="2" height="2" rx="1"></rect>
				</g>
			</svg>
			<!--end::Svg Icon-->
		</span>
	</div>
	<div class="alert-text font-weight-bold">
		<h6>
			<span class="label label-dot label-dark"></span>
			Los documentos presentados deben ser legibles para evitar ser observados, el tamaño maximo de <b>cada archivo no debe sobrepasar los 40mb</b>. Los archivos deben ser subidos en formato <b>PDF</b>.
		</h6>
	</div>
</div>




<h5 class="mb-1 mt-3">Documentación legal</h5><hr />
<div class="row m-b-10">
    <div id="doctos-legal" class="col-md-12"></div>
</div>

@if($datos->id_sujeto==1)
<h5 class="mb-1 mt-3">Documentación financiera</h5><hr />

<?php
/*
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
				<input class="form-check-input" type="radio" name="obligado_dec_isr" id="obligado_dec_isr_1" onclick="obligado_dec_isr(<?php echo $id_tipo_tramite; ?>,<?php echo $datos->id; ?>,this.value);" value="1" {{ $chk_obligado_dec_isr_1 }}>

				<label class="form-check-label" for="obligado_dec_isr_1">
					<span class="badge badge-success">Si</span> estoy obligado a presentar la Declaración Anual del Impuesto Sobre la Renta
				</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="obligado_dec_isr" id="obligado_dec_isr_2" onclick="obligado_dec_isr(<?php echo $id_tipo_tramite; ?>, <?php echo $datos->id; ?>,this.value);" value="2" {{ $chk_obligado_dec_isr_2 }}>
				<label class="form-check-label" for="obligado_dec_isr_2"><span class="badge badge-danger">No</span> estoy obligado a presentar la Declaración Anual del Impuesto Sobre la Renta</label>
			</div>
		</div>
	</div>
</div>
*/
?>

<div class="row m-b-10">
	<div id="doctos-financiera" class="col-md-12"></div>
</div>
@endif

<h5 class="mb-1 mt-3">Documentación técnica</h5><hr />

@if($id_tipo_tramite==1)
<div style="display:none" class="col-md-12">
	<div class="form-group row align-items-center">
		<label class="col-md-2 col-form-label">Quien acredita las especialidades?</label>
		<div class="col-md-10">
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="tec_acredita_tmp" id="tec_acredita_tmp_1" onclick="tec_acredita(<?php echo $id_tipo_tramite; ?>,<?php echo $datos->id; ?>,this.value);" value="1" {{ $chk_tec_acredita_tmp_1 }}>
				<label class="form-check-label" for="tec_acredita_tmp_1">Empresa contratista</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="tec_acredita_tmp" id="tec_acredita_tmp_2" onclick="tec_acredita(<?php echo $id_tipo_tramite; ?>, <?php echo $datos->id; ?>,this.value);" value="2" {{ $chk_tec_acredita_tmp_2 }}>
				<label class="form-check-label" for="tec_acredita_tmp_2">Representante Técnico de Empresas Constructoras</label>
			</div>
		</div>
	</div>
</div>
@endif

@if($id_tipo_tramite!=1)
<div class="col-md-12">
	<p><b>(OP)</b>: En caso de pretender acreditar especialidades adicionales la empresa contratista o el representante técnico.</p>
</div>
@endif
<div class="row m-b-10">
    <div id="doctos-tecnica" class="col-md-12"></div>
</div>



{!! Form::open(['route' => ['tramites-adjuntos.eliminar', 0], 'id'=>'frm-destroy-adjunto-tmp', 'name'=>'frm-destroy-adjunto-tmp','method' => 'DELETE'], ['role' => 'form']) !!}
{!! Form::close() !!}

<!-- Inicio modal Subir unico documento -->
<div class="modal fade" id="mdl_documento_1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Subir documento 1</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>

            {!! Form::open(['route' => 'mis-tramites.store-document-tmp', 'method' => 'POST' , 'files' => true, 'id' => 'frm-subir-adjunto-tmp', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']) !!}
                {!! Form::hidden('id_registro', $datos->id,['id'=>'id', 'class'=>'form-control gui-input']) !!}
                {!! Form::hidden('id_documento', 0,['id'=>'id_documento', 'class'=>'form-control gui-input']) !!}
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

			{!! Form::close() !!}
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

            {!! Form::open(['route' => 'mis-tramites.store-document-tmp', 'method' => 'POST' , 'files' => true, 'id' => 'frm-subir-adjunto-tmp-dec-anual', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']) !!}
                {!! Form::hidden('id_registro', $datos->id,['id'=>'id', 'class'=>'form-control gui-input']) !!}
			<div class="modal-body">
                <h4 id="mdl_lbl_documento_declaracion_anual"></h4><br>

				<div class="form-group row m-b-15">
					<label class="col-form-label col-md-3">Documento*</label>
                    <div class="col-md-9">
                        {!! Form::select('id_documento', [], null, ['id' => 'id_documento_dec_anual', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control']) !!}
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
			{!! Form::close() !!}
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

            {!! Form::open(['route' => 'mis-tramites.store-document-tmp', 'method' => 'POST' , 'files' => true, 'id' => 'frm-subir-adjunto-tmp', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']) !!}
                {!! Form::hidden('id_registro', $datos->id,['id'=>'id', 'class'=>'form-control gui-input']) !!}
                {!! Form::hidden('id_documento', 0,['id'=>'id_documento', 'class'=>'form-control gui-input']) !!}
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
			{!! Form::close() !!}
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

            {!! Form::open(['route' => 'mis-tramites.store-document-soporte', 'method' => 'POST' , 'files' => true, 'id' => 'frm-subir-adjunto-soporte', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']) !!}
                {!! Form::hidden('id_registro', $datos->id,['id'=>'id', 'class'=>'form-control gui-input']) !!}
                {!! Form::hidden('id_documento_soporte', null,['id'=>'id_documento_soporte', 'class'=>'form-control gui-input']) !!}
			<div class="modal-body">
					<h4 id="mdl_lbl_documento_soporte"></h4><br>

					<div class="form-group row m-b-15" id="div_alias" name="div_alias">
						<label for="alias" class="col-form-label col-md-3">Nombre de la cuenta*</label>
						<div class="col-md-9">
							{!! Form::text('files-alias', null, ['id'=>'files-alias', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}
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
			{!! Form::close() !!}
		</div>
	</div>
</div>
<!-- Fin modal documentos del trámite -->

</div>