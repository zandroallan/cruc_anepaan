function cargar_documentacion_requerida_financiera(id_tipo_tramite, id_area, id_registro, obligado_dec_isr) {
    let url = project_name + "/listas/documentacion-requerida/" + id_tipo_tramite + "/registro/" + id_registro + "/area-financiera/" + obligado_dec_isr;
    $.get(url, function(data, textStatus) {
        let str = '<ol class="mi-lista">';
        $.each(data, function(i, valor) {
            var strTooltip = '';
            let objeto = '';
            let lbl_nombre = valor.documento;

            if (valor.nota != '' && valor.nota != null){
                strTooltip ='<span class="cssToolTip">';
                strTooltip+='   <i class="fas fa-lg fa-fw m-r-10 fa-exclamation-circle text-warning"></i>';
                strTooltip+='   <span><b>Información</b><br>' + valor.nota + ' </span>';
                strTooltip+='</span>';
            }
            if (valor.obligatorio == 1) {
                lbl_nombre += " <b>(Obligatorio)</b>";
            }
            if (valor.id_tramite_documento != null) {
                let download = project_name + "/tramites-adjuntos/" + valor.id_tramite_documento + "/descargar";
                objeto+='<span class="text-success-dark">' + lbl_nombre + '</span>';
                objeto+='<a href="' + download + '" class="text-info-dark" target="_blank">';
                objeto+='   <i class="fa fa-download"></i>';
                objeto+='</a> |';
                objeto+='<a href="#" onclick="eliminar_adjunto_tmp(' + valor.id_tramite_documento + ')" class="text-danger">';
                objeto+='   <i class="far fa-trash-alt"></i>';
                objeto+='</a>';
            }
            else {
                objeto += '<span class="">' + lbl_nombre + strTooltip + ' </span>';
                if (valor.subir == 1) {
                    objeto += ' <a href="#" onclick="mdl_documento_1(' + valor.id + ', \'' + lbl_nombre + '\')">' + 'Subir</a>';
                }
                if (valor.subir_n == 1) {
                    if (valor.id == 356) { //356 documentacion del contador
                        objeto += ' <a href="#" onclick="mdl_documento_soporte(' + valor.id + ', \'' + lbl_nombre + '\',0,0)">' + 'Agregar</a>';
                    } 
                    else {
                        objeto += ' <a href="#" onclick="mdl_documento_1(' + valor.id + ', \'' + lbl_nombre + '\')">' + 'Agregar</a>';
                    }
                }
            }
            str += '<li>';
            str += objeto;
            if (valor.tiene_hijos == 1) {
                str += cargar_documentacion_requerida_get_hijos(valor);
            }
            if (valor.subir_n == 1) {
                str += cargar_documentacion_requerida_get_n(valor);
            }
            str += '</li>';
        });
        str += '</ol>';
        $("#doctos-financiera").html(str);
    }, "json");
}

function obligado_dec_isr(id_tipo_tramite, id_registro, id_tec)
{
    // muestra o oculta en el area financiera las declaraciones anuales segun elija en el radiobutton  
    let url = project_name + "/mis-tramites/tramite/" + id_registro + "/obligado-dec-isr/" + id_tec;
    $.get(url, function(json, textStatus) {
        //asigno el valor al hidden cada vez que oprime el radiobutton 
        $("#obligado_dec_isr").val(id_tec);
        cargar_documentacion_requerida_financiera(id_tipo_tramite, 3, json.data.id, json.data.obligado_dec_isr);
    }, "json");
}