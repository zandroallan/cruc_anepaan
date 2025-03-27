function mdl_documento_1(id_documento, txt_documento, tipo = 0) {
    $("#id_documento").val(id_documento);
    $("#mdl_lbl_documento").html(txt_documento);
    $("#mdl_documento_1").modal();
}

function fill_soporte(id_documento, tipo = 0) {
    let array = [];
    switch (id_documento) {
        // case 174:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "estado_cuenta": "Estado de cuenta*"
        //     };
        //     break;
        // case 175:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "estado_cuenta": "Estado de cuenta*",
        //         "facturas_xml": "Facturas y xml*",
        //         "contrato": "Contrato*"
        //     };
        //     break;
        // case 176:
        //     array = {
        //         "pagare": "Pagare*",
        //         "estado_cuenta": "Estado de cuenta*",
        //         "contrato": "Contrato*",
        //         "relacion_analitica": "Relación analítica*"
        //     };
        //     break;
        // case 177:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas": "Facturas*",
        //         "estado_cuenta": "Estado de cuenta*",
        //         "contrato": "Contrato*"
        //     };
        //     break;
        // case 178:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas_xml": "Facturas y xml*"
        //     };
        //     break;
        // case 179:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas_xml": "Facturas y xml*"
        //     };
        //     break;
        // case 180:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "escritura_publica": "Escritura Publica*",
        //         "pago_predial": "Pago Predial*",
        //         "avaluo": "Avalúo*"
        //     };
        //     break;
        // case 181:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas_xml": "Facturas y xml*",
        //         "reporte_fotografico": "Reporte Fotográfico*"
        //     };
        //     break;
        // case 182:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas_xml": "Facturas y xml*"
        //     };
        //     break;
        // case 183:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas": "Facturas*",
        //         "pago_refrendo": "Pago Refrendo*",
        //         // "tarjeta_circulacion": "Tarjeta/Circulación*"
        //     };
        //     break;
        // case 184:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas_xml": "Facturas y xml*"
        //     };
        //     break;
        // case 185:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas_xml": "Facturas y xml*"
        //     };
        //     break;
        case 240:
            array = {
                "contrato": "Contrato*",
                "acta_entrega": "Acta de entrega-recepción*",
                "finiquito_obra": "Finiquito de obra*"
            };
            break;
        case 244:
            array = {
                "contrato": "Contrato de obra pública*",
                "fianzas": "Fianzas*",
                "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*",
                "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.",
                "factura_pago": "Factura de pago"
            };
            break;
        case 251:
            array = {
                "contrato": "Contrato*",
                "acta_entrega": "Acta de entrega-recepción*",
                "finiquito_obra": "Finiquito de obra*",
                "nombramiento_residente": "Nombramiento como Residente de Obra o Superintendente de Construcción",
                "notas_bitacora": "Notas de bitácora convencional, notas del Sistema de Bitácora Electrónica de Obra Pública (BEOP) o notas del Sistema de Bitácora Electrónica y Seguimiento a Obra Pública (BESOP)."
            };
            break;
        case 252:
            array = {
                "contrato": "Contrato de obra pública*",
                "fianzas": "Fianzas*",
                "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*",
                "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.",
                "factura_pago": "Factura de pago"
            };
            break;
        case 256:
            array = {
                "contrato": "Contrato*",
                "acta_entrega": "Acta de entrega-recepción*",
                "finiquito_obra": "Finiquito de obra*",
                "facturas_xml": "Factura finiquito y xml*"
            };
            break;
        case 257:
            array = {
                "contrato": "Contrato de obra pública*",
                "fianzas": "Fianzas*",
                "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*",
                "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.",
                "factura_pago": "Factura de pago"
            };
            break;
        case 258:
            array = {
                "curriculum_empresa": "Currículum Vitae de la persona fisca o moral*",
                "curriculum_rtec": "Currículum Vitae del Representante Técnico*",
                "cedula": "Cédula Profesional*",
                "curp": "CURP*",
                "ine_ife": "INE O IFE*",
                "constancia": "Si el representante técnico cuenta con la Constancia de Registro de Contratistas de los últimos tres años a la solicitud."
            };
            break;
        case 259:
            array = {
                "constancia_colegio": "Constancia vigente emitida por el Colegio de profesionistas*",
                "curriculum_empresa": "Currículum Vitae de la persona fisca o moral*",
                "curriculum_rtec": "Currículum Vitae del Representante Técnico*",
                "cedula": "Cédula Profesional*",
                "curp": "CURP*",
                "ine_ife": "INE O IFE*",
                "constancia": "Si el representante técnico cuenta con la Constancia de Registro de Contratistas de los últimos tres años a la solicitud."
            };
            break;
        case 260:
            array = {
                "contrato": "Contrato*",
                "acta_entrega": "Acta de entrega-recepción*",
                "finiquito_obra": "Finiquito de obra*"
            };
            break;
        // case 266:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "documentacion_soporte": "Documentación soporte*"
        //     };
        //     break;
        case 267:
            array = {
                "contrato": "Contrato*",
                "acta_entrega": "Acta de entrega-recepción*",
                "finiquito_obra": "Finiquito de obra*",
                "nombramiento_residente": "Nombramiento como Residente de Obra o Superintendente de Construcción",
                "notas_bitacora": "Notas de bitácora convencional, notas del Sistema de Bitácora Electrónica de Obra Pública (BEOP) o notas del Sistema de Bitácora Electrónica y Seguimiento a Obra Pública (BESOP)."
            };
            break;
        case 268:
            array = {
                "contrato": "Contrato*",
                "acta_entrega": "Acta de entrega-recepción*",
                "finiquito_obra": "Finiquito de obra*",
                "facturas_xml": "Factura Finiquito y xml*",
                "nombramiento_residente": "Nombramiento como Residente de Obra o Superintendente de Construcción",
                "notas_bitacora": "Notas de bitácora convencional, notas del Sistema de Bitácora Electrónica de Obra Pública (BEOP) o notas del Sistema de Bitácora Electrónica y Seguimiento a Obra Pública (BESOP)."
            };
            break;
        case 269:
            array = {
                "contrato": "Contrato*",
                "acta_entrega": "Acta de entrega-recepción*",
                "finiquito_obra": "Finiquito de obra*",
                "nombramiento_residente": "Nombramiento como Residente de Obra o Superintendente de Construcción",
                "notas_bitacora": "Notas de bitácora convencional, notas del Sistema de Bitácora Electrónica de Obra Pública (BEOP) o notas del Sistema de Bitácora Electrónica y Seguimiento a Obra Pública (BESOP)."
            };
            break;
        case 270:
            array = {
                "contrato": "Contrato*",
                "acta_entrega": "Acta de entrega-recepción*",
                "finiquito_obra": "Finiquito de obra*"
            };
            break;
        case 271:
            array = {
                "contrato": "Contrato de obra pública*",
                "fianzas": "Fianzas*",
                "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*",
                "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.",
                "factura_pago": "Factura de pago"
            };
            break;
        case 272:
            array = {
                "contrato": "Contrato de obra pública*",
                "fianzas": "Fianzas*",
                "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*",
                "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.",
                "factura_pago": "Factura de pago",
                "nombramiento_residente": "Nombramiento como Residente de Obra o Superintendente de Construcción"
            };
            break;
        case 273:
            array = {
                "contrato": "Contrato de obra pública*",
                "fianzas": "Fianzas*",
                "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*",
                "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.",
                "factura_pago": "Factura de pago"
            };
            break;
        case 274:
            array = {
                "cedula": "Cedula Profesional*",
                "curp": "CURP*",
                "ife_ine": "IFE o INE*",
                "curriculum_rtec": "Currículum Vitae del Representante Técnico"
            };
            break;
        case 276:
            array = {
                "contrato": "Contrato de obra pública*",
                "fianzas": "Fianzas*",
                "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*",
                "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.",
                "factura_pago": "Factura de pago"
            };
            break;
        case 277:
            array = {
                "contrato": "Contrato de obra pública*",
                "fianzas": "Fianzas*",
                "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*",
                "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.",
                "factura_pago": "Factura de pago"
            };
            break;
        // case 305:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "estado_cuenta": "Estado de cuenta*"
        //     };
        //     break;
        // case 306:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "estado_cuenta": "Estado de cuenta*",
        //         "facturas_xml": "Facturas y xml*",
        //         "contrato": "Contrato*"
        //     };
        //     break;
        // case 307:
        //     array = {
        //         "pagare": "Pagare*",
        //         "estado_cuenta": "Estado de cuenta*",
        //         "contrato": "Contrato*",
        //         "relacion_analitica": "Relación analítica*"
        //     };
        //     break;
        // case 308:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas": "Facturas*",
        //         "estado_cuenta": "Estado de cuenta*",
        //         "contrato": "Contrato*"
        //     };
        //     break;
        // case 309:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas_xml": "Facturas y xml*"
        //     };
        //     break;
        // case 310:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas_xml": "Facturas y xml*"
        //     };
        //     break;
        // case 311:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "escritura_publica": "Escritura Publica*",
        //         "pago_predial": "Pago Predial*",
        //         "avaluo": "Avalúo*"
        //     };
        //     break;
        // case 312:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas_xml": "Facturas y xml*",
        //         "reporte_fotografico": "Reporte Fotográfico*"
        //     };
        //     break;
        // case 313:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas_xml": "Facturas y xml*"
        //     };
        //     break;
        // case 314:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas": "Facturas*",
        //         "pago_refrendo": "Pago Refrendo*",
        //         "tarjeta_circulacion": "Tarjeta/Circulación*"
        //     };
        //     break;
        // case 315:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas_xml": "Facturas y xml*"
        //     };
        //     break;
        // case 316:
        //     array = {
        //         "relacion_analitica": "Relación analítica*",
        //         "facturas_xml": "Facturas y xml*"
        //     };
        //     break;
        // case 317:
            // array = {
            //     "relacion_analitica": "Relación analítica*",
            //     "documentacion_soporte": "Documentación soporte*"
            // };
            // break;
        case 354:
            array = {
                "cedula": "Cedula Profesional*",
                "curp": "CURP*",
                "ife_ine": "IFE o INE*",
                "curriculum_rtec": "Currículum Vitae del Representante Técnico"
            };
            break;
        // case 356:
        //     array = {
        //         "cedula": "Cedula Profesional*",
        //         "rfc": "Constancia de Situación Fiscal Vigente*",
        //         "ife_ine": "IFE o INE*"
        //         "curp": "CURP*",
        //         "comprobante_fiscal": "Comprobante de domicilio fiscal*",
        //         "constancia_colegio": "Constancia del colegio"
        //     };
        //     break;
    }
    return array;
}

