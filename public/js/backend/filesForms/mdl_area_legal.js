var id_tramite_global = 0;
$('#dlg_frm').on('submit', function(e) {
    var el = $('#dlg_frm');
    e.preventDefault();
    var str_errors;
    $.ajax({
        type: "POST",
        url: el.attr('action'),
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(json) {
            messages_validation(json.data, false);
            // swal({
            //     type: 'success',
            //     title: 'Confirmación',
            //     content: {
            //         element: 'p',
            //         attributes: {
            //             innerHTML: json.msg,
            //         },
            //     },
            //     showConfirmButton: false,
            //     timer: 1500
            // }).then(function() {
            //     get_datos_legales(json.data.id_registro_tmp);
            //     $("#mdl_dlg").modal("toggle");
            // });
            $.confirm({
                title: 'Confirmación',
                content: json.msg,
                type: 'green',
                typeAnimated: 'true',
                icon: 'fa fa-check',
                autoClose: 'close|1500',
                buttons: {
                    close: {
                        isHidden: true,
                    },
                },
                onclose: function (json){
                    get_datos_legales(json.data.id_registro_tmp);
                    $("#mdl_dlg").modal("toggle");
                }
            });
        },
        error: function(json) {
            var jsonString = json.responseJSON;
            if (json.status === 422) {
                messages_validation(null, false);
                str_errors = 'Hay campos pendientes o que han sido llenados con información incorreta. <br> Porfavor verifique la información.';
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
                typeAnimated: 'true',
                icon: 'fa fa-warning',
                buttons: {
                    confirmar: {
                        text: 'Confirmar',
                        btnClass: 'btn-primary',
                        action: function() {
                           return true;
                        }
                    },
                },
            });
        }
    });
});

function AddActaConstitutiva() {
    var el = $('#frmAddActaConstitutiva');
    var str_errors;
    $.ajax({
        type: "POST",
        url: project_name + '/tramites-area-legal/store/acta-constitutiva',
        data: el.serialize(),
        success: function(json) {
            messages_validation(json.data, false);
            // swal({
            //     type: 'success',
            //     title: 'Confirmación',
            //     content: {
            //         element: 'p',
            //         attributes: {
            //             innerHTML: json.msg,
            //         },
            //     },
            //     showConfirmButton: false,
            //     timer: 1500
            // }).then(function() {
            //     get_acta_constitutiva(id_tramite_global);
            //     get_acta_constitutiva_modificacion(id_tramite_global);
            //     //oculta_boton_acta_constitutiva(1);
            // });
            $.confirm({
                title: 'Confirmación',
                content: json.msg,
                type: 'green',
                typeAnimated: 'true',
                icon: 'fa fa-check',
                autoClose: 'close|1500',
                buttons: {
                    close: {
                        isHidden: true,
                    },
                },
                onclose: function (){
                    get_acta_constitutiva(id_tramite_global);
                    get_acta_constitutiva_modificacion(id_tramite_global);
                    //oculta_boton_acta_constitutiva(1);
                }
            });
        },
        error: function(json) {
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
                typeAnimated: 'true',
                icon: 'fa fa-warning',
                buttons: {
                    confirmar: {
                        text: 'Confirmar',
                        btnClass: 'btn-primary',
                        action: function() {
                           return true;
                        }
                    },
                },
            });
        }
    });
}
$('#dlrepl_frm').on('submit', function(e) {
    var el = $('#dlrepl_frm');
    e.preventDefault();
    var str_errors;
    $.ajax({
        type: "POST",
        url: el.attr('action'),
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(json) {
            messages_validation(json.data, false);
            // swal({
            //     type: 'success',
            //     title: 'Confirmación',
            //     content: {
            //         element: 'p',
            //         attributes: {
            //             innerHTML: json.msg,
            //         },
            //     },
            //     showConfirmButton: false,
            //     timer: 1500
            // }).then(function() {
            //     //get_representante_legal(json.data.id_tramite);
            //     get_representante_legal(id_tramite_global);
            //     $("#mdl_dlrepl").modal("toggle");
            // });
            $.confirm({
                title: 'Confirmación',
                content: json.msg,
                type: 'green',
                typeAnimated: 'true',
                icon: 'fa fa-check',
                autoClose: 'close|1500',
                buttons: {
                    close: {
                        isHidden: true,
                    },
                },
                onclose: function (){
                    get_representante_legal(id_tramite_global);
                    $("#mdl_dlrepl").modal("toggle");
                }
            });
        },
        error: function(json) {
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
                typeAnimated: 'true',
                icon: 'fa fa-warning',
                buttons: {
                    confirmar: {
                        text: 'Confirmar',
                        btnClass: 'btn-primary',
                        action: function() {
                           return true;
                        }
                    },
                },
            });
        }
    });
});

function AddSocioLegal() {
    var el = $('#frmAddSocioLegal');
    var str_errors;
    $.ajax({
        type: "POST",
        url: project_name + '/tramites-area-legal/store/socio-legal',
        data: el.serialize(),
        success: function(json) {
            messages_validation(json.data, false);
            // swal({
            //     type: 'success',
            //     title: 'Confirmación',
            //     content: {
            //         element: 'p',
            //         attributes: {
            //             innerHTML: json.msg,
            //         },
            //     },
            //     showConfirmButton: false,
            //     timer: 1500
            // }).then(function() {
            //     cargar_socios_legales(id_tramite_global);
            //     $("#mdl_dlscs").modal("toggle");
            // });
            $.confirm({
                title: 'Confirmación',
                content: json.msg,
                type: 'green',
                typeAnimated: 'true',
                icon: 'fa fa-check',
                autoClose: 'close|1500',
                buttons: {
                    close: {
                        isHidden: true,
                    },
                },
                onclose: function (){
                    cargar_socios_legales(id_tramite_global);
                    $("#mdl_dlscs").modal("toggle");
                }
            });
        },
        error: function(json) {
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
                typeAnimated: 'true',
                icon: 'fa fa-warning',
                buttons: {
                    confirmar: {
                        text: 'Confirmar',
                        btnClass: 'btn-primary',
                        action: function() {
                           return true;
                        }
                    },
                },
            });
        }
    });
}

function get_datos_legales(idRegistroTMP) 
 {
     /**
     * Sandro Alan Gomez Aceituno
     * Mostrar datos generales legales
     * 07 de Abril de 2022
     * */

    let url = project_name + "/tramites-area-legal/get/datos-legales/" + idRegistroTMP;
    $.get(url, function(data, textStatus) {
        let vdatoGeneralSocioLegal=false;
        $.each(data, function(key, valor) {
            $("#l_dlg_" + key).html(valor);
            $("#dlg_" + key).val(valor);

            if (!vdatoGeneralSocioLegal) {
                if (valor != '' && key != 'id_registro_tmp') {
                    vdatoGeneralSocioLegal=true;
                    $('#datosGenerales').css('background-color', '#82b548');
                    document.getElementById('_acordionOne').value=1;
                    verificarAreaLegalLLena();
                }
            }
        });
    }, "json");
 }

function get_acta_constitutiva(idRegistroTMP)
 {
    /**
     * Sandro Alan Gomez Aceituno
     * Mostrar datos del acta constitutiva
     * 07 de Abril de 2022
     * */

    let url = project_name + "/tramites-area-legal/get/acta-constitutiva/" + idRegistroTMP;
    $.get(url, 
        function(data, textStatus) {
            let vdatoActaConstitutiva=false;
            $.each(data, function(key, valor) {
                $("#l_dlac_" + key).html(valor);
                if (key == "id_estado" || key == "id_estado_registro") {
                    $("#dlac_" + key).val(valor).trigger('change');
                } 
                else {
                    $("#dlac_" + key).val(valor);
                }

                if (!vdatoActaConstitutiva) {
                    if (valor != '' && key != 'id_registro_tmp') {
                        vdatoActaConstitutiva=true;
                        $("#actaConstitutiva").css('background-color', '#82b548');
                        document.getElementById('_acordionTwo').value=1;
                        verificarAreaLegalLLena();
                    }
                }
            });
        }, "json");
 }

function get_acta_constitutiva_modificacion(idRegistroTMP) {
    let url = project_name + "/tramites-area-legal/get/acta-constitutiva-modificacion/" + idRegistroTMP;
    $.get(url, function(data, textStatus) {
        $.each(data, function(key, valor) {
            $("#l_dlac_" + key + "_m").html(valor);
            if (key == "id_estado" || key == "id_estado_registro") {
                $("#dlac_" + key + "_m").val(valor).trigger('change');
            } else {
                $("#dlac_" + key + "_m").val(valor);
            }
        });
    }, "json");
}

function get_representante_legal(idRegistroTMP) 
 {
   /**
     * Sandro Alan Gomez Aceituno
     * Mostrar datos del representante legal
     * 08 de Abril de 2022
     * */

    let url = project_name + "/tramites-area-legal/get/representante-legal/" + idRegistroTMP;
    $.get(url, function(data, textStatus) {
        let vdatoRepresentanteLegal=false;
        $.each(data, 
            function(key, valor) {
                $("#l_dlrepl_" + key).html(valor);
                if (
                        key == "" ||
                        key == "id_estado_particular" ||
                        key == "id_nacionalidad" ||
                        key == "id_tipo_identificacion" ||
                        key == "id_estado" ||
                        key == "id_estado_registro" ||
                        key == "id_municipio_particular"
                ) {
                    $("#dlrepl_" + key).val(valor).trigger('change');
                    if (key == "id_estado_particular") {}
                    if (key == "id_municipio_particular") {
                        $('#dlrepl_id_municipio_particular option[value=180]').prop('selected', true);
                        $('#dlrepl_id_municipio_particular option[value=' + valor + ']').prop('selected', true);
                    }
                } 
                else {
                    if (key == "sexo") {
                        $("#dlrepl_sexo_1").attr("checked", false);
                        $("#dlrepl_sexo_2").attr("checked", false);
                        $("#dlrepl_sexo_" + valor).attr("checked", true);
                    } 
                    else {
                        $("#dlrepl_" + key).val(valor);
                    }
                }


                if (!vdatoRepresentanteLegal) {
                    if (valor != '' && key != 'id_registro_tmp') {
                        vdatoRepresentanteLegal=true;
                        $("#datosRepresentanteLegal").css('background-color', '#82b548');
                        document.getElementById('_acordionThree').value=1;
                        verificarAreaLegalLLena();
                    }
                }

            }
        );
    }, "json");

    $("#dlrepl_id_municipio_particular").val(180);
}

function verificarAreaLegalLLena()
 {
    let _tipo_persona=document.getElementById('_tipoPersona').value;

    if( parseInt(_tipo_persona) != 1 ) {
        if (
            document.getElementById('_acordionOne').value == 1 &&
            document.getElementById('_acordionTwo').value == 1 &&
            document.getElementById('_acordionThree').value == 1
        ) $('#iconLegal').show();
    }
    else {
        if ( document.getElementById('_acordionOne').value == 1 ) $('#iconLegal').show();
    }
 }

function modal_socio_legal(idRegistroTMP) {
    get_socio_legal(idRegistroTMP);
    $("#mdl_dlscs").modal();
}

function get_socio_legal(idRegistroTMP) {
    let url = project_name + "/tramites/get/socio-legal/" + idRegistroTMP;
    $.get(url, function(data, textStatus) {
        $.each(data, function(key, valor) {
            if (key == "id_estado_particular" || key == "" || key == "id_nacionalidad" || key == "id_tipo_identificacion") {
                $("#dlscs_" + key).val(valor).trigger('change');
            } else {
                if (key == "sexo") {
                    $("#dlscs_sexo_1").attr("checked", false);
                    $("#dlscs_sexo_2").attr("checked", false);
                    $("#dlscs_sexo_" + valor).attr("checked", true);
                } else {
                    $("#dlscs_" + key).val(valor);
                }
            }
        });
    }, "json");
}
//Socios legales
function cargar_socios_legales(id_tramite) {
    let url = project_name + "/tramites/listas/socios-legales/" + id_tramite;
    $.get(url, function(data, textStatus) {
        let body = "";
        let j = 1;
        $.each(data, function(i, valor) {
            body += '<tr>' + '<td>' + j + '</td>' + '<td>' + valor.nombre + " " + valor.ap_paterno + " " + valor.ap_materno + '</td>' + '<td>' + valor.rfc + '</td>' + '<td>' + valor.correo_electronico + '</td>' + '<td class="text-center">' + '<a onclick="modal_socio_legal(' + valor.id + ');" class="btn btn-default btn-icon btn-circle"><i class="fa fa-pen"></i></a>' + '<a onclick="eliminar_socio_legal(' + valor.id + ');" class="btn btn-default btn-icon btn-circle"><i class="fa fa-trash"></i></a>' + '</td>' + '</tr>';
            j++;
        });
        $("#scs_tbl tbody").html(body);
    }, "json");
}