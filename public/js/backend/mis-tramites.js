var dt_defaultt;

function aceptar_terminos() {
    $.ajax({
        type: "GET",
        url: vuri + '/mis-tramites/condiciones/aceptar',
        success: function(json) {
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
                window.location = vuri + '/mis-tramites/tramite/nuevo';
            });
        },
        error: function(json) {}
    });
}

function send_1(button) {
    if (!clicando) {     

        swal({
            title: "¡ Advertencia !",
            text: "¿ Realmente desea guardar este registro ?",
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
            clicando = false;
            if (result) {
                $("#enviar_stt").val(0);
                guardarTramite();
            } else {
                clicando = false;
            }
        });

    } else {

        swal({
            type: 'info',
            title: 'Notificación',
            text: "Por favor espere un momento, la información esta siendo procesada.",
            icon: "info",
            timer: 1500
        });
    }
}

function send(button) {
    if (!clicando) {
        swal({
            title: "¡ Advertencia !",
            text: "La SHyFP procederá a revisar la documentación adjunta solicitándole los documentos originales al termino para su verificación. Deberá presentar la documentación original para cotejo con los documentos digitales proporcionados en el SIRCSE, en la fecha y hora en que la Secretaría de la Honestidad y Función Pública le notifique, conforme al artículo 6 de los Lineamientos. ¿Desea enviar a tramite?",
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
            clicando = false;
            if (result) {
                $("#enviar_stt").val(1);
                guardarTramite();
            } else {
                clicando = false;
            }
        });
    } else {
        swal({
            type: 'info',
            title: 'Notificación',
            text: "Por favor espere un momento, la información esta siendo procesada.",
            icon: "info",
            timer: 1500
        });
    }
}

function guardarTramite() {
    var el = $('#frm-1');
    var str_errors;
    $.ajax({
        type: "POST",
        url: vuri + '/mis-tramites',
        data: el.serialize(),
        success: function(json) {
            messages_validation(json.data, false);
            swal({
                type: 'success',
                title: 'Confirmación',
                icon: 'success',
                content: {
                    element: 'p',
                    attributes: {
                        innerHTML: json.msg,
                    },
                },
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                ciclando = false;
                if (json.route_redirect != "") {
                    window.location = json.route_redirect;
                }
            });
        },
        error: function(json) {
            ciclando = false;
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
}

function clean_table() {
    dt_defaultt.clear();
    dt_defaultt.destroy();
    $('.dt_default').empty();
}

function cargar_mis_tramites(id_cs)
{
    let url = project_name + "/mis-tramites/expediente/" + id_cs;
    $.get(url, function(data, textStatus) {
        let body = "";
        let j = 1;
        $.each(data, function(i, valor) {
            let f_fin = "-";
            let url_download_constancia = project_name + "/impresion/tramite/constancia-documentos/" + valor.id;
            let url_download_observaciones = project_name + "/impresion/tramite/observaciones/" + valor.id;
            let url_mi_documentacion = project_name + '/mis-tramites/'+ valor.id +'/documentacion';

            if (valor.fecha_fin != null) {
                f_fin = valor.fecha_fin;
            }
            if (valor.id_sujeto_tramite == 1) sujeto_tramite = "Contratista";
            else if (valor.id_sujeto_tramite == 2) sujeto_tramite = "Supervisor";
            body+=' <tr>';
            body+='     <td>'+ j +'</td>';
            body+='     <td>';
            body+='         <strong>';
            body+='             <span class="label label-' + valor.status_color + '">' + valor.folio + '</span>';
            body+='         </strong>';
            body+='     </td>';
            body+='     <td>'+ sujeto_tramite +'</td>';
            body+='     <td>'+ valor.tipo_tramite +'</td>';
            body+='     <td>';
            body+='         <strong>';
            body+='             <span class="label label-' + valor.status_color + '">' + valor.status + '</span>';
            body+='         </strong>';
            body+='     </td>';
            body+='     <td>' + valor.fecha_inicio + '</td>';
            body+='     <td>' + f_fin + '</td>';
            body+='     <td class="text-center">';
            body+='         <a href="' + url_mi_documentacion + '" class="btn ripple btn-secondary btn-icon btn-sm">';
            body+='             <i class="fe fe-file-text fa-lg"></i>';
            body+='         </a>';
            body+='     </td>';
            body+='     <td class="text-center">';
            if (valor.id_c_tramites_seguimiento >= 2) {
                body += '     <a target="_blank" href="' + url_download_observaciones + '" class="btn ripple btn-sm">';
                body += '         <i class="fa fa-print fa-lg"></i>';
                body += '     </a>';
            }
            body+='         <a target="_blank" href="' + url_download_constancia + '" class="btn ripple btn-sm">';
            body+='             <i class="fa fa-print fa-lg"></i>';
            body+='         </a>';
            body+='         <a target="_blank" onclick="modal_contacto(' + valor.id + ');" class="btn ripple btn-sm">';
            body+='             <i class="fa fa-address-card fa-lg"></i>';
            body+='         </a>';
            body+='     </td>';
            body+=' </tr>';
            j++;
        });
        $("#mis-tramites tbody").append(body);
        var myTable= $('#mis-tramites').DataTable({
            language: {
                searchPlaceholder: 'Buscar...',
                sSearch: '',
                lengthMenu: '_MENU_ Registros/pagina'
            },
            lengthChange: false
        });

            //assign a new searchbox for our table
            $('#searchBox').on('keyup', function(){
                myTable.search(this.value).draw();
            });
    
    }, "json");
}

function modal_contacto(id_tramite) {
    $.ajax({
        type: "GET",
        url: vuri + '/mis-tramites/' + id_tramite + '/contacto/get-contacto-tramite',
        success: function(json) {
            limpiarModal();
            if (json.contacto != null) {
                $('#txtNombre').val(json.contacto.nombre);
                $('#txtPaterno').val(json.contacto.ap_paterno);
                $('#txtMaterno').val(json.contacto.ap_materno);
                $('#txtCargo').val(json.contacto.cargo);
                $('#txtClave').val(json.contacto.clave_atencion);
            }
        },
        error: function(json) {}
    });
    $("#modal-message-contacto").modal();
}

function limpiarModal() {
    $('#txtNombre').val('');
    $('#txtPaterno').val('');
    $('#txtMaterno').val('');
    $('#txtCargo').val('');
    $('#txtClave').val('');
}

function cargar_municipios_fiscal(estado) {
    let id_estado = estado.value;
    let url = project_name + "/combos/municipios/" + id_estado;
    $.get(url, function (data, textStatus) {
        $("#id_municipio_fiscal").empty();
        $.each(data, function (i, valor) {
            $("#id_municipio_fiscal").append("<option value='" + i + "'>" + valor + "</option>");
        });
    }, "json");
}

function cargar_municipios_particular(estado) {
    let id_estado = estado.value;
    let url = project_name + "/combos/municipios/" + id_estado;
    $.get(url, function (data, textStatus) {
        $("#id_municipio_particular").empty();
        $.each(data, function (i, valor) {
            $("#id_municipio_particular").append("<option value='" + i + "'>" + valor + "</option>");
        });
    }, "json");
}

function eliminar_adjunto_tmp(id) {
    swal({
        title: '¡ Advertencia !',
        text: "Esta seguro de eliminar este documento adjunto ?",
        icon:               "warning",
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
            var url=$('#frm-destroy-adjunto-tmp').attr('action');
            url= url.replace(/\/[^\/]*$/, '/'+id)
            $('#frm-destroy-adjunto-tmp').attr('action', url).submit();
        }                 
    });
}


$('#frm-destroy-adjunto-tmp').on('submit', function(e) {
    var el = $('#frm-destroy-adjunto-tmp');
    e.preventDefault(); 
    $.ajax({
        type: "DELETE",
        url: el.attr('action'),
        data: $(this).serialize(),
        success: function(json) {
            swal({                
                icon: 'success',
                title: 'Exito',
                content: {
                    element: 'p',
                    attributes: {
                        innerHTML: json.success,
                    },
                },                 
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                var url=$('#frm-destroy-adjunto-tmp').attr('action');
                url= url.replace(/\/[^\/]*$/, '/0');     
                $('#frm-destroy-adjunto-tmp').attr('action', url); 
                let id_sujeto = $("#ssjjtt").val();
                let id_tipo_tramite = $("#id_tipo_tramite").val(); 
                let obligado_dec_isr= $("#obligado_dec_isr").val(); 

                cargar_documentacion_requerida_legal(id_tipo_tramite, 2, json.datos.id_registro_temp);
                if(id_sujeto==1){//solo si es contratista, supervisor lo oculta
                  cargar_documentacion_requerida_financiera(id_tipo_tramite, 3, json.datos.id_registro_temp,obligado_dec_isr);
                }
                cargar_documentacion_requerida_tecnica(id_tipo_tramite, 4, json.datos.id_registro_temp);                
            });
        },
        error: function(json)
        {
            if(json.status === 422) {                   
                var jsonString= json.responseJSON;
                var errors = jsonString.errors;
            } else {
                alert('Ha ocurrido un error inesperado, contacte a su administrador.');
            }
        }           
    });
});
/**********************************************************/
/*function fill_table(url, url_edit, data_search) {
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/js/";

    dt_defaultt = $('#dt_default').DataTable({
        "processing": true,
        "searching": true,
        "responsive": true,
        "language": {
            "url": baseUrl + "spanish.json"
        },
        "ajax": {
            "dataType": 'json',
            "contentType": "application/json; charset=utf-8",
            "type": "GET",
            "url": url,
            "data": data_search,
            "dataSrc": function (jsonData) {
                return jsonData;
            }
        },
        "columns": [
            {
                "data": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                "className": 'text-center',
                "title": "#",
                "width": "10px"
            },
            {
                "data": "id_sujeto",
                "render": function (data) {
                    return (data == 1) ? '<span class="label label-purple">CONTRATISTA</span>' : '<span class="label label-pink">SUPERVISOR</span>';;
                },
                "title": "Sujeto", "width": "60px"
            },
            { "data": "razon_social", "title": "Nombre/Razón social", "className": 'text-left', "width": "450px" },
            {
                "data": "id_tipo_persona",
                "render": function (data) {
                    let tipo_persona = (data == 1) ? 'Física' : 'Moral';
                    return tipo_persona;
                },
                "title": "T. persona", "width": "80px", "className": 'text-center'
            },
            { "data": "rfc", "title": "RFC", "className": 'text-center' },
            {
                "data": { "folio": "folio", "status_color": "status_color" },
                "render": function (data) {
                    let cadena = '<h5><strong><span class="label label-' + data.status_color + '">' + data.folio + '</span></strong></h5>';
                    return cadena;
                },
                "title": "Último trámite", "width": "100px", "className": 'text-center'
            },
            { "data": "fecha_inicio", "title": "Inicio último trámite", "width": "100px", "className": 'text-center' },
            { "data": "fecha_fin", "title": "Fin último trámite", "width": "100px", "className": 'text-center' }, 
            
            {
                "data": "id",
                "render": function (data) {
                    let cadena = "";
                    let newStr = url_edit.replace('_', data);
                    //cadena= "<a href='#' target='_blank' data-uk-tooltip='Documento' title='Documento' class='btn btn-primary btn-circle' onclick='print_qr(\""+data+"\")'><i class='fa fa-qrcode'></i></a> "+ 
                    //cadena+=  "<a href='"+newStr+"' data-uk-tooltip='Nuevo' title='Nuevo' class='btn btn-default btn-icon btn-circle'><i class='fa fa-plus' aria-hidden='true'></i></a> "
                    cadena += "<a href='" + newStr + "' data-uk-tooltip='Expediente' title='Expediente' class='btn btn-primary btn-icon btn-circle'><i class='far fa-address-book' aria-hidden='true'></i></a> ";
                    //cadena+= "<a href='#' data-uk-tooltip='Eliminar' title='Eliminar' class='btn btn-danger btn-icon btn-circle' onclick='destroy(\""+data+"\")'><i class='fa fa-trash'></i></a>" ;

                    return cadena;
                },
                "width": "30px",
                "className": 'text-center'
            }
        ]
    });
    //setInterval(dt_default.ajax.reload, 1000);
}*/
/*function tec_acredita(id_tipo_tramite, id_registro, id_tec) {
    let url = project_name + "/mis-tramites/tramite/"+id_registro+"/tec-acredita/"+id_tec;
    $.get(url, function (json, textStatus) {
        cargar_documentacion_requerida_tecnica(id_tipo_tramite, 4, json.data.id, json.data.tec_acredita_tmp);
    }, "json");  
}


function obligado_dec_isr(id_tipo_tramite, id_registro, id_tec) {
   // muestra o oculta en el area financiera las declaraciones anuales segun elija en el radiobutton  

    let url = project_name + "/mis-tramites/tramite/"+id_registro+"/obligado-dec-isr/"+id_tec;
    $.get(url, function (json, textStatus) {
      //asigno el valor al hidden cada vez que oprime el radiobutton 
      $("#obligado_dec_isr").val(id_tec); 
      cargar_documentacion_requerida_financiera(id_tipo_tramite,3, json.data.id, json.data.obligado_dec_isr);
    }, "json");  

}





function cargar_documentacion_requerida(id_tipo_tramite, id_sujeto) {
    let url = project_name + "/combos/tipotramite/" + id_tipo_tramite + "/documentacion/" + id_sujeto;
    $.get(url, function (data, textStatus) {

        //Area legal
        let string_legal = "";
        $.each(data[2], function (i, valor) {
            const { id, id_area, nombre } = valor;
            string_legal += "<div class='checkbox checkbox-css'><input id='chk-" + id + "' name='docto_recibida[]' type='checkbox' value='" + id + "'/><label for='chk-" + id + "'>" + nombre + "</label></div>";

        });
        $("#doctos-legal").html(string_legal);

        //Area técnica
        let string_tecnica = "";
        $.each(data[4], function (i, valor) {
            const { id, id_area, nombre } = valor;
            string_tecnica += "<div class='checkbox checkbox-css'><input id='chk-" + id + "' name='docto_recibida[]' type='checkbox' value='" + id + "'/><label for='chk-" + id + "'>" + nombre + "</label></div>";

        });
        $("#doctos-tecnica").html(string_tecnica);

        //Area financiera
        let string_financiera = "";
        $.each(data[3], function (i, valor) {
            const { id, id_area, nombre } = valor;
            string_financiera += "<div class='checkbox checkbox-css'><input id='chk-" + id + "' name='docto_recibida[]' type='checkbox' value='" + id + "'/><label for='chk-" + id + "'>" + nombre + "</label></div>";

        });
        $("#doctos-financiera").html(string_financiera);

    }, "json");
}





function download_constancia(id_tramite) {
    let url= project_name + "/impresion/tramite/constancia-documentacion/"+ id_tramite;
    $.get(url, function (data, textStatus) {
    }, "json");    
}

function modal_adjuntos(id_tramite, folio, status_color){
    $("#id_tramite").val(id_tramite);
    $("#modal-folio").html('<strong><span class="label label-' + status_color + '">' + folio + '</span></strong>');
    let url = project_name + "/combos/documentacion/" + id_tramite +"/recibida";
    $.get(url, function (data, textStatus) {
        $("#id_documento").empty();
        let ss="<option value='0'>Seleccionar</option>";
        $.each(data, function (key, valor) {
            ss+='<optgroup label="'+key+'">';
            $.each(valor, function (i, v) {
                ss+="<option value='" + i + "'>" + v + "</option>";
            });
            ss+='</optgroup>';            
        });
        $("#id_documento").append(ss);
    }, "json");
    cargar_documentacion_adjunta(id_tramite);
    $("#modal-message").modal();
}

function eliminar_adjunto(id) {
    let url = project_name + "/tramites-adjuntos/" + id +"/eliminar";
    swal({
        title: '¡ Advertencia !',
        text: "Esta seguro de eliminar este documento adjunto ?",
        icon:               "warning",
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
            var url=$('#frm-destroy-adjunto').attr('action');
            url= url.replace(/\/[^\/]*$/, '/'+id)
            $('#frm-destroy-adjunto').attr('action', url).submit();
        }                 
    });
}

function eliminar_adjunto_tmp(id) {
    swal({
        title: '¡ Advertencia !',
        text: "Esta seguro de eliminar este documento adjunto ?",
        icon:               "warning",
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
            var url=$('#frm-destroy-adjunto-tmp').attr('action');
            url= url.replace(/\/[^\/]*$/, '/'+id)
            $('#frm-destroy-adjunto-tmp').attr('action', url).submit();
        }                 
    });
}

$('#frm-destroy-adjunto').on('submit', function(e) {
    var el = $('#frm-destroy-adjunto');
    e.preventDefault(); 
    $.ajax({
        type: "DELETE",
        url: el.attr('action'),
        data: $(this).serialize(),
        success: function(json) {
            swal({                
                icon: 'success',
                title: 'Exito',
                content: {
                    element: 'p',
                    attributes: {
                        innerHTML: json.success,
                    },
                },                 
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                var url=$('#frm-destroy-adjunto').attr('action');
                url= url.replace(/\/[^\/]*$/, '/0');     
                $('#frm-destroy-adjunto').attr('action', url); 
                cargar_documentacion_adjunta(json.id_tramite);  
            });
        },
        error: function(json)
        {
            if(json.status === 422) {                   
                var jsonString= json.responseJSON;
                var errors = jsonString.errors;
            } else {
                alert('Ha ocurrido un error inesperado, contacte a su administrador.');
            }
        }           
    });
});

$('#frm-destroy-adjunto-tmp').on('submit', function(e) {
    var el = $('#frm-destroy-adjunto-tmp');
    e.preventDefault(); 
    $.ajax({
        type: "DELETE",
        url: el.attr('action'),
        data: $(this).serialize(),
        success: function(json) {
            swal({                
                icon: 'success',
                title: 'Exito',
                content: {
                    element: 'p',
                    attributes: {
                        innerHTML: json.success,
                    },
                },                 
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                var url=$('#frm-destroy-adjunto-tmp').attr('action');
                url= url.replace(/\/[^\/]*$/, '/0');     
                $('#frm-destroy-adjunto-tmp').attr('action', url); 
                let id_sujeto = $("#ssjjtt").val();
                let id_tipo_tramite = $("#id_tipo_tramite").val(); 
                let obligado_dec_isr= $("#obligado_dec_isr").val(); 

                cargar_documentacion_requerida_legal(id_tipo_tramite, 2, json.datos.id_registro_temp);
                if(id_sujeto==1){//solo si es contratista, supervisor lo oculta
                  cargar_documentacion_requerida_financiera(id_tipo_tramite, 3, json.datos.id_registro_temp,obligado_dec_isr);
                }
                cargar_documentacion_requerida_tecnica(id_tipo_tramite, 4, json.datos.id_registro_temp);                
            });
        },
        error: function(json)
        {
            if(json.status === 422) {                   
                var jsonString= json.responseJSON;
                var errors = jsonString.errors;
            } else {
                alert('Ha ocurrido un error inesperado, contacte a su administrador.');
            }
        }           
    });
});


function cargar_documentacion_adjunta(id_tramite) {
    let url = project_name + "/combos/documentacion/" + id_tramite + "/adjunta";
    $.get(url, function (data, textStatus) {       
        
        //Area legal
        let string_legal = "<ol class='list-documentacion'>";
        $.each(data[2], function (i, valor) {
            const { id, nombre } = valor;
            let download= project_name + "/tramites-adjuntos/" + id + "/descargar";           
            string_legal += "<li>"+nombre+" <br><a href='"+download+"' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-download'></i></a> <a href='#' style='display:none' onclick='eliminar_adjunto("+id+")' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-trash'></i></a>";
        });        
        string_legal += "</ol>";        
        $("#doctos-legal").html(string_legal);

        //Area técnica
        let string_tecnica = "<ol class='list-documentacion'>";
        $.each(data[4], function (i, valor) {
            const { id, nombre } = valor;
            let download= project_name + "/tramites-adjuntos/" + id + "/descargar";
            string_tecnica += "<li>"+nombre+" <br><a href='"+download+"' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-download'></i></a> <a style='display:none' href='#' onclick='eliminar_adjunto("+id+")' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-trash'></i></a>";
        });
        string_tecnica += "</ol>";
        $("#doctos-tecnica").html(string_tecnica);

        //Area financiera
        let string_financiera = "<ol class='list-documentacion'>";
        $.each(data[3], function (i, valor) {
            const { id, nombre } = valor;
            let download= project_name + "/tramites-adjuntos/" + id + "/descargar";
            string_financiera += "<li>"+nombre+" <br><a href='"+download+"' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-download'></i></a> <a href='#' style='display:none' onclick='eliminar_adjunto("+id+")' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-trash'></i></a>";
        });
        string_financiera += "</ol>";
        $("#doctos-financiera").html(string_financiera);
    }, "json");
}

function cargar_documentacion_adjunta_tmp(id_registro) {
    let url = project_name + "/combos/documentacion/" + id_registro + "/adjunta-tmp";
    $.get(url, function (data, textStatus) {       
        
        //Area legal
        let string_legal = "<ol class='list-documentacion'>";
        $.each(data[2], function (i, valor) {
            const { id, nombre } = valor;
            let download= project_name + "/tramites-adjuntos/" + id + "/descargar";           
            string_legal += "<li>"+nombre+" <br><a href='"+download+"' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-download'></i></a> <a href='#' onclick='eliminar_adjunto_tmp("+id+")' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-trash'></i></a>";
        });        
        string_legal += "</ol>";        
        $("#doctos-legal").html(string_legal);

        //Area técnica
        let string_tecnica = "<ol class='list-documentacion'>";
        $.each(data[4], function (i, valor) {
            const { id, nombre } = valor;
            let download= project_name + "/tramites-adjuntos/" + id + "/descargar";
            string_tecnica += "<li>"+nombre+" <br><a href='"+download+"' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-download'></i></a> <a href='#' onclick='eliminar_adjunto_tmp("+id+")' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-trash'></i></a>";
        });
        string_tecnica += "</ol>";
        $("#doctos-tecnica").html(string_tecnica);

        //Area financiera
        let string_financiera = "<ol class='list-documentacion'>";
        $.each(data[3], function (i, valor) {
            const { id, nombre } = valor;
            let download= project_name + "/tramites-adjuntos/" + id + "/descargar";
            string_financiera += "<li>"+nombre+" <br><a href='"+download+"' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-download'></i></a> <a href='#' onclick='eliminar_adjunto_tmp("+id+")' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-trash'></i></a>";
        });
        string_financiera += "</ol>";
        $("#doctos-financiera").html(string_financiera);
    }, "json");
}


function upload(button){
    swal({
        title:              "¡ Advertencia !",
        text:               "¿ Realmente subir el documento ?",
        icon:               "warning",
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
            $("#frm-subir-adjunto").submit();  
        }           
    }); 
}

$('#frm-subir-adjunto').on('submit', function(e) {
    var el = $('#frm-subir-adjunto'); e.preventDefault();
    var str_errors;
    $.ajax({
        type:           "POST",
        url:            el.attr('action'),
        data:           new FormData(this),
        processData:    false,
        contentType:    false,       
        success:        function(json) {
                            messages_validation(json.data, false);
                            swal({                                    
                                type:              'success',
                                title:             'Confirmación',
                                content: {
                                    element: 'p',
                                    attributes: {
                                      innerHTML: json.msg,
                                    },
                                }, 
                                showConfirmButton: false,
                                timer:             1500
                            }).then(function() {
                                cargar_documentacion_adjunta(json.data.id_tramite);
                            });
        },
        error: function(json)
        {
            var jsonString= json.responseJSON;
            if(json.status === 422) {
                messages_validation(null, false);
                str_errors= 'Hay campos pendientes o que han sido llenados con información incorrecta. <br> Porfavor verifique la información.';
                messages_validation(jsonString.errors, true);
            } 
            if(json.status === 409) {                
                str_errors= jsonString.msg;                           
             }
            swal({
                title:              "¡ Advertencia !",
                content: {
                    element: 'p',
                    attributes: {
                      innerHTML: str_errors,
                    },
                },  
                icon:               "warning",
               
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



//Cargar observacione
function cargar_observaciones(id_tramite) {    
    let url = project_name + "/tramites/mis-observaciones/" + id_tramite;
    $.get(url, function (data, textStatus) {
        let body = "";
        let j = 1;
        $.each(data, function (i, valor) { 
            body += '<tr>' +
                '<td>' + j + '</td>' +
                '<td>' + valor.documento + '</td>' +
                '<td>' + valor.observacion + '</td>' +              
                '</tr>';
            j++;
        });        
        $("#obs_tbl tbody").html(body);
    }, "json");
}





function save2(button){
    if (!clicando){ 
        swal({
            title:              "¡ Advertencia !",
            text:               "¿ Realmente desea guardar este registro ?",
            icon:               "warning",
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
                clicando= true; 
                $("#enviar_stt").val(0);          
                $("#frm-1").submit();  
            }else{
                clicando= false;
            }
        }); 
    }else{
        swal({                                    
            type:              'info',
            title:             'Notificación',
            text:               "Por favor espere un momento, la información esta siendo procesada.",
            icon:               "info",
            timer:             1500
        });
    }
}








*/
//************************************************************************************
//************************************************************************************
//************************************************************************************
//************************************************************************************
//Nuevo
//Mostrar documentos enviados en el modal, solo descarga 
/*function modal_adjuntos2(id_tramite, folio, status_color){
    $("#id_tramite").val(id_tramite);
    $("#modal-folio").html('<strong><span class="label label-' + status_color + '">' + folio + '</span></strong>');
   
    let tramite_datos= project_name + "/tramite/" + id_tramite + "/datos";
                   
        $.get(tramite_datos, function (data, textStatus) {
          cargar_documentacion_requerida_legal_descarga(data.id_tipo_tramite, 2, id_tramite);
          if(data.id_sujeto!=2){
              
                cargar_documentacion_requerida_financiera_descarga(data.id_tipo_tramite, 3, id_tramite, data.obligado_dec_isr);
          }

          cargar_documentacion_requerida_tecnica_descarga(data.id_tipo_tramite, 4, id_tramite, 0)

       }, "json");
   
    $("#modal-message").modal();
}



function cargar_documentacion_requerida_legal_descarga(id_tipo_tramite, id_area, id_tramite){
    let url = project_name + "/listas/documentacion-descarga/" + id_tipo_tramite + "/tramite/" + id_tramite + "/area/" + id_area;
    $.get(url, function (data, textStatus) {
        let str= '<ol>';
        $.each(data, function (i, valor) {
            let objeto= '';  
            let lbl_nombre= valor.documento;
            if(valor.obligatorio==1){ lbl_nombre+=" <b>(Obligatorio)</b>"; }                         
            if(valor.id_tramite_documento!=null){
                let download= project_name + "/tramites-adjuntos/" + valor.id_tramite_documento + "/descargar";
                objeto+= '<span class="text-green">' + lbl_nombre + '</span> <a href="'+ download +'">Descargar</a>  <a style="display:none" href="#" onclick="eliminar_adjunto_tmp('+ valor.id_tramite_documento +')" class="text-red">Eliminar</a>';
            }else{
                objeto+= '<span class="">' + lbl_nombre+'</span>';
                if(valor.subir==1){
                    objeto+= ' <a style="display:none" href="#" onclick="mdl_documento_1('+ valor.id+', \''+lbl_nombre +'\')">Subir</a>';
                }   
                if(valor.subir_n==1){
                    objeto+= ' <a style="display:none" href="#" onclick="mdl_documento_1('+ valor.id+', \''+lbl_nombre +'\')">Agregar</a>';
                }             
            }
            str+= '<li>'; 
            str+= objeto; 
            str+= cargar_documentacion_requerida_get_hijos_descarga(valor);
            str+= '</li>';            
        });
        str+= '</ol>';
        $("#doctos-legal").html(str);
    }, "json");
}

function cargar_documentacion_requerida_financiera_descarga(id_tipo_tramite, id_area, id_tramite, obligado_dec_isr){
      let url = project_name + "/listas/documentacion-descarga/" + id_tipo_tramite + "/tramite/" + id_tramite + "/area-financiera/" + obligado_dec_isr;

      $.get(url, function (data, textStatus) {
        let str= '<ol>';
        $.each(data, function (i, valor) {
            let objeto= '';
            let lbl_nombre= valor.documento ;
            if(valor.obligatorio==1){ lbl_nombre+=" <b>(Obligatorio)</b>"; }
            if(valor.id_tramite_documento!=null){
                let download= project_name + "/tramites-adjuntos/" + valor.id_tramite_documento + "/descargar";  
                objeto+= '<span class="text-green">' + lbl_nombre + '</span> <a href="'+ download +'">Descargar</a>  <a style="display:none" href="#" onclick="eliminar_adjunto_tmp('+ valor.id_tramite_documento +')" class="text-red">Eliminar</a>';
            }else{
                objeto+= '<span class="">' + lbl_nombre +'</span>';
                if(valor.subir==1){
                    objeto+= ' <a style="display:none" href="#" onclick="mdl_documento_1('+ valor.id+', \''+lbl_nombre +'\')">Subir</a>';
                }
                if(valor.subir_n==1){
                    if(valor.id==356) {  //356 documentacion del contador
                        objeto+= ' <a style="display:none" href="#" onclick="mdl_documento_soporte('+ valor.id+', \''+lbl_nombre +'\',0,0)">Agregar</a>';
                    }else{
                        objeto+= ' <a  style="display:none" href="#" onclick="mdl_documento_1('+ valor.id+', \''+lbl_nombre +'\')">Agregar</a>';                        
                    }
                }
            }
            str+= '<li>'; 
            str+= objeto; 

            if(valor.tiene_hijos==1){
                str+= cargar_documentacion_requerida_get_hijos_descarga(valor);
            }
            if(valor.subir_n==1){
                str+= cargar_documentacion_requerida_get_n_descarga(valor);
            }
            str+= '</li>';            
        });
        str+= '</ol>';
        $("#doctos-financiera").html(str);
    }, "json");
}


function cargar_documentacion_requerida_get_hijos_descarga(valor){
    let str= "";
    if(valor.tiene_hijos==1){
        str+= '<ol>'; 
        $.each(valor.hijos, function (j, hijo1) {
            let objeto_hijo1= '';
            let lbl_nombre= hijo1.documento;
            if(hijo1.obligatorio==1){ lbl_nombre+=" <b>(Obligatorio)</b>"; }
            str+= '<li>';

            if(hijo1.id_tramite_documento!=null){
                let download= project_name + "/tramites-adjuntos/" + hijo1.id_tramite_documento + "/descargar";
                objeto_hijo1+= '<span class="text-green">' + lbl_nombre + '</span> <a href="'+ download +'">Descargar</a>  <a style="display:none" href="#" onclick="eliminar_adjunto_tmp('+ hijo1.id_tramite_documento +')" class="text-red">Eliminar</a>';
            }else{
                objeto_hijo1+= '<span class="">' + lbl_nombre +'</span>';
                if(hijo1.subir==1){
                    objeto_hijo1+= ' <a style="display:none" href="#" onclick="mdl_documento_1('+ hijo1.id+', \''+lbl_nombre +'\')">Subir</a>';
                }
                if(hijo1.subir_n==1){
                    if(hijo1.id_padre==173 || hijo1.id==251 || hijo1.id==252 || hijo1.id==253 || hijo1.id_padre==304){
                        let temp=0;
                        if(hijo1.id==266  || hijo1.id==317){
                            temp=1;   
                        }

                        objeto_hijo1+= ' <a style="display:none" href="#" onclick="mdl_documento_soporte('+ hijo1.id+', \''+lbl_nombre +'\',0,'+temp +')">Agregar</a>';
                    }else{
                        objeto_hijo1+= ' <a style="display:none" href="#" onclick="mdl_documento_1('+ hijo1.id+', \''+lbl_nombre +'\')">Agregar</a>';
                        
                    }
                }
            }
            str+= objeto_hijo1;            
            if(hijo1.tiene_hijos==1){
                str+= cargar_documentacion_requerida_get_hijos_descarga(hijo1);
            }
            if(hijo1.subir_n==1){
                str+= cargar_documentacion_requerida_get_n_descarga(hijo1);
            }
            str+= '</li>';
        }, "json");
        str+= '</ol>';
    }
    return str;
}


function cargar_documentacion_requerida_get_n_descarga(valor){    
    let str= "";
    str+= '<ol>'; 
    $.each(valor.hijos, function (j, hijo1) {
        let objeto_hijo1= '';
        let lbl_nombre= 'Documento '+(j+1);

        if(hijo1.alias!=null){
          lbl_nombre= hijo1.alias;
        }

        str+= '<li>';
        if(hijo1.id_tramite_documento!=null){
            let download= project_name + "/tramites-adjuntos/" + hijo1.id_tramite_documento + "/descargar";
            if(hijo1.desglose!=null){    
                objeto_hijo1+= '<span class="text-green">' + lbl_nombre + '</span>';
                $.each(hijo1.desglose, function(index, item) {
                    let tt= item.split("_");
                    let download_documento= project_name + "/tramites-adjuntos/" + hijo1.id_tramite_documento + "/descargar-by-name/" + item;
                    objeto_hijo1+= ' | <a href="'+ download_documento +'">'+ tt[2] +'</a>';
                });
                objeto_hijo1+= '  <a style="display:none" href="#" onclick="eliminar_adjunto_tmp('+ hijo1.id_tramite_documento +')" class="text-red">Eliminar</a>';
            }else{
                objeto_hijo1+= '<span class="text-green">' + lbl_nombre + '</span> <a href="'+ download +'">Descargar</a>  <a style="display:none" href="#" onclick="eliminar_adjunto_tmp('+ hijo1.id_tramite_documento +')" class="text-red">Eliminar</a>';
            }
        }else{
            objeto_hijo1+= '<span class="">' + lbl_nombre +'</span>';
        }
        str+= objeto_hijo1;
        str+= '</li>';
    }, "json");    
    str+= '</ol>';
    return str;
}


function cargar_documentacion_requerida_tecnica_descarga(id_tipo_tramite, id_area, id_tramite, tec_acredita_tmp){
    let url = project_name + "/listas/documentacion-descarga/" + id_tipo_tramite + "/tramite/" + id_tramite + "/area-tecnica/" + tec_acredita_tmp;
    $.get(url, function (data, textStatus) {
        let str= '<ol>';
        $.each(data, function (i, valor) {
            let objeto= '';
            let lbl_nombre= valor.documento;
            if(valor.obligatorio==1){ lbl_nombre+=" <b>(Obligatorio)</b>"; }
            if(valor.id_tramite_documento!=null){
                let download= project_name + "/tramites-adjuntos/" + valor.id_tramite_documento + "/descargar";  
                objeto+= '<span class="text-green">' + lbl_nombre + '</span> <a href="'+ download +'">Descargar</a>  <a style="display:none" href="#" onclick="eliminar_adjunto_tmp('+ valor.id_tramite_documento +')" class="text-red">Eliminar</a>';
            }else{
                objeto+= '<span class="">' + lbl_nombre;
                if(valor.subir==1){
                    objeto+= ' <a style="display:none" href="#" onclick="mdl_documento_1('+ valor.id+', \''+lbl_nombre +'\')">Subir</a>';
                }
                if(valor.tiene_opcionales==1){
                    objeto+= ' <a style="display:none" href="#" onclick="mdl_documento_1('+ valor.id+', \''+lbl_nombre +'\')">Agregar</a>';
                }
                if(valor.subir_n==1){
                    if(valor.id==240 || valor.id==244 || valor.id==251 || valor.id==252 || valor.id==256 || valor.id==257 || valor.id==258 || valor.id==259 || valor.id==260 || valor.id==267 || valor.id==268 || valor.id==269 || valor.id==270 || valor.id==271 || valor.id==272 || valor.id==273 || valor.id==274 || valor.id==276 || valor.id==277 || valor.id==354 || valor.id==356) {
                        objeto+= ' <a style="display:none" href="#" onclick="mdl_documento_soporte('+ valor.id+', \''+lbl_nombre +'\','+tec_acredita_tmp+')">Agregar</a>';
                    }else{
                        objeto+= ' <a style="display:none" href="#" onclick="mdl_documento_1('+ valor.id+', \''+lbl_nombre +'\')">Agregar</a>';                        
                    }                    
                    
                }
            }
            str+= '<li>'; 
            str+= objeto; 

            if(valor.tiene_hijos==1){
                str+= cargar_documentacion_requerida_get_hijos_descarga(valor);
            }
            if(valor.subir_n==1){
                str+= cargar_documentacion_requerida_get_n_descarga(valor);
            }
            str+= '</li>';            
        });
        str+= '</ol>';
        $("#doctos-tecnica").html(str);
    }, "json");
}
*/