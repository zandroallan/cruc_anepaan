var _id_tramites_documentacion = 0;

$(document).ready(
    function () {
        $('#btnterminarSolventacion').attr('onclick', 'store_end()');
    }
);

function store_end() {

    $.confirm({
        title: '¡ Advertencia !',
        content: '¿ Realmente desea  enviar la solventacion ?',
        type: 'orange', // Equivalente a "warning" en SweetAlert2
        buttons: {
            cancelar: {
                text: 'Cancelar',
                btnClass: 'btn btn-default',
                action: function () {
                    clicando = false;
                }
            },
            confirmar: {
                text: 'Confirmar',
                btnClass: 'btn btn-primary',
                action: function () {
                    send();
                }
            }
        }
    });
}

function send() {
    $.ajax({
        type: "POST",
        url: project_name + "/tramites/solventaciones/terminar-documento-observacion",
        data: $('#myformdocumento').serialize(),
        success: function (vjsonRespuesta) {
            if (vjsonRespuesta.code == 1) {
                $.confirm({
                    title: 'Notificación',
                    content: vjsonRespuesta.msg,
                    type: 'green',
                    typeAnimated: true,
                    autoClose: 'close|1500',
                    buttons: {
                        close: {
                            text: 'Cerrar',
                            isHidden: true
                        }
                    }
                });

                if (vjsonRespuesta.rutaRedireccion != "")
                    window.location = vjsonRespuesta.rutaRedireccion;
            }
        },
        error: function (json) {

        }
    });
}

function cargar_solventaciones(id_tramites_documentacion) {
    _id_tramites_documentacion = id_tramites_documentacion;
    let url = project_name + "/tramites/solventaciones/documento-observacion/" + id_tramites_documentacion;
    let body = "";

    $("#solventaciones_tbl tbody").empty();
    $.get(url, function (data, textStatus) {

        var totalDocumentosSubidos = 0;
        totalDocumentosSubidos = data.length;
        if (totalDocumentosSubidos > 0)
            $('#btnterminarSolventacion').show();
        else
            $('#btnterminarSolventacion').hide();

        let j = 1;
        $.each(data, function (i, valor) {

            let vhtmlDownload = '', vhtmlDelete = '';
            if (valor.desglose == null) {
                let download_url = project_name + "/tramites-adjuntos/" + valor.id_tramite_documentacion + "/descargar";
                vhtmlDownload += '  <a href="' + download_url + '" class="btn btn-icon btn-outline-dark btn-circle btn-sm mr-2" target="_blank">';
                vhtmlDownload += '      <i class="fa fa-download"></i>';
                vhtmlDownload += '  </a>';
            }
            else {
                var vdocumentosArray = JSON.parse(valor.desglose);
                $.each(vdocumentosArray, function (l, varrayTramitesDocumentacion) {
                    var vlinkDescargaDocumentoTramiteNombre = project_name + '/tramites-adjuntos/' + valor.id_tramite_documentacion + '/descargar-by-name/' + varrayTramitesDocumentacion;
                    vhtmlDownload += ' <a href="' + vlinkDescargaDocumentoTramiteNombre + '" class="btn btn-icon btn-outline-dark btn-circle btn-sm mr-2" target="_blank">';
                    vhtmlDownload += '     <i class="fa fa-download"></i>';
                    vhtmlDownload += ' </a>';
                });
            }

            if (valor.id_status_tramite == 4) {
                vhtmlDelete += ' <button onclick="eliminar_solventacion(' + valor.id_tramite_documentacion + ')" class="btn btn-icon btn-outline-danger btn-circle btn-sm mr-2">';
                vhtmlDelete += '     <i class="fa fa-trash"></i>';
                vhtmlDelete += ' </button>';
            }

            body += ' <tr>';
            body += '     <td>' + j + '</td>';
            body += '     <td>' + valor.area + '</td>';
            body += '     <td>' + valor.status + '</td>';
            body += '     <td class="text-center">' + valor.observacion + '</td>';
            body += '     <td class="text-center">' + vhtmlDownload + '</td>';
            body += '     <td class="text-center">' + vhtmlDelete + '</td>';
            body += '</tr>';
            j++;

        });

        $("#solventaciones_tbl tbody").append(body);
    }, "json");
}

function eliminar_solventacion(id_tramite_documentacion) {
    $.confirm({
        title: '¡ Advertencia !',
        content: '¿ Realmente desea  eliminar esta solventacion ?',
        type: 'orange', // Equivalente a "warning" en SweetAlert2
        buttons: {
            cancelar: {
                text: 'Cancelar',
                btnClass: 'btn btn-default',
                action: function () {
                    clicando = false;
                }
            },
            confirmar: {
                text: 'Confirmar',
                btnClass: 'btn btn-primary',
                action: function () {
                    destroySolventacion(id_tramite_documentacion);
                }
            }
        }
    });
}


function destroySolventacion(id_tramite_documentacion) {
    $.ajax({
        type: "GET",
        url: project_name + '/tramites/eliminar/' + id_tramite_documentacion + '/solventacion',
        success: function (vjsonRespuesta) {
            cargar_solventaciones(_id_tramites_documentacion)
            $.confirm({
                title: 'Notificación',
                content: 'Solventacion eliminada correctamente.',
                type: 'blue',
                typeAnimated: true,
                autoClose: 'close|1000',
                buttons: {
                    close: {
                        text: 'Cerrar',
                        isHidden: true
                    }
                }
            });

        },
        error: function (json) { }
    });
}


function cargarInputs(id_documento, tipo = 0, alias = 0) {
    let vhtml = "";
    let varrayDocumento = verificacionDocumentos(id_documento, tipo);

    if (id_documento == 266) {
        vhtml += '    <div class="form-group row m-b-10">';
        vhtml += '        <label for="alias" class="col-form-label col-md-3" style="font-size: 12px">Nombre Cuenta</label>';
        vhtml += '        <div class="col-md-9">';
        vhtml += '            <input type="text" id="alias" name="alias" class="form-control">';
        vhtml += '        </div>';
        vhtml += '    </div>';
    }

    if (varrayDocumento.length != 0) {
        $('#btnterminarSolventacion').show();

        for (let key in varrayDocumento) {
            var vtextoArray = varrayDocumento[key];

            vhtml += '    <div class="form-group row m-b-10">';
            vhtml += '        <label for="file_documento-' + key + '" class="col-form-label col-md-3 text-right" style="font-size: 12px"><b>' + vtextoArray + '</b></label>';
            vhtml += '        <div class="col-md-9">';
            vhtml += '            <input type="file" id="file_documento-' + key + '" name="file_documento[' + key + ']" class="input-file">';
            vhtml += '        </div>';
            vhtml += '    </div>';
        }
    }
    else {
        $('#inputShowButton').val(1);
        $('#btnterminarSolventacion').hide();

        vhtml += '    <div class="form-group row m-b-10">';
        vhtml += '        <label for="id_documento" class="col-form-label col-md-3 text-right" style="font-size: 15px"><b>Solventacion *</b></label>';
        vhtml += '        <div class="col-md-9">';
        vhtml += '            <input type="file" id="file_documento" name="file_documento" class="input-file">';
        vhtml += '            <div id="el-archivosubido" class="invalid-feedback lbl-error"></div>';
        vhtml += '        </div>';
        vhtml += '    </div>';
    }

    $("#vcargarInputsArray").html(vhtml);

    $('input[type="file"]').on('change', function () {
        var ext = $(this).val().split('.').pop();
        if ($(this).val() != '') {
            if (ext == "pdf") {
                // alert("La extensión es: " + ext);
            }
            else {
                $(this).val('');

                // swal({                
                //     icon: 'warning',
                //     title: 'Subir Documento',
                //     content: {
                //         element: 'p',
                //         attributes: {
                //             innerHTML: 'Extensión no permitida',
                //         },
                //     },                 
                //     showConfirmButton: false,
                //     timer: 1500
                // });
                $.confirm({
                    title: 'Subir Documento',
                    content: 'Extensión no permitida',
                    type: 'orange',
                    typeAnimated: true,
                    icon: 'fa fa-warning',
                    autoClose: 'close|1500',
                    buttons: {
                        close: {
                            isHidden: true
                        }
                    }
                });

            }
        }
    });
}

function verificacionDocumentos(id_documento, tipo = 0) {
    let array = [];
    switch (id_documento) {
        case 174:
            array = { "relacion_analitica": "Relación analítica*", "estado_cuenta": "Estado de cuenta*" };
            break;
        case 175:
            array = { "relacion_analitica": "Relación analítica*", "estado_cuenta": "Estado de cuenta*", "facturas_xml": "Facturas y xml*", "contrato": "Contrato*" };
            break;
        case 176:
            array = { "pagare": "Pagare*", "estado_cuenta": "Estado de cuenta*", "contrato": "Contrato*", "relacion_analitica": "Relación analítica*" };
            break;
        case 177:
            array = { "relacion_analitica": "Relación analítica*", "facturas": "Facturas*", "estado_cuenta": "Estado de cuenta*", "contrato": "Contrato*" };
            break;
        case 178:
            array = { "relacion_analitica": "Relación analítica*", "facturas_xml": "Facturas y xml*" };
            break;
        case 179:
            array = { "relacion_analitica": "Relación analítica*", "facturas_xml": "Facturas y xml*" };
            break;
        case 180:
            array = { "relacion_analitica": "Relación analítica*", "escritura_publica": "Escritura Publica*", "pago_predial": "Pago Predial*", "avaluo": "Avalúo*" };
            break;
        case 181:
            array = { "relacion_analitica": "Relación analítica*", "facturas_xml": "Facturas y xml*", "reporte_fotografico": "Reporte Fotográfico*" };
            break;
        case 182:
            array = { "relacion_analitica": "Relación analítica*", "facturas_xml": "Facturas y xml*" };
            break;
        case 183:
            array = { "relacion_analitica": "Relación analítica*", "facturas": "Facturas*", "pago_refrendo": "Pago Refrendo*", "tarjeta_circulacion": "Tarjeta/Circulación*" };
            break;
        case 184:
            array = { "relacion_analitica": "Relación analítica*", "facturas_xml": "Facturas y xml*" };
            break;
        case 185:
            array = { "relacion_analitica": "Relación analítica*", "facturas_xml": "Facturas y xml*" };
            break;
        case 240:
            array = { "contrato": "Contrato*", "acta_entrega": "Acta de entrega-recepción*", "finiquito_obra": "Finiquito de obra*" };
            break;
        case 244:
            array = { "contrato": "Contrato de obra pública*", "fianzas": "Fianzas*", "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*", "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.", "factura_pago": "Factura de pago" };
            break;
        case 251:
            array = { "contrato": "Contrato*", "acta_entrega": "Acta de entrega-recepción*", "finiquito_obra": "Finiquito de obra*", "nombramiento_residente": "Nombramiento como Residente de Obra o Superintendente de Construcción", "notas_bitacora": "Notas de bitácora convencional, notas del Sistema de Bitácora Electrónica de Obra Pública (BEOP) o notas del Sistema de Bitácora Electrónica y Seguimiento a Obra Pública (BESOP)." };
            break;
        case 252:
            array = { "contrato": "Contrato de obra pública*", "fianzas": "Fianzas*", "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*", "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.", "factura_pago": "Factura de pago" };
            break;
        case 256:
            array = { "contrato": "Contrato*", "acta_entrega": "Acta de entrega-recepción*", "finiquito_obra": "Finiquito de obra*" };
            break;
        case 257:
            array = { "contrato": "Contrato de obra pública*", "fianzas": "Fianzas*", "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*", "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.", "factura_pago": "Factura de pago" };
            break;
        case 258:
            array = { "curriculum_empresa": "Currículum Vitae de la persona fisca o moral*", "curriculum_rtec": "Currículum Vitae del Representante Técnico*", "cedula": "Cédula Profesional*", "curp": "CURP*", "ine_ife": "INE O IFE*", "constancia": "Si el representante técnico cuenta con la Constancia de Registro de Contratistas de los últimos tres años a la solicitud." };
            break;
        case 259:
            array = { "constancia_colegio": "Constancia vigente emitida por el Colegio de profesionistas*", "curriculum_empresa": "Currículum Vitae de la persona fisca o moral*", "curriculum_rtec": "Currículum Vitae del Representante Técnico*", "cedula": "Cédula Profesional*", "curp": "CURP*", "ine_ife": "INE O IFE*", "constancia": "Si el representante técnico cuenta con la Constancia de Registro de Contratistas de los últimos tres años a la solicitud." };
            break;
        case 260:
            array = { "contrato": "Contrato*", "acta_entrega": "Acta de entrega-recepción*", "finiquito_obra": "Finiquito de obra*" };
            break;
        case 266:
            array = { "relacion_analitica": "Relación analítica*", "documentacion_soporte": "Documentación soporte*" };
            break;
        case 267:
            array = { "contrato": "Contrato*", "acta_entrega": "Acta de entrega-recepción*", "finiquito_obra": "Finiquito de obra*", "nombramiento_residente": "Nombramiento como Residente de Obra o Superintendente de Construcción", "notas_bitacora": "Notas de bitácora convencional, notas del Sistema de Bitácora Electrónica de Obra Pública (BEOP) o notas del Sistema de Bitácora Electrónica y Seguimiento a Obra Pública (BESOP)." };
            break;
        case 268:
            array = { "contrato": "Contrato*", "acta_entrega": "Acta de entrega-recepción*", "finiquito_obra": "Finiquito de obra*", "nombramiento_residente": "Nombramiento como Residente de Obra o Superintendente de Construcción", "notas_bitacora": "Notas de bitácora convencional, notas del Sistema de Bitácora Electrónica de Obra Pública (BEOP) o notas del Sistema de Bitácora Electrónica y Seguimiento a Obra Pública (BESOP)." };
            break;
        case 269:
            array = { "contrato": "Contrato*", "acta_entrega": "Acta de entrega-recepción*", "finiquito_obra": "Finiquito de obra*", "nombramiento_residente": "Nombramiento como Residente de Obra o Superintendente de Construcción", "notas_bitacora": "Notas de bitácora convencional, notas del Sistema de Bitácora Electrónica de Obra Pública (BEOP) o notas del Sistema de Bitácora Electrónica y Seguimiento a Obra Pública (BESOP)." };
            break;
        case 270:
            array = { "contrato": "Contrato*", "acta_entrega": "Acta de entrega-recepción*", "finiquito_obra": "Finiquito de obra*" };
            break;
        case 271:
            array = { "contrato": "Contrato de obra pública*", "fianzas": "Fianzas*", "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*", "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.", "factura_pago": "Factura de pago" };
            break;
        case 272:
            array = { "contrato": "Contrato de obra pública*", "fianzas": "Fianzas*", "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*", "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.", "factura_pago": "Factura de pago" };
            break;
        case 273:
            array = { "contrato": "Contrato de obra pública*", "fianzas": "Fianzas*", "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*", "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.", "factura_pago": "Factura de pago" };
            break;
        case 274:
            array = { "cedula": "Cedula Profesional*", "curp": "CURP*", "ife_ine": "IFE o INE*", "curriculum_rtec": "Currículum Vitae del Representante Técnico" };
            break;
        case 276:
            array = { "contrato": "Contrato de obra pública*", "fianzas": "Fianzas*", "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*", "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.", "factura_pago": "Factura de pago" };
            break;
        case 277:
            array = { "contrato": "Contrato de obra pública*", "fianzas": "Fianzas*", "reporte_avance": "Reporte del avance físico de la obra del setenta por ciento*", "estimacion": "Estimación completa que incluya resumen físico financiero, números generadores, reporte fotográfico, notas de bitácora.", "factura_pago": "Factura de pago" };
            break;
        case 305:
            array = { "relacion_analitica": "Relación analítica*", "estado_cuenta": "Estado de cuenta*" };
            break;
        case 306:
            array = { "relacion_analitica": "Relación analítica*", "estado_cuenta": "Estado de cuenta*", "facturas_xml": "Facturas y xml*", "contrato": "Contrato*" };
            break;
        case 307:
            array = { "pagare": "Pagare*", "estado_cuenta": "Estado de cuenta*", "contrato": "Contrato*", "relacion_analitica": "Relación analítica*" };
            break;
        case 308:
            array = { "relacion_analitica": "Relación analítica*", "facturas": "Facturas*", "estado_cuenta": "Estado de cuenta*", "contrato": "Contrato*" };
            break;
        case 309:
            array = { "relacion_analitica": "Relación analítica*", "facturas_xml": "Facturas y xml*" };
            break;
        case 310:
            array = { "relacion_analitica": "Relación analítica*", "facturas_xml": "Facturas y xml*" };
            break;
        case 311:
            array = { "relacion_analitica": "Relación analítica*", "escritura_publica": "Escritura Publica*", "pago_predial": "Pago Predial*", "avaluo": "Avalúo*" };
            break;
        case 312:
            array = { "relacion_analitica": "Relación analítica*", "facturas_xml": "Facturas y xml*", "reporte_fotografico": "Reporte Fotográfico*" };
            break;
        case 313:
            array = { "relacion_analitica": "Relación analítica*", "facturas_xml": "Facturas y xml*" };
            break;
        case 314:
            array = { "relacion_analitica": "Relación analítica*", "facturas": "Facturas*", "pago_refrendo": "Pago Refrendo*", "tarjeta_circulacion": "Tarjeta/Circulación*" };
            break;
        case 315:
            array = { "relacion_analitica": "Relación analítica*", "facturas_xml": "Facturas y xml*" };
            break;
        case 316:
            array = { "relacion_analitica": "Relación analítica*", "facturas_xml": "Facturas y xml*" };
            break;
        case 317:
            array = { "relacion_analitica": "Relación analítica*", "documentacion_soporte": "Documentación soporte*" };
            break;
        case 354:
            array = { "cedula": "Cedula Profesional*", "curp": "CURP*", "ife_ine": "IFE o INE*", "curriculum_rtec": "Currículum Vitae del Representante Técnico" };
            break;
        case 356:
            array = { "cedula": "Cedula Profesional*", "rfc": "RFC*", "ife_ine": "IFE o INE*" };
            break;
    }
    console.log(array);
    return array;
}
