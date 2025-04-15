function cargar_documentacion_requerida_legal(id_tipo_tramite, id_area, id_registro){
    let url = project_name + "/listas/documentacion-requerida/" + id_tipo_tramite + "/registro/" + id_registro + "/area/" + id_area;
    $.get(url, function (data, textStatus) {
       
        let str= '<ol class="mi-lista">';
        $.each(data, function (i, valor) {
            var strTooltip='';

            if(valor.nota!='' && valor.nota!=null)
                strTooltip= '<span class="cssToolTip"><i class="fas fa-lg fa-fw m-r-10 fa-exclamation-circle text-warning"></i><span><b>Información</b><br>'+valor.nota+' </span> </span>';

            let objeto= '';  
            let lbl_nombre=valor.documento;
            if(valor.obligatorio==1){ lbl_nombre+=" <b>(Obligatorio)</b>"; }                         
            if(valor.id_tramite_documento!=null){
                let download= project_name + "/tramites-adjuntos/" + valor.id_tramite_documento + "/descargar";
                objeto+= '<span class="text-success-dark">' + lbl_nombre + '</span> <a href="'+ download +'" class="text-info-dark" target="_blank"><i class="fa fa-download"></i></a> | <a href="#" class="text-danger" onclick="eliminar_adjunto_tmp('+ valor.id_tramite_documento +')"><i class="far fa-trash-alt"></i></a>';
            }else{
                objeto+= '<span class="">' + lbl_nombre + strTooltip +' </span>';
                if(valor.subir==1){
                    objeto+= ' <a href="#" onclick="mdl_documento_1('+ valor.id+', \''+lbl_nombre +'\')">'+ 'Subir</a>';
                }   
                if(valor.subir_n==1){
                    objeto+= ' <a href="#" onclick="mdl_documento_1('+ valor.id+', \''+lbl_nombre +'\')">'+ 'Agregar</a>';
                }           
            }
            str+= '<li>'; 
            str+= objeto; 
            str+= cargar_documentacion_requerida_get_hijos(valor);
            str+= '</li>';            
        });
        str+= '</ol>';
        $("#doctos-legal").html(str);
    }, "json");
}