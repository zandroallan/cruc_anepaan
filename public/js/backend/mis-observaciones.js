var dt_defaultt;

function cargar_mis_observaciones(id_tramite)
 {    
    let url = project_name + "/mis-observaciones/expediente/" + id_tramite;
    $("#mis-observaciones tbody").empty();
    $.get(url, function(data, textStatus) {
        let body = "";
        let j = 1;
        if ( id_tramite != 0 ) {
            $.each(data, function(i, valor) {
                let url_ir_a_observacion = project_name + "/detalle/tramite/observacion/" + valor.id;
                let url_volver_solventar = project_name + "/cambiar/observacion/tramite/" + valor.id;
                
                let vdocumentoPadreHijo = '';
                if (valor.padre == null || valor.padre == '') {
                    vdocumentoPadreHijo = valor.documento;
                } 
                else {
                    vdocumentoPadreHijo = '<strong>' + valor.padre + '</strong> - ' + valor.documento;
                }

                let solventado='';
                if ( valor.solventado == 1 ) solventado='style="background-color: #c9c3e6"';
                
                body += '   <tr '+ solventado +'>';
                body += '       <td>' + j + '</td>';
                body += '           <td>';
                body += '               <b>' + valor.folio + '</b>';
                body += '           </td>';
                body += '       <td>' + vdocumentoPadreHijo + '</td>';
                body += '       <td>' + valor.observacion + '</td>';
                body += '       <td class="text-center">' + valor.area + '</td>';
                body += '       <td class="text-center">';
                body += '           <span class="label label-' + valor.color_status + '">' + valor.status + '</span>';
                body += '       </td>';
                body += '       <td class="text-center">';
                body += '           <div class"btn-icon-list">';
                if ( valor.id_status_tramite >= 5 || valor.id_status_tramite == 3 ) {
                    body += '           <a href="' + url_ir_a_observacion + '" class="btn btn-default btn-icon btn-circle">';
                    body += '               <i class="fa fa-search"></i>';
                    body += '           </a>';
                }
                else if ( valor.id_status_tramite == 4 ) {
                    if (valor.solventado == 0) {
                        body += '       <a class="btn btn-sm ripple btn-outline-info" href="' + url_ir_a_observacion + '" title="Agregar documentos a la observación">';
                        body += '           <i class="fa fa-plus"></i>';
                        body += '       </a>';
                        body += '       <button class="btn btn-sm ripple btn-outline-success" onclick="solventarObservacion(' + valor.id + ')" title="Solventar esta observación">';
                        body += '           <i class="fa fa-save"></i>';
                        body += '       </button>';
                    } 
                    else {
                        body += '       <button class="btn ripple btn-outline-warning btn-sm btn-with-ico" onclick="reloadObservation(' + valor.id + ', ' + id_tramite + ')" title="Desbloquear y volver a cargar solventación">';
                        body += '           <i class="fa fa-unlock"></i> Desbloquear';
                        body += '       </button>';
                    }
                }
                body += '           </div>';
                body += '       </td>';
                body += '   </tr>';
                j++;
            });
        }
        $("#mis-observaciones tbody").append(body);
        
        var myTable=$('#mis-observaciones').DataTable({
            language: {
                searchPlaceholder: 'Buscar...',
                sSearch: '',
                lengthMenu: '_MENU_ Registros/pagina',
            },            
            lengthChange: false
        });

        //assign a new searchbox for our table
        $('#searchBox').on('keyup', function(){
            myTable.search(this.value).draw();
        });
        
    }, "json");
    
 }

function solventarObservacion(idTramiteObservacion)
 {
    swal({
        title: "¡ Advertencia !",
        text: "¿ Realmente desea solventar esta observación?",
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

            $.ajax({
                type: "POST",
                url: project_name + "/tramites/solventaciones/terminar-documento-observacion",
                data: {
                    _token: $('input[name="_token"]').val(),
                    id_observacion: idTramiteObservacion
                },             
                success: function(vjsonRespuesta) {
                    swal({
                        type: 'success',
                        title: 'Solventación de observación!',
                        content: {
                            element: 'p',
                            attributes: {
                                innerHTML: vjsonRespuesta.msg,
                            },
                        },
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function() {
                        if( vjsonRespuesta.rutaRedireccion != "" )
                            window.location=vjsonRespuesta.rutaRedireccion;
                    });                       
                },
                error: function(json) {

                }
            });  
            
        }           
    });                 
 }

function reloadObservation(idTramiteObservacion, idTramite)
 {
    swal({
        title: "¡ Advertencia !",
        text: "¿ Realmente desea poner en OBSERVADO y volver a cargar archivos a la observacion. ?",
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
            $.ajax({
                type: "GET",
                url: project_name + "/cambiar/observacion/" + idTramiteObservacion + "/tramite",
                success: function(vrespuesta) {
                    swal({
                        type: 'success',
                        title: 'Confirmación',
                        content: {
                            element: 'p',
                            attributes: {
                                innerHTML: vrespuesta.message,
                            },
                        },
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        cargar_mis_observaciones(idTramite);
                    });
                },
                error: function(json) {}
            });
        }
    });
 }

function enviar_solventacion(id_tramite)
 {
    let url = project_name + "/tramites/" + id_tramite + "/enviar-solventacion-observacion";
    $.ajax({
        type: "GET",
        url: url,
        success: function(json) {
            window.location.reload();
        },
        error: function(json) {}
    });
 }



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
}

function enviar_solventacion(id_tramite)
 {
    let url= project_name + "/tramites/"+ id_tramite +"/enviar-solventacion-observacion";

    $.ajax({
        type: "GET",
        url: url,     
        success: function(json) {
            window.location.reload();
        },
        error: function(json) { }           
    });
 }
 
function clean_table() {    
    dt_defaultt.clear();
    dt_defaultt.destroy();
    $('.dt_default').empty();
}

function tipo_persona(valor) {
    let t_persona = valor;
    //alert(t_persona);
    if (t_persona == 1) {
        $('.moral').addClass('d-none');
        $('.fisica').removeClass('d-none');
    }
    if (t_persona == 2) {
        $('.moral').removeClass('d-none');
        $('.fisica').addClass('d-none');
    }
}

function cargar_municipios_particular(estado) {
    let id_estado = estado.value;
    let url = project_name + "/combos/municipios/" + id_estado;
    $.get(url, function (data, textStatus) {
        //alert(JSON.stringify(data));
        $("#id_municipio_particular").empty();
        $.each(data, function (i, valor) {
            $("#id_municipio_particular").append("<option value='" + i + "'>" + valor + "</option>");
        });
    }, "json");
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

function cargar_documentacion_requerida(id_tipo_tramite, id_sujeto) {
    let url = project_name + "/combos/tipotramite/" + id_tipo_tramite + "/documentacion/" + id_sujeto;
    //alert(id_sujeto);
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
    //alert(id_tramite);
    $("#id_tramite").val(id_tramite);
    $("#modal-folio").html('<strong><span class="label label-' + status_color + '">' + folio + '</span></strong>');
    let url = project_name + "/combos/documentacion/" + id_tramite +"/recibida";
    $.get(url, function (data, textStatus) {
        //alert(JSON.stringify(data));
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
    //let url = project_name + "/tramites-adjuntos/eliminar/"+id;
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
                cargar_documentacion_adjunta_tmp(json.datos.id_registro_temp);  
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
            string_legal += "<li>"+nombre+" <br><a href='"+download+"' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-download'></i></a> <a href='#' onclick='eliminar_adjunto("+id+")' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-trash'></i></a>";
        });        
        string_legal += "</ol>";        
        $("#doctos-legal").html(string_legal);

        //Area técnica
        let string_tecnica = "<ol class='list-documentacion'>";
        $.each(data[4], function (i, valor) {
            const { id, nombre } = valor;
            let download= project_name + "/tramites-adjuntos/" + id + "/descargar";
            string_tecnica += "<li>"+nombre+" <br><a href='"+download+"' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-download'></i></a> <a href='#' onclick='eliminar_adjunto("+id+")' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-trash'></i></a>";
        });
        string_tecnica += "</ol>";
        $("#doctos-tecnica").html(string_tecnica);

        //Area financiera
        let string_financiera = "<ol class='list-documentacion'>";
        $.each(data[3], function (i, valor) {
            const { id, nombre } = valor;
            let download= project_name + "/tramites-adjuntos/" + id + "/descargar";
            string_financiera += "<li>"+nombre+" <br><a href='"+download+"' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-download'></i></a> <a href='#' onclick='eliminar_adjunto("+id+")' class='btn btn-default btn-icon btn-circle btn-sm'><i class='fa fa-trash'></i></a>";
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
    //buttonpressed= button.attr('name');    
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
        //alert(result);
        if (result) { 
            //alert(1);            
            $("#frm-subir-adjunto").submit();  
        }           
    }); 
}

function upload_tmp(button){
    //buttonpressed= button.attr('name');    
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
        //alert(result);
        if (result) { 
            //alert(1);            
            $("#frm-subir-adjunto-tmp").submit();  
        }           
    }); 
}

$('#frm-subir-adjunto').on('submit', function(e) {
    //alert('dd');
    //var l= $('.'+buttonpressed).ladda(); l.ladda('start');
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
                                //l.ladda('stop');                
                                //if(json.route_redirect!=""){ window.location = json.route_redirect; }                                 
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
            //l.ladda('stop'); 
        }           
    });
});

$('#frm-subir-adjunto-tmp').on('submit', function(e) {
    //var l= $('.'+buttonpressed).ladda(); l.ladda('start');
    var el = $('#frm-subir-adjunto-tmp'); e.preventDefault();
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
                                cargar_documentacion_adjunta_tmp(json.data.id_registro_temp);
                                //l.ladda('stop');                
                                //if(json.route_redirect!=""){ window.location = json.route_redirect; }                                 
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
            //l.ladda('stop'); 
        }           
    });
});

//Cargar observacione
function _cargar_mis_observaciones(id_tramite) {    
    let url = project_name + "/mis-observaciones/expediente/" + id_tramite;
    
    alert('sd');
    $.get(url, function (data, textStatus) {
        let body = "";
        let j = 1;
        $.each(data, function (i, valor) {
            let f_fin = "-";
            let sol = "Sin solventar";       
            let url_ir_a_observacion= project_name + "/detalle/tramite/observacion/"+ valor.id;     
           // if (valor.fecha_fin != null) { f_fin = valor.fecha_fin; }

            let vdocumentoPadreHijo='';                
            if( valor.padre == null || 
                valor.padre == ''
            ){
                vdocumentoPadreHijo=valor.documento;
            }
            else {
                vdocumentoPadreHijo='<strong>' + valor.padre + '</strong> - ' + valor.documento;
            }

            if (valor.solventado == 1) { sol = "Solventado"; }
            body += '<tr>' +
                '<td>' + j + '</td>' +
                '<td>' + '<h5><strong><span class="label label-default">' + valor.folio + '</span></strong></h5>' + '</td>' +
                '<td>' + vdocumentoPadreHijo + '</td>' +
                '<td>' + valor.area + '</td>' +
                '<td>' + sol + '</td>' +                                               
                '<td class="text-center">';
                if (valor.solventado == 0){
                body += '<a href="'+url_ir_a_observacion+'" class="btn btn-default btn-icon btn-circle"><i class="fa fa-arrow-right"></i></a>';                
                }
                body += '</td>' +
                '</tr>';
            j++;
        });        
        $("#mis-observaciones tbody").append(body);
    }, "json");
}




*/