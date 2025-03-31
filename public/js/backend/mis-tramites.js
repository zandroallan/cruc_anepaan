var dt_defaultt;

function aceptar_terminos() 
 {
    $.ajax({
        type: "GET",
        url: vuri + '/mis-tramites/condiciones/aceptar',
        success: function(json) {

            $.confirm({   
                icon: 'fa fa-info-circle',
                title: 'Notificacion !',
                content: json.msg,
                type: 'green',       
                typeAnimated: true,
                animation: 'zoom',
                closeAnimation: 'scale',
                autoClose: 'confirmar|1000',
                buttons: {
                    confirmar: {
                        isHidden: true,                
                        action: function () {
                            window.location = vuri + '/mis-tramites/tramite/nuevo';
                        }
                    },
                    cancelar: { 
                        isHidden: true,                
                        action: function () {}
                    },
                }
            }); 
        },
        error: function(json) {}
    });
 }

function send_1(button)
 {
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

    } 
    else {

        swal({
            type: 'info',
            title: 'Notificación',
            text: "Por favor espere un momento, la información esta siendo procesada.",
            icon: "info",
            timer: 1500
        });
    }
 }

function send(button)
{
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

function guardarTramite() 
{
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

function clean_table()
{
    dt_defaultt.clear();
    dt_defaultt.destroy();
    $('.dt_default').empty();
}

function cargar_mis_tramites(id_cs)
{
    $.ajax({
        type: 'GET',
        url: project_name + "/mis-tramites/expediente/" + id_cs,
        dataType: "JSON",
        success: function(vresponse, vtextStatus, vjqXHR) {

            var vhtml ='';
                vhtml+='<table class="table table-hover table-bordered">';
                vhtml+='    <thead class="bg-thead">';
                vhtml+='        <tr>';
                vhtml+='            <th>#</th>';
                vhtml+='            <th>FOLIO</th>';
                // vhtml+='            <th>Sujeto</th>';
                vhtml+='            <th>TIPO DE TRAMITE</th>';
                vhtml+='            <th>ESTATUS</th>';
                vhtml+='            <th>INICIO</th>';
                vhtml+='            <th>FIN</th>';
                vhtml+='            <th><i class="fe fe-book-open"></i></th>';
                vhtml+='            <th class="text-center">';
                vhtml+='                <i class="fe fe-align-center"></i>';
                vhtml+='            </th>';
                vhtml+='        </tr>';
                vhtml+='    </thead>';
                vhtml+='    <tbody>';
                for ( vi=0; vi<vresponse.length; vi++ ) {
                    let f_fin = "-";
                    let url_download_constancia = project_name + "/impresion/tramite/constancia-documentos/" + vresponse[vi].id;
                    let url_download_observaciones = project_name + "/impresion/tramite/observaciones/" + vresponse[vi].id;
                    let url_mi_documentacion = project_name + '/mis-tramites/'+ vresponse[vi].id +'/documentacion';

                    if (vresponse[vi].fecha_fin != null) {
                        f_fin = vresponse[vi].fecha_fin;
                    }
                    // if (vresponse[vi].id_sujeto_tramite == 1) {
                    //     sujeto_tramite = "Contratista";
                    // } 
                    // else if (vresponse[vi].id_sujeto_tramite == 2) {
                    //     sujeto_tramite = "Supervisor";
                    // }

                    vhtml+=' <tr>';
                    vhtml+='     <td>'+ (vi + 1) +'</td>';
                    vhtml+='     <td>';
                    vhtml+='         <strong>';
                    vhtml+='             <span class="label label-inline label-light-' + vresponse[vi].status_color + ' font-weight-bold">' + vresponse[vi].folio + '</span>';
                    vhtml+='         </strong>';
                    vhtml+='     </td>';
                    // vhtml+='     <td>'+ sujeto_tramite +'</td>';
                    vhtml+='     <td>'+ vresponse[vi].tipo_tramite +'</td>';
                    vhtml+='     <td>';
                    vhtml+='         <strong>';
                    vhtml+='             <span class="label label-inline label-light-' + vresponse[vi].status_color + ' font-weight-bold">' + vresponse[vi].status + '</span>';
                    vhtml+='         </strong>';
                    vhtml+='     </td>';
                    vhtml+='     <td>' + vresponse[vi].fecha_inicio + '</td>';
                    vhtml+='     <td>' + f_fin + '</td>';
                    vhtml+='     <td class="text-center">';
                    vhtml+='         <a href="' + url_mi_documentacion + '" class="btn ripple btn-secondary btn-icon btn-sm">';
                    vhtml+='             <i class="fe fe-file-text fa-lg"></i>';
                    vhtml+='         </a>';
                    vhtml+='     </td>';
                    vhtml+='     <td class="text-center">';
                    if (vresponse[vi].id_c_tramites_seguimiento >= 2) {
                        vhtml+= '     <a target="_blank" href="' + url_download_observaciones + '" class="btn ripple btn-sm">';
                        vhtml+= '         <i class="fa fa-print fa-lg"></i>';
                        vhtml+= '     </a>';
                    }
                    vhtml+='         <a target="_blank" href="' + url_download_constancia + '" class="btn ripple btn-sm">';
                    vhtml+='             <i class="fa fa-print fa-lg"></i>';
                    vhtml+='         </a>';
                    vhtml+='         <a target="_blank" onclick="modal_contacto(' + vresponse[vi].id + ');" class="btn ripple btn-sm">';
                    vhtml+='             <i class="fa fa-address-card fa-lg"></i>';
                    vhtml+='         </a>';
                    vhtml+='     </td>';
                    vhtml+=' </tr>';
                }
                vhtml+='    </tbody>';
                vhtml+='</table>';

            $('._response').html(vhtml);

        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });
}

function modal_contacto(id_tramite)
{
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

function limpiarModal() 
{
    $('#txtNombre').val('');
    $('#txtPaterno').val('');
    $('#txtMaterno').val('');
    $('#txtCargo').val('');
    $('#txtClave').val('');
}

function cargar_municipios_fiscal(estado)
{
    let id_estado = estado.value;
    let url = project_name + "/combos/municipios/" + id_estado;
    $.get(url, function (data, textStatus) {
        $("#id_municipio_fiscal").empty();
        $.each(data, function (i, valor) {
            $("#id_municipio_fiscal").append("<option value='" + i + "'>" + valor + "</option>");
        });
    }, "json");
}

function cargar_municipios_particular(estado)
{
    let id_estado = estado.value;
    let url = project_name + "/combos/municipios/" + id_estado;
    $.get(url, function (data, textStatus) {
        $("#id_municipio_particular").empty();
        $.each(data, function (i, valor) {
            $("#id_municipio_particular").append("<option value='" + i + "'>" + valor + "</option>");
        });
    }, "json");
}

function eliminar_adjunto_tmp(id)
{
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