function mdl_documento_soporte(id_documento, txt_documento, tipo = 0, alias = 0) {
    $("#id_documento_soporte").val(id_documento);
    $("#mdl_lbl_documento_soporte").html(txt_documento);
    if (alias != 0) {
        $('#div_alias').show();
    } else {
        $('#div_alias').hide();
    }
    let array = fill_soporte(id_documento, tipo);
    let str = "";
    for (let key in array) {
        var value = array[key];
        str += '<div class="form-group row">' + '<label for="files-' + key + '" class="col-form-label col-md-3">' + value + '</label>' + '<div class="col-md-9">' + '<input id="files-' + key + '" type="file" name="files[' + key + ']" class="form-control">' + '<div id="el-files-' + key + '" class="invalid-feedback lbl-error"></div>' + '</div>' + '</div>';
    }
    $("#soporte_variable").html(str);
    $("#mdl_documento_soporte").modal();
}

function clearFileInput() {
    $('input[type=file]').val(null);
}

function messages_validation_soporte(fields, show) {
    if (show == true) {
        $.each(fields, function(key, value) {
            if (key == "files-alias") {
                $('#el-' + key).html(value);
                $('#' + key).addClass('is-invalid');
            } else {
                var aa = key.split(".");
                $('#el-files-' + aa[1]).html(value);
                $('#files-' + aa[1]).addClass('is-invalid');
            }
        });
    } else {
        $('.lbl-error').html("");
        $('.lbl-error').removeClass('is-invalid');
        $('.form-control').removeClass('is-invalid');
    }
}

