
<legend>Documentación entregada</legend>
<p>Subir documentación</p>

{!! Form::open(['route' => ['tramites-adjuntos.eliminar', 0], 'id'=>'frm-destroy-adjunto-tmp', 'name'=>'frm-destroy-adjunto-tmp','method' => 'DELETE'], ['role' => 'form']) !!}
{!! Form::close() !!}					
{!! Form::open(['route' => 'mis-tramites.store-document-tmp', 'method' => 'POST' , 'files' => true, 'id' => 'frm-subir-adjunto-tmp', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']) !!} 
    {!! Form::hidden('id_registro', $datos->id,['id'=>'id', 'class'=>'form-control gui-input']) !!}
    <div class="form-group row m-b-15">
        <label for="id_documento" class="col-form-label col-md-2">Documento faltante*</label>
        <div class="col-md-6">
            {!! Form::select('id_documento', $documentos_requeridos, null, ['id' => 'id_documento', 'style'=>'width: 100%;', 'class' => 'default-select2 form-control']) !!}
            <div id="el-id_documento" class="invalid-feedback lbl-error"></div>
        </div>
        <div class="col-md-21">									
            <input type="file" id="archivosubido" name="archivosubido" class="form-control">
            <div id="el-archivosubido" class="invalid-feedback lbl-error"></div>									
        </div>	
        <div class="col-md-1">
            <button type="button" class="btn btn-primary" onclick="upload_tmp(this)"><i class="fa fa-search fa-upload"></i> Subir</button>
        </div>								
    </div>
{!! Form::close() !!}
<br><br>
<div class="row">
    <div class="col-md-4">
        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Área legal</legend>								
        <div id="doctos-legal" class="col-md-12">								
        </div>
    </div>
    <div class="col-md-4">
        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Área técnica</legend>
        <div id="doctos-tecnica" class="col-md-12">
        </div>
    </div>
    <div class="col-md-4">
        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Área financiera</legend>
        <div id="doctos-financiera" class="col-md-12">
        </div>
    </div>
</div>