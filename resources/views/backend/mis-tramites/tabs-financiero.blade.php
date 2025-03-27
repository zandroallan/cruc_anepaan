
    <form id="frmCapital" name="frmCapital">
        @csrf
                    {{-- <input type="hidden" id="hdIdRegistro" name="hdIdRegistro" value="{{ $datos->id }}">
                    <input type="hidden" id="hdIdContacto" name="hdIdContacto"> --}}
        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Capital Contable</legend>
                    {{-- <p><b>Nota:</b> Con el fin de que se atiendan a personas autorizadas y den buen uso de la información, es obligatorio capturar un contacto.</p> --}}
        <div class= "row">
            <div class="col-md-6">
                <div class="form-group row m-b-15">
                    <label for="capital_contable" class="col-form-label col-md-3">Capital Contable*</label>
                    <div class="col-md-9">
                                    {{-- {!! Form::text('nombre_contacto', null, ['id'=>'nombre_contacto', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!} --}}
                        <input type = "text" id = "capital_contable" name = "capital_contable" class = "form-control m-b-5">
                        <div id="el-capital_contable" class="invalid-feedback lbl-error"></div>    
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label for="fecha_declaracion" class="col-form-label col-md-3">Fecha de declaración*</label>
                    <div class="col-md-9">
                                    {{-- {!! Form::text('ap_paterno_contacto', null, ['id'=>'ap_paterno_contacto', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!} --}}
                        <input type = "date" id = "fecha_declaracion" name = "fecha_declaracion" class = "form-control m-b-5">
                        <div id="el-fecha_declaracion" class="invalid-feedback lbl-error"></div>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label for="fecha_estadosfinancieros" class="col-form-label col-md-3">Fecha de elaboración de estados financieros auditados*</label>
                    <div class="col-md-9">
                                    {{-- {!! Form::text('ap_materno_contacto', null, ['id'=>'ap_materno_contacto', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!} --}}
                        <input type = "date" id = "fecha_estadosfinancieros" name = "fecha_estadosfinancieros" class = "form-control m-b-5">
                                    {{-- {!! Form::text('ap_materno_contacto', null, ['id'=>'ap_materno_contacto', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!} --}}
                        <div id="el-fecha_estadosfinancieros" class="invalid-feedback lbl-error"></div>
                    </div>
                </div>
            </div>
            <div class = "col-md-6">
                <div class="form-group row m-b-15">
                    <label for="observaciones" class="col-form-label col-md-3">Observaciones</label>
                    <div class="col-md-9">
                                    {{-- {!! Form::text('ap_materno_contacto', null, ['id'=>'ap_materno_contacto', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!} --}}
                        <textarea rows="5" id = "observaciones" name = "observaciones" class = "form-control m-b-5"></textarea>
                                    {{-- {!! Form::text('ap_materno_contacto', null, ['id'=>'ap_materno_contacto', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!} --}}
                        <div id="el-observaciones" class="invalid-feedback lbl-error"></div>
                    </div>
                </div>
            </div>
        </div>
                    {{-- <div class="form-group row m-b-15">
                        <label for="cargo_contacto" class="col-form-label col-md-3">Cargo en la empresa*</label>
                        <div class="col-md-9">
                            {!! Form::text('cargo_contacto', null, ['id'=>'cargo_contacto', 'placeholder'=>'',  'class'=>'form-control m-b-5']) !!}
                            <div id="el-cargo_contacto" class="invalid-feedback lbl-error"></div>
                        </div>
                    </div> --}}

    </form>
    <div class="text-right form-group">
        <button id="btn-guardar-contacto" class="btn ripple btn-outline-success" onclick="AddContacto()">
            <i class="fa fa-save"></i> Agregar contacto
        </button>
    </div>