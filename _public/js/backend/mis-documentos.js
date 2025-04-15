
function cargar_solventaciones(id_tramite)
 {
    let url = project_name + "/tramites/solventaciones/" + id_tramite;
    $("#solventaciones_tbl tbody").empty();
    $.get(url, 
        function(data, textStatus) {
            cargar_nDocumentos(data.n_documentos, id_tramite);
        },
        "json"
    );
}


function cargar_nDocumentos(datos_nDocumentos, id_tramite)
 {
    /**
     * Sandro Alan Gomez Aceituno
     * Funcion en javaScrip para poder descargar los documentos solventados
     * */

    if(datos_nDocumentos.length > 0) {
        let body = "";
        let j = 1;
        $.each(datos_nDocumentos, function(i, valor) {
            if ((valor.id_c_tramites_seguimiento == 3) || (valor.id_c_tramites_seguimiento == 2)) {
                let download = "";
                if ( (valor.id_tramite_documentacion != null) && (valor.desglose == null) ) {
                    let download_url = project_name + "/tramites-adjuntos/" + valor.id_tramite_documentacion + "/descargar";
                    download = '<a href="' + download_url + '" class="btn btn-default btn-icon btn-circle" target="_blank"><i class="fa fa-download"></i></a>';
                } 
                else {
                    var vdocumentosArray = JSON.parse(valor.desglose);
                    $.each(vdocumentosArray, function(l, varrayTramitesDocumentacion) {
                        var vlinkDescargaDocumentoTramiteNombre = project_name + '/tramites-adjuntos/' + valor.id_tramite_documentacion + '/descargar-by-name/' + varrayTramitesDocumentacion;
                        download += ' <a href="' + vlinkDescargaDocumentoTramiteNombre + '" class="btn btn-default btn-icon btn-circle" target="_blank">';
                        download += '     <i class="fa fa-download"></i>';
                        download += ' </a>';
                    });
                }

                body+=' <tr>';
                body+='     <td scope="row">' + j + '</td>';
                // body+='     <td>' + '<h5><strong><span class="label label-default">' + valor.folio + '</span></strong></h5>' + '</td>';
                body+='     <td>' + valor.documento + '</td>';
                body+='     <td>' + valor.observacion + '</td>';
                // body+='     <td>' + valor.observacion_solventacion + '</td>';
                body+='     <td class="text-center">' + valor.area + '</td>';
                // body+='     <td class="text-center"><span class="label label-' + valor.color_status + '">' + valor.status + '</span></td>';
                body+='     <td class="text-center">';
                body+=          download;
                body+='     </td>';
                body += '</tr>';
                j++;
            }
        });
        $("#solventaciones_nDocumentos_tbl tbody").empty().append(body);
    }
 }

/* 
    Documentacion legal
*/
function cargar_documentacion_lega(id_tipo_tramite, id_tramite)
 {
    let url = project_name + "/documentacion/" + id_tipo_tramite + "/tramite/" + id_tramite + "/legal";
    $.get(url, function(data, textStatus) {
        let str = '<ol>';
        $.each(data, function(i, valor) {
            let objeto = '';
            let lbl_nombre = valor.documento;
            if ( valor.obligatorio == 1 ) {
                lbl_nombre += "<b>*</b>";
            }
            if (valor.id_tramite_documento != null) {
                let download = project_name + "/documentacion/adjunta/" + valor.id_tramite_documento + "/descargar";
                if (valor.id_status_area_legal == 2) {
                    objeto += '<span class="text-success">' + lbl_nombre + '</span> <a href="' + download + '">Descargar</a>';
                }
                else {
                    objeto += '<span class="text-success">' + lbl_nombre + '</span> <a href="' + download + '">Descargar</a>';
                }
            } 
            else {
                objeto += '<span class="">' + lbl_nombre + '</span>';
            }
            str+='<li>';
            str+=   objeto;
            str+=   cargar_documentacion_requerida_get_hijos_sin_observacion(valor);
            str+='</li>';
        });
        str += '</ol>';
        $("#doctos-legal").html(str);
    }, "json");
 }

function cargar_documentacion_requerida_get_hijos_sin_observacion(valor)
 {
    let si_no = 0;
    let str = "";
    if (valor.tiene_hijos == 1) {
        str += '<ol>';
        $.each(valor.hijos, function(j, hijo1) {
            let objeto_hijo1 = '';
            let lbl_nombre = hijo1.documento;
            if (hijo1.obligatorio == 1) {
                lbl_nombre += "<b>*</b>";
            }
            str += '<li>';
            if (hijo1.id_tramite_documento != null) {
                let download = project_name + "/documentacion/adjunta/" + hijo1.id_tramite_documento + "/descargar";
                if (valor.id_status_area_financiera == 2) {
                    objeto_hijo1 += '<span class="text-success">' + lbl_nombre + '</span> <a href="' + download + '">Descargar</a>';
                } 
                else {
                    objeto_hijo1 += '<span class="text-success">' + lbl_nombre + '</span> <a href="' + download + '">Descargar</a>';
                }
            } 
            else {
                objeto_hijo1 += '<span class="">' + lbl_nombre + '</span>';
            }
            str += objeto_hijo1;
            if (hijo1.tiene_hijos == 1) {
                str += cargar_documentacion_requerida_get_hijos_sin_observacion(hijo1);
            }
            if (hijo1.subir_n == 1) {
                str += cargar_documentacion_requerida_get_n_sin_observacion(hijo1);
            }
            str += '</li>';
        }, "json");
        str += '</ol>';
    }
    return str;
 }

function cargar_documentacion_requerida_get_n_sin_observacion(valor)
 {
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
            let download = project_name + "/documentacion/adjunta/" + hijo1.id_tramite_documento + "/descargar";
            if (hijo1.desglose != null) {
                objeto_hijo1 += '<span class="text-success">' + lbl_nombre + '</span>';
                $.each(hijo1.desglose, function(index, item) {
                    let tt = item.split("_");
                    let download_documento = project_name + "/documentacion/adjunta/" + hijo1.id_tramite_documento + "/descargar-by-name/" + item;
                    objeto_hijo1 += ' | <a href="' + download_documento + '">' + tt[2] + '</a>';
                });
            } 
            else {
                objeto_hijo1 += '<span class="text-success">' + lbl_nombre + '</span> <a href="' + download + '">Descargar</a>';
            }
        } 
        else {
            objeto_hijo1 += '<span class="">' + lbl_nombre + '</span>';
        }
        str += objeto_hijo1;
        str += '</li>';
    }, "json");
    str += '</ol>';
    return str;
 }


/*
    Documentacion Financiera
*/
function cargar_documentacion_financiera(id_tipo_tramite, id_tramite, obligado_dec_isr) 
{
    let url = project_name + "/documentacion/" + id_tipo_tramite + "/tramite/" + id_tramite + "/financiera/" + obligado_dec_isr;
    $.get(url, function(data, textStatus) {
        let str = '<ol>';
        $.each(data, function(i, valor) {
            let objeto = '';
            let lbl_nombre = valor.documento;
            if (valor.obligatorio == 1) {
                lbl_nombre += "<b>*</b>";
            }
            if (valor.id_tramite_documento != null) {
                let download = project_name + "/documentacion/adjunta/" + valor.id_tramite_documento + "/descargar";
                objeto += '<span class="text-success">' + lbl_nombre + '</span> <a href="' + download + '">Descargar</a>';
            } 
            else {
                objeto += '<span class="">' + lbl_nombre + '</span>';
            }
            str += '<li>';
            str += objeto;
            if (valor.tiene_hijos == 1) {
                str += cargar_documentacion_requerida_get_hijos_financiera(valor);
            }
            if (valor.subir_n == 1) {
                str += cargar_documentacion_requerida_get_n_financiera(valor);
            }
            str += '</li>';
        });
        str += '</ol>';
        $("#doctos-financiera").html(str);
    }, "json");
}

function cargar_documentacion_requerida_get_hijos_financiera(valor) 
 {
    let si_no=0;  
    let str= "";
    if ( valor.tiene_hijos == 1 ) {
        str+= '<ol>'; 
        $.each(valor.hijos, function (j, hijo1) {
            let objeto_hijo1= '';            
            let lbl_nombre= hijo1.documento;                    
                      
            if ( hijo1.obligatorio == 1 ) {
                lbl_nombre+="<b>*</b>";
            }

            str+= '<li>';
            if ( hijo1.id_tramite_documento != null ) {
                let download= project_name + "/documentacion/adjunta/" + hijo1.id_tramite_documento + "/descargar";               
                if ( valor.id_status_area_financiera == 2 ) {
                    objeto_hijo1+= '<span class="text-success">' + lbl_nombre + '</span> <a href="'+ download +'">Descargar</a>';
                }
                else{
                    objeto_hijo1+= '<span class="text-success">' + lbl_nombre + '</span> <a href="'+ download +'">Descargar</a>';
                }
            }
            else {
                objeto_hijo1+= '<span class="">' + lbl_nombre +'</span>';
            }

            str+= objeto_hijo1;            
            if ( hijo1.tiene_hijos == 1 ) {
                str+= cargar_documentacion_requerida_get_hijos_financiera(hijo1);
            }
            if ( hijo1.subir_n == 1 ) {
                str+= cargar_documentacion_requerida_get_n_financiera(hijo1);
            }

            str+= '</li>';
        }, "json");
        str+= '</ol>';
    }
    return str;
 }

function cargar_documentacion_requerida_get_n_financiera(valor) 
 {
    let str= "";
    str+= '<ol>'; 
    $.each(valor.hijos, function (j, hijo1) {
        let objeto_hijo1= '';        
        let lbl_nombre= 'Documento '+(j+1);

        if ( hijo1.alias != null ) {
            lbl_nombre= hijo1.alias;
        }

        str+= '<li>';
        if ( hijo1.id_tramite_documento != null ) {
            let download= project_name + "/documentacion/adjuntos/" + hijo1.id_tramite_documento + "/descargar";
            if ( hijo1.desglose != null ) {    
                objeto_hijo1+= '<span class="text-success">' + lbl_nombre + '</span>';
                $.each(hijo1.desglose, function(index, item) {
                    let tt= item.split("_");
                    let download_documento= project_name + "/documentacion/adjuntos/" + hijo1.id_tramite_documento + "/descargar-by-name/" + item;
                    objeto_hijo1+= ' | <a href="'+ download_documento +'">'+ tt[2] +'</a>';
                });                 
            }
            else {                
                objeto_hijo1+= '<span class="text-success">' + lbl_nombre + '</span> <a href="'+ download +'">Descargar</a>';            
            }
        }
        else{
            objeto_hijo1+= '<span class="">' + lbl_nombre +'</span>';
        }
        
        str+= objeto_hijo1;
        str+= '</li>';
    }, "json");    
    str+= '</ol>';
    return str;
 }

/*
    Documentacion Técnica
*/
function cargar_documentacion_tecnica(id_tipo_tramite, id_tramite, tec_acredita_tmp)
 {
    let url = project_name + "/documentacion/" + id_tipo_tramite + "/tramite/" + id_tramite + "/tecnica/" + tec_acredita_tmp;
    $.get(url, function(data, textStatus) {
        let str = '<ol>';
        $.each(data, function(i, valor) {
            let objeto = '';
            let lbl_nombre = valor.documento;
            if (valor.obligatorio == 1) {
                lbl_nombre += "<b>*</b>";
            }
            if (valor.id_tramite_documento != null) {
                let download = project_name + "/documentacion/adjunta/" + valor.id_tramite_documento + "/descargar";
                objeto += '<span class="text-success">' + lbl_nombre + '</span> <a href="' + download + '">Descargar</a>';
            } 
            else {
                objeto += '<span class="">' + lbl_nombre;
            }
            str += '<li>';
            str += objeto;
            if (valor.tiene_hijos == 1) {
                str += cargar_documentacion_requerida_get_hijos_tec_sin_observacion(valor) + '';
            }
            if (valor.subir_n == 1) {
                str += cargar_documentacion_requerida_get_n_tec_sin_observacion(valor) + '.';
            }
            str += '</li>';
        });
        str += '</ol>';
        $("#doctos-tecnica").html(str);
    }, "json");
 }

function cargar_documentacion_requerida_get_hijos_tec_sin_observacion(valor) 
 {
    let str = "";
    if (valor.tiene_hijos == 1) {
        str += '<ol>';
        $.each(valor.hijos, function(j, hijo1) {
            let objeto_hijo1 = '';
            let lbl_nombre = hijo1.documento;
            if (hijo1.obligatorio == 1) {
                lbl_nombre += "<b>*</b>";
            }
            str += '<li>';
            if (hijo1.id_tramite_documento != null) {
                let download = project_name + "/documentacion/adjunta/" + hijo1.id_tramite_documento + "/descargar";
                objeto_hijo1 += '<span class="text-success">' + lbl_nombre + '</span> <a href="' + download + '">Descargar</a>';
            } 
            else {
                objeto_hijo1 += '<span class="">' + lbl_nombre + '</span>';
            }
            str += objeto_hijo1;
            if (hijo1.tiene_hijos == 1) {
                str += cargar_documentacion_requerida_get_hijos_tec_sin_observacion(hijo1);
            }
            if (hijo1.subir_n == 1) {
                str += cargar_documentacion_requerida_get_n_tec_sin_observacion(hijo1);
            }
            str += '</li>';
        }, "json");
        str += '</ol>';
    }
    return str;
 }

function cargar_documentacion_requerida_get_n_tec_sin_observacion(valor)
 {
    let str = "";
    str += '<ol>';
    $.each(valor.hijos, function(j, hijo1) {
        let objeto_hijo1 = '';
        let lbl_nombre = 'Documento ' + (j + 1);
        str += '<li>';
        if (hijo1.id_tramite_documento != null) {
            let download = project_name + "/documentacion/adjunta/" + hijo1.id_tramite_documento + "/descargar";
            if ( hijo1.desglose != null ) {
                objeto_hijo1 += '<span class="text-success">' + lbl_nombre + '</span>';
                $.each(hijo1.desglose, function(index, item) {
                    let tt = item.split("_");
                    let download_documento = project_name + "/documentacion/adjunta/" + hijo1.id_tramite_documento + "/descargar-by-name/" + item;
                    objeto_hijo1 += ' | <a href="' + download_documento + '">' + tt[2] + '</a>';
                });
            } 
            else {
                objeto_hijo1 += '<span class="text-success">' + lbl_nombre + '</span> <a href="' + download + '">Descargar</a> | <a style="display:none" href="#" onclick="eliminar_adjunto_tmp(' + hijo1.id_tramite_documento + ')" class="text-red">Eliminar</a>';
            }
        } 
        else {
            objeto_hijo1 += '<span class="">' + lbl_nombre + '</span>';
        }
        str += objeto_hijo1;
        str += '</li>';
    }, "json");
    str += '</ol>';
    return str;
 }