function mdl_documento_declaracion_anual(id_padre, txt_documento) {
    let url = project_name + "/combos/get-opcionales/" + id_padre;
    $("#mdl_lbl_documento_declaracion_anual").html(txt_documento);
    $.get(url, function(data, textStatus) {
        $("#id_documento_dec_anual").empty();
        $.each(data, function(i, valor) {
            $("#id_documento_dec_anual").append("<option value='" + i + "'>" + valor + "</option>");
        });
    }, "json");
    $("#mdl_documento_declaracion_anual").modal();
}

function upload_tmp(form_name) {
    swal({
        title: "¡ Advertencia !",
        text: "¿ Realmente subir el documento ?",
        icon: "warning",
        buttons: {
            cancel: {
                text: 'Cancelar',
                value: false,
                visible: true,
                className: 'btn btn-default',
                closeModal: true,
            },
            confirm: {
                text: 'Confirmar',
                value: true,
                visible: true,
                className: 'btn btn-primary',
                closeModal: true
            }
        }
    }).then((result) => {
        if (result) {
            $("#" + form_name).submit();
            clearFileInput();
        }
    });
}

function upload_soporte(form_name)
 {
    swal({
        title: "¡ Advertencia !",
        text: "¿ Realmente subir el documento ?",
        icon: "warning",
        buttons: {
            cancel: {
                text: 'Cancelar',
                value: false,
                visible: true,
                className: 'btn btn-default',
                closeModal: true,
            },
            confirm: {
                text: 'Confirmar',
                value: true,
                visible: true,
                className: 'btn btn-primary',
                closeModal: true
            }
        }
    }).then((result) => {
        if (result) {
            $("#" + form_name).submit();
            clearFileInput();
        }
    });
 }

$('#frm-subir-adjunto-tmp').on('submit', function(e) {
    var el = $('#frm-subir-adjunto-tmp');
    e.preventDefault();
    var str_errors;
    $.ajax({
        type: "POST",
        url: el.attr('action'),
        data: new FormData(this),
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('.spinner_wait').show(); 
            $('.spinner_no_wait').hide(); 
            
            
        },        
        success: function(json) {
            messages_validation(json.data, false);
            swal({
                type: 'success',
                title: 'Confirmación',
                content: {
                    element: 'p',
                    attributes: {
                        innerHTML: json.msg,
                    },
                },
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                let id_sujeto = $("#ssjjtt").val();
                let id_tipo_tramite = $("#id_tipo_tramite").val();
                let obligado_dec_isr = $("#obligado_dec_isr").val();

                $('.spinner_wait').hide(); 
                $('.spinner_no_wait').show(); 

                cargar_documentacion_requerida_legal(id_tipo_tramite, 2, json.data.id_registro_temp);
                if (json.data.id_sujeto == 1) {
                    cargar_documentacion_requerida_financiera(id_tipo_tramite, 3, json.data.id_registro_temp, obligado_dec_isr);
                }
                cargar_documentacion_requerida_tecnica(id_tipo_tramite, 4, json.data.id_registro_temp, json.data.tec_acredita_tmp);
                
                $("#mdl_documento_1").modal("toggle");
                
            });
        },
        error: function(json) {
            console.log('error');
            $('.spinner_wait').hide(); 
            $('.spinner_no_wait').show(); 

            var jsonString = json.responseJSON;
            if (json.status === 422) {
                messages_validation(null, false);
                str_errors = 'Hay campos pendientes o que han sido llenados con información incorrecta. <br> Porfavor verifique la información.';
                messages_validation(jsonString.errors, true);
            }
            if (json.status === 409) {
                str_errors = jsonString.msg;
            }
            swal({
                title: "¡ Advertencia !",
                content: {
                    element: 'p',
                    attributes: {
                        innerHTML: str_errors,
                    },
                },
                icon: "warning",
                buttons: {
                    confirm: {
                        text: 'Confirmar',
                        value: true,
                        visible: true,
                        className: 'btn btn-primary',
                        closeModal: true
                    }
                }
            });
        }
    });
});
$('#frm-subir-adjunto-soporte').on('submit', function(e) {
    var el = $('#frm-subir-adjunto-soporte');
    e.preventDefault();
    var str_errors;
    $.ajax({
        type: "POST",
        url: el.attr('action'),
        data: new FormData(this),
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('.spinner_wait').show(); 
            $('.spinner_no_wait').hide(); 
            
            
        },  
        success: function(json) {
            messages_validation_soporte(json.data, false);
            swal({
                type: 'success',
                title: 'Confirmación',
                content: {
                    element: 'p',
                    attributes: {
                        innerHTML: json.msg,
                    },
                },
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                let id_sujeto = $("#ssjjtt").val();
                let id_tipo_tramite = $("#id_tipo_tramite").val();
                let obligado_dec_isr = $("#obligado_dec_isr").val();

                $('.spinner_wait').hide(); 
                $('.spinner_no_wait').show(); 

                cargar_documentacion_requerida_legal(id_tipo_tramite, 2, json.data.id_registro_temp);
                if (json.data.id_sujeto == 1) {
                    cargar_documentacion_requerida_financiera(id_tipo_tramite, 3, json.data.id_registro_temp, obligado_dec_isr);
                }
                cargar_documentacion_requerida_tecnica(id_tipo_tramite, 4, json.data.id_registro_temp, json.data.tec_acredita_tmp);
                $('#files-alias').val("");
                $("#mdl_documento_soporte").modal("toggle");
            });
        },
        error: function(json) {
            $('.spinner_wait').hide(); 
            $('.spinner_no_wait').show(); 

            var jsonString = json.responseJSON;
            if (json.status === 422) {
                messages_validation_soporte(null, false);
                str_errors = 'Hay campos pendientes o que han sido llenados con información incorrecta. <br> Porfavor verifique la información.';
                messages_validation_soporte(jsonString.errors, true);
            }
            if (json.status === 409) {
                str_errors = jsonString.msg;
            }
            swal({
                title: "¡ Advertencia !",
                content: {
                    element: 'p',
                    attributes: {
                        innerHTML: str_errors,
                    },
                },
                icon: "warning",
                buttons: {
                    confirm: {
                        text: 'Confirmar',
                        value: true,
                        visible: true,
                        className: 'btn btn-primary',
                        closeModal: true
                    }
                }
            });
        }
    });
});
$('#frm-subir-adjunto-tmp-dec-anual').on('submit', function(e) {
    var el = $('#frm-subir-adjunto-tmp-dec-anual');
    e.preventDefault();
    var str_errors;
    $.ajax({
        type: "POST",
        url: el.attr('action'),
        data: new FormData(this),
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('.spinner_wait').show(); 
            $('.spinner_no_wait').hide(); 
            
            
        },  
        success: function(json) {
            messages_validation(json.data, false);
            swal({
                type: 'success',
                title: 'Confirmación',
                content: {
                    element: 'p',
                    attributes: {
                        innerHTML: json.msg,
                    },
                },
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                let id_sujeto = $("#ssjjtt").val();
                let id_tipo_tramite = $("#id_tipo_tramite").val();
                let obligado_dec_isr = $("#obligado_dec_isr").val();
                $('.spinner_wait').hide(); 
                $('.spinner_no_wait').show(); 
                
                if (json.data.id_sujeto == 1) {
                    cargar_documentacion_requerida_financiera(id_tipo_tramite, 3, json.data.id_registro_temp, obligado_dec_isr);
                }
                $("#mdl_documento_declaracion_anual").modal("toggle");
            });
        },
        error: function(json) {
            $('.spinner_wait').hide(); 
            $('.spinner_no_wait').show(); 

            var jsonString = json.responseJSON;
            if (json.status === 422) {
                messages_validation(null, false);
                str_errors = 'Hay campos pendientes o que han sido llenados con información incorrecta. <br> Porfavor verifique la información.';
                messages_validation(jsonString.errors, true);
            }
            if (json.status === 409) {
                str_errors = jsonString.msg;
            }
            swal({
                title: "¡ Advertencia !",
                content: {
                    element: 'p',
                    attributes: {
                        innerHTML: str_errors,
                    },
                },
                icon: "warning",
                buttons: {
                    confirm: {
                        text: 'Confirmar',
                        value: true,
                        visible: true,
                        className: 'btn btn-primary',
                        closeModal: true
                    }
                }
            });
        }
    });
});

