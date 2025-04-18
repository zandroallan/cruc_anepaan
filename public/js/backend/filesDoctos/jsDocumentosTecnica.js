function cargar_documentacion_requerida_tecnica(id_tipo_tramite, id_area, id_registro, tec_acredita_tmp){
    let url = project_name + "/listas/documentacion-requerida/" + id_tipo_tramite + "/registro/" + id_registro + "/area-tecnica/" + tec_acredita_tmp;
    $.get(url, function (data, textStatus) {
        let str= '<ol>';
        $.each(data, function (i, valor) {
            var strTooltip='';
            if ( valor.nota != '' && valor.nota != null ) {
                strTooltip ='<span class="cssToolTip">';
                strTooltip+='   <i class="fas fa-lg fa-fw m-r-10 fa-exclamation-circle text-warning"></i>';
                strTooltip+='   <span><b>InformaciÃ³n</b><br>'+valor.nota+' </span>';
                strTooltip+='</span>';
            }

            let objeto= '';
            let lbl_nombre= valor.documento;
            if ( valor.obligatorio == 1 ) {
                lbl_nombre+=" <b>(Obligatorio)</b>"; 
            }
            

            if(valor.id_tramite_documento!=null){
                let download= project_name + "/tramites-adjuntos/" + valor.id_tramite_documento + "/descargar";  
                objeto+= '<span class="text-success-dark">' + lbl_nombre + '</span> <a href="'+ download +'" class="text-info-dark" target="_blank"><i class="fa fa-download"></i></a> | <a href="#" onclick="eliminar_adjunto_tmp('+ valor.id_tramite_documento +')" class="text-danger"><i class="far fa-trash-alt"></i></a>';
            }
            else {
                objeto+= '<span class="">' + lbl_nombre + strTooltip +' </span>';
                
                if ( valor.obligatorio == 0 && valor.tiene_hijos == 0) {
                    objeto+='<label class="custom-switch">';
                    objeto+='    <span class="custom-switch-description">'+ valor.nota_subir;
                    
                    objeto+='    <input type="checkbox" class="custom-switch-input update_file_'+ i +'" onclick="update_file('+ i +', false);" checked="true">';
                    objeto+='    <span class="custom-switch-indicator"></span>';
                    objeto+='</label>';
                }
                if ( valor.subir == 1 ) {
                    objeto+= ' <a href="#" onclick="mdl_documento_1('+ valor.id+', \''+lbl_nombre +'\')">'+ 'Subir</a>';
                }
                if ( valor.tiene_opcionales == 1 ) {
                    objeto+= ' <a href="#" onclick="mdl_documento_1('+ valor.id+', \''+lbl_nombre +'\')" class="tec_update_file_'+ i +'">'+ 'Agregar</a>';
                }
                if(valor.subir_n==1){
                    if(valor.id==240 || valor.id==244 || valor.id==251 || valor.id==252 || valor.id==256 || valor.id==257 || valor.id==258 || valor.id==259 || valor.id==260 || valor.id==267 || valor.id==268 || valor.id==269 || valor.id==270 || valor.id==271 || valor.id==272 || valor.id==273 || valor.id==274 || valor.id==276 || valor.id==277 || valor.id==354 || valor.id==356) {
                        objeto+= ' <a href="#" onclick="mdl_documento_soporte('+ valor.id+', \''+lbl_nombre +'\','+tec_acredita_tmp+')" class="tec_update_file_'+ i +'">'+ 'Agregar</a>';
                    }
                    else {
                        objeto+= ' <a href="#" onclick="mdl_documento_1('+ valor.id+', \''+lbl_nombre +'\')" class="tec_update_file_'+ i +'">'+ 'Agregar</a>';                        
                    }                    
                }
            }           

            str+= '<li>'; 
            str+= objeto;
            if(valor.tiene_hijos==1){
                str+= cargar_documentacion_requerida_get_hijos(valor);
            }
            if(valor.subir_n==1){
                str+= cargar_documentacion_requerida_get_n(valor);
            }
            str+= '</li>';            
        });
        str+= '</ol>';
        $("#doctos-tecnica").html(str);
    }, "json");
}

function update_file(i, status)
 {
    if ($('.update_file_'+ i).prop('checked')) {
        $('.tec_update_file_'+ i).show();
    }
    else {
        $('.tec_update_file_'+ i).hide();
    }
 }