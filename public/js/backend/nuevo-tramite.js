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

        // swal({
        //     title: "¡ Advertencia !",
        //     text: "¿ Realmente desea guardar este registro ?",
        //     icon: "warning",
        //     buttons: {
        //         cancel: {
        //             text: 'Cancelar',
        //             value: false,
        //             visible: true,
        //             className: 'btn btn-default',
        //             closeModal: true,
        //         },
        //         confirm: {
        //             text: 'Confirmar',
        //             value: true,
        //             visible: true,
        //             className: 'btn btn-primary',
        //             closeModal: true
        //         }
        //     }
        // }).then((result) => {
        //     clicando = false;
        //     if (result) {
        //         $("#enviar_stt").val(0);
        //         guardarTramite();
        //     } else {
        //         clicando = false;
        //     }
        // });

        $.confirm({
            title: '¡ Advertencia !',
            content: '¿ Realmente desea guardar este registro ?',
            type: 'orange',
            icon: 'fa fa-warning',
            buttons: {
                cancelar: {
                    text: 'Cancelar',
                    btnClass: 'btn btn-default',
                    action: function() {
                        clicando = false;
                    }
                },
                confirmar: {
                    text: 'Confirmar',
                    btnClass: 'btn btn-primary',
                    action: function() {
                        clicando = false;
                        $("#enviar_stt").val(0);
                        guardarTramite();
                        return true;
                    }
                }
            }
        });

    } 
    else {
        // swal({
        //     type: 'info',
        //     title: 'Notificación',
        //     text: "Por favor espere un momento, la información esta siendo procesada.",
        //     icon: "info",
        //     timer: 1500
        // });
        $.confirm({
            title : 'Notificación',
            content : 'Por favor espere un momento, la información esta siendo procesada.',
            type : 'blue',
            typeAnimated : true,
            icon: 'fa fa-spinner fa-spin',
            autoClose : 'close|1500',
            buttons: {
                close: {
                    text: 'Cerrar',
                    isHidden: true // Botón oculto pero necesario para autoClose
                }
            }
        });
    }
}


function send(button)
{
    if (!clicando) {
        $.confirm({
            title: '¡ Advertencia !',
            content: 'La SAyBG procederá a revisar la documentación adjunta solicitándole los documentos originales al termino para su verificación. Deberá presentar la documentación original para cotejo con los documentos digitales proporcionados en el SIRCSE, en la fecha y hora en que la Secretaría Anticorrupción y Buen Gobierno le notifique, conforme al artículo 6 de los Lineamientos. ¿Desea enviar a tramite?',
            type: 'orange',
            icon: 'fa fa-warning',
            buttons: {
                cancelar: {
                    text: 'Cancelar',
                    btnClass: 'btn btn-default',
                    action: function() {
                        clicando = false;
                        return true;
                    }
                },
                confirmar: {
                    text: 'Confirmar',
                    btnClass: 'btn btn-primary',
                    action: function() {
                        clicando = false;
                        $("#enviar_stt").val(1);
                        guardarTramite();
                        return true;
                    }
                }
            }
        });
    } 
    else {
        $.confirm({
            title: 'Notificación',
            content: 'Por favor espere un momento, la información esta siendo procesada.',
            type: 'blue',
            typeAnimated: true,
            con: 'fa fa-spinner fa-spin',
            autoClose: 'close|1500',
            buttons: {
                close: {
                    text: 'Cerrar',
                    isHidden: true
                }
            }
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
            // swal({
            //     type: 'success',
            //     title: 'Confirmación',
            //     icon: 'success',
            //     content: {
            //         element: 'p',
            //         attributes: {
            //             innerHTML: json.msg,
            //         },
            //     },
            //     showConfirmButton: false,
            //     timer: 1500
            // }).then(function() {
            //     ciclando = false;
            //     if (json.route_redirect != "") {
            //         window.location = json.route_redirect;
            //     }
            // });
            $.confirm({
                title: 'Confirmación',
                content: json.msg,
                type: 'green',
                typeAnimated: true,
                icon: 'fa fa-check',
                autoClose: 'close|1500',
                buttons: {
                    close: {
                        isHidden: true
                    }
                },
                onClose: function() {
                    ciclando = false;
                    if ( json.route_redirect != "" ) {
                        window.location = json.route_redirect;
                    }
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

            // swal({
            //     title: "¡ Advertencia !",
            //     content: {
            //         element: 'p',
            //         attributes: {
            //             innerHTML: str_errors,
            //         },
            //     },
            //     icon: "warning",
            //     buttons: {
            //         confirm: {
            //             text: 'Confirmar',
            //             value: true,
            //             visible: true,
            //             className: 'btn btn-primary',
            //             closeModal: true
            //         }
            //     }
            // });
            $.confirm({
                title: '¡ Advertencia !',
                content: str_errors,
                type: 'orange',
                typeAnimated: true,
                icon: 'fa fa-warning',
                buttons: {
                    confirmar: {
                        text: 'Confirmar',
                        btnClass: 'btn btn-primary',
                        action: function() {
                            return true;
                        }
                    }
                }
            });
        }
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
    // swal({
    //     title: '¡ Advertencia !',
    //     text: "Esta seguro de eliminar este documento adjunto ?",
    //     icon:               "warning",
    //     buttons: {
    //         cancel: {
    //             text: 'Cancelar',
    //             value: false,
    //             visible: true,
    //             className: 'btn btn-default',
    //             closeModal: true,
    //         },
    //         confirm: {
    //             text: 'Confirmar',
    //             value: true,
    //             visible: true,
    //             className: 'btn btn-primary',
    //             closeModal: true
    //         }
    //     }
    // }).then((result) => { 
    //     if (result) {             
    //         var url=$('#frm-destroy-adjunto-tmp').attr('action');
    //         url= url.replace(/\/[^\/]*$/, '/'+id)
    //         $('#frm-destroy-adjunto-tmp').attr('action', url).submit();
    //     }                 
    // });

    $.confirm({
        title: '¡ Advertencia !',
        content: "Esta seguro de eliminar este documento adjunto ?",
        type: 'orange',
        icon: 'fa fa-warning',
        typeAnimated: true,
        buttons: {
            cancelar: {
                text: 'Cancelar',
                btnClass: 'btn btn-default',
                action: function() {
                    return true;
                }
            },
            confirmar: {
                text: 'Confirmar',
                btnClass: 'btn btn-primary',
                action: function() {
                    var url = $('#frm-destroy-adjunto-tmp').attr('action');
                    url = url.replace(/\/[^\/]*$/, '/'+id);
                    $('#frm-destroy-adjunto-tmp').attr('action', url).submit();
                    return true;
                }
            }
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

            $.alert({
                title: 'Mensaje!',
                content: json.success,
                type: 'red', // info | red | green | orange | dark | etc.
                buttons: {
                    ok: {
                        text: 'Entendido',
                        btnClass: 'btn-blue',
                        action: function() {
                            // 
                            var url = $('#frm-destroy-adjunto-tmp').attr('action');
                            url = url.replace(/\/[^\/]*$/, '/0');     
                            $('#frm-destroy-adjunto-tmp').attr('action', url); 
                            let id_sujeto = $("#ssjjtt").val();
                            let id_tipo_tramite = $("#id_tipo_tramite").val(); 
                            let obligado_dec_isr = $("#obligado_dec_isr").val(); 
                    
                            cargar_documentacion_requerida_legal(id_tipo_tramite, 2, json.datos.id_registro_temp);
                            if(id_sujeto == 1) { // solo si es contratista, supervisor lo oculta
                                cargar_documentacion_requerida_financiera(id_tipo_tramite, 3, json.datos.id_registro_temp, obligado_dec_isr);
                            }
                            cargar_documentacion_requerida_tecnica(id_tipo_tramite, 4, json.datos.id_registro_temp);
                            // 
                        }
                    }
                }
            });

        },
        error: function(json) {
            if ( json.status === 422 ) {                   
                var jsonString= json.responseJSON;
                var errors = jsonString.errors;
            } 
            else {
                alert('Ha ocurrido un error inesperado, contacte a su administrador.');
            }
        }           
    });
});