function cargar_documentacion_requerida_get_n(valor) {
    let str = "";
 
    str += '<ol>';
    $.each(valor.hijos, function(j, hijo1) {
        let objeto_hijo1 = '';
        let lbl_nombre = 'Documento ' + (j + 1);
        if (hijo1.alias != null) {
            lbl_nombre = hijo1.alias;
        }
        str += '<li>';
        if (hijo1.id_tramite_documento != null) {
            let download = project_name + "/tramites-adjuntos/" + hijo1.id_tramite_documento + "/descargar";
            if (hijo1.desglose != null) {
                objeto_hijo1 += '<span class="text-success-dark">' + lbl_nombre + '</span>';
                $.each(hijo1.desglose, function(index, item) {
                    let tt = item.split("_");
                    let download_documento = project_name + "/tramites-adjuntos/" + hijo1.id_tramite_documento + "/descargar-by-name/" + item;
                    objeto_hijo1 += ' | <a href="' + download_documento + '" target="_blank">' + tt[2] + '</a>';
                });
                objeto_hijo1 += ' | <a href="#" onclick="eliminar_adjunto_tmp(' + hijo1.id_tramite_documento + ')" class="text-danger"><i class="far fa-trash-alt"></i></a>';
            } else {
                objeto_hijo1 += '<span class="text-success-dark">' + lbl_nombre + '</span> <a href="' + download + '" class="text-info-dark" target="_blank"><i class="fa fa-download"></i></a> | <a href="#" onclick="eliminar_adjunto_tmp(' + hijo1.id_tramite_documento + ')" class="text-danger"><i class="far fa-trash-alt"></i></a>';
            }
        } else {
            objeto_hijo1 += '<span class="">' + lbl_nombre + '</span>';
        }
        str += objeto_hijo1;
        str += '</li>';
    }, "json");
    str += '</ol>';
    return str;
}

function cargar_documentacion_requerida_get_hijos(valor) {
    let str = "";
    var inputTol = "";  

    if (valor.tiene_hijos == 1) {
        str += '<ol>';
        $.each(valor.hijos, function(j, hijo1) {
            
            let objeto_hijo1 = '';
            let lbl_nombre = hijo1.documento;
            if (hijo1.obligatorio == 1) {
                lbl_nombre += ' <b>(Obligatorio)</b>';
            }
            str += '<li>';
            if (hijo1.id_tramite_documento != null) {
                let download = project_name + "/tramites-adjuntos/" + hijo1.id_tramite_documento + "/descargar";
                objeto_hijo1 += '<span class="text-success-dark">' + lbl_nombre + '</span> <a href="' + download + '" class="text-info-dark" target="_blank"><i class="fa fa-download"></i></a> | <a href="#" onclick="eliminar_adjunto_tmp(' + hijo1.id_tramite_documento + ')" class="text-danger"><i class="far fa-trash-alt"></i></a>';
            } else {
                objeto_hijo1 += '<span class="">' + lbl_nombre + '</span>';
                if (hijo1.subir == 1) {
                    objeto_hijo1 += ' <a href="#" onclick="mdl_documento_1(' + hijo1.id + ', \'' + lbl_nombre + '\')">' + 'Subir</a>';
                }
                if (hijo1.subir_n == 1) {
                    if (hijo1.id_padre == 173 || hijo1.id == 251 || hijo1.id == 252 || hijo1.id == 253 || hijo1.id_padre == 304) {
                        let temp = 0;
                        if (hijo1.id == 266 || hijo1.id == 317) {
                            temp = 1; //Agregar cuenta input para agregar nombre   
                        }
                        objeto_hijo1 += ' <a href="#" onclick="mdl_documento_soporte(' + hijo1.id + ', \'' + lbl_nombre + '\',0,' + temp + ')">' + 'Agregar</a>';
                    } else {
                        objeto_hijo1 += ' <a href="#" onclick="mdl_documento_1(' + hijo1.id + ', \'' + lbl_nombre + '\')">' + 'Agregar</a>';
                    }
                }
            }
            str += objeto_hijo1;
            if (hijo1.tiene_hijos == 1) {
                str += cargar_documentacion_requerida_get_hijos(hijo1);
            }
            if (hijo1.subir_n == 1) {
                str += cargar_documentacion_requerida_get_n(hijo1);
            }
            str += '</li>';
        }, "json");
        str += '</ol>';
    }
    return str;
}