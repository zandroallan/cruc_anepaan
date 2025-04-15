var _id_registro_tmp = 0;

function modal_rtec(id) {
    getRepresentanteTecnico(id);
    $("#mdl_dtrtec").modal();
}

function getRepresentanteTecnico(id) {
    let url = project_name + "/tramites/get/representante-tecnico/" + id;

    $.get(url, function (data, textStatus) {

        let id_estado = 0;
        let id_municipio = 0;
        let carga_est_mun = false;

        $.each(data, function (key, valor) {

            if (key == "id_estado_particular")
                id_estado = valor;

            if (key == "id_municipio_particular")
                id_municipio = valor;

            if (id_estado != 0 && id_municipio != 0 && carga_est_mun == false) {
                cargar_municipios_edit(id_estado, "dtrtec_id_municipio_particular", id_municipio);
                carga_est_mun = true;
            }

            if (key == "id_profesion" || key == "id_colegio" || key == "id_tipo_constancia") {
                $("#dtrtec_" + key).val(valor).trigger('change');
            } else {
                $("#dtrtec_" + key).val(valor);
            }
        });

    }, "json");
}

function addRepresentanteTecnico() {
    var el = $('#frmRepresentanteTecnico');
    var str_errors;
    $.ajax({
        type: "POST",
        url: project_name + '/tramites/store/representante-tecnico',
        data: el.serialize(),
        success: function (json) {
            messages_validation(json.data, false);

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
                            $("#mdl_dtrtec").modal("toggle");
                            cargar_rtecs(_id_registro_tmp);
                        }
                    },
                    cancelar: {
                        isHidden: true,
                        action: function () { }
                    },
                }
            });
        },
        error: function (json) {
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
                icon: 'fa fa-warning',
                type: 'orange',
                typeAnimated: true,
                buttons: {
                    confirmar: {
                        text: 'Confirmar',
                        btnClass: 'btn-primary',
                    }
                }
            });
        }
    });
}

function cargar_rtecs(id_registro_tmp) {

    _id_registro_tmp = id_registro_tmp;
    let _vuri = project_name + "/tramites/listas/representante-tecnico/" + id_registro_tmp;
    $.get(_vuri, function (data, textStatus) {
        if (data.length > 0) {
            oculta_boton_Representante(1);
            $('#iconTecnica').show();
            $('#hdRTEC').addClass("head-color");
            $('#hdRTEC').removeClass("head-dark");
        }
        else {
            $('#iconTecnica').hide();
            $('#hdRTEC').removeClass("head-color");
            $('#hdRTEC').addClass("head-dark");
        }

        let vhtml = "";
        let j = 1;
        let k = 1;
        $.each(data, function (i, valor) {
            let tipo_constancia = "Ajena";
            if (valor.id_tipo_constancia == 1) tipo_constancia = "Propia";
            vhtml += '<tr>';
            vhtml += '  <td>' + valor.nombre + " " + valor.ap_paterno + " " + valor.ap_materno + '<br /><b>' + valor.profesion + '</b></td>';
            vhtml += '  <td class="text-center">';
            vhtml += valor.curp;
            vhtml += '  </td>';
            vhtml += '  <td>' + valor.colegio + '</td>';
            vhtml += '  <td>';
            vhtml += '      <b>' + tipo_constancia + '</b><br />' + valor.num_constancia;
            vhtml += '  </td>';
            vhtml += '  <td class="text-center">' + valor.cedula + '</td>';
            vhtml += '  <td class="text-center">';
            vhtml += '      <a href="#" class="btn btn-icon btn-outline-primary btn-circle btn-sm mr-2" onclick="modal_rtec(' + valor.id + ')"><i class="fa fa-pen"></i></a>';
            vhtml += '      <a href="#" class="btn btn-icon btn-outline-danger btn-circle btn-sm mr-2" onclick="destroyRTEC(' + valor.id + ')"><i class="fa fa-trash"></i></a>';
            vhtml += '  </td>';
            vhtml += '</tr>';
            let _vuriII = project_name + "/tramites/get/especialidades-tecnicas-rtec/" + valor.id;
            let string = "";
            $.get(_vuriII, function (data, textStatus) {
                $.each(data, function (i, valor) {
                    const {
                        id,
                        clave,
                        nombre
                    } = valor;
                    string = string + valor.clave + ",";
                });
                $("#dtec_especialidades1_esp_" + k).html(string);
                k = k + 1;
            }, "json");
            j++;
        });
        $("#dtrtec_tbl tbody").html(vhtml);
    }, "json");
}

function oculta_boton_Representante(valor) {
    if (valor == 0) $('#btnRecuperarRTEC').show();
    else $('#btnRecuperarRTEC').hide();
}

function destroyRTEC(id) {

    $.confirm({
        icon: 'fa fa-warning',
        title: 'Confirmar !',
        content: 'Esta seguro de eliminar el representante tecnico ?',
        type: 'dark',
        typeAnimated: true,
        confirmButton: 'Yes i agree',
        cancelButton: 'NO never !',
        buttons: {
            confirmar: function () {
                eliminaRtec(id);
            },
            cancelar: function () {

            }
        },
        animation: 'zoom',
        closeAnimation: 'scale'
    });
}


function eliminaRtec() {
    $.ajax({
        type: "DELETE",
        url: project_name + '/tramites/eliminar/representante-tecnico/' + id,
        data: $('#dtrtec_frm_destroy').serialize(),
        success: function (json) {

            $.confirm({
                icon: 'fa fa-info-circle',
                title: 'Notificacion !',
                content: 'Representante tecnico eliminado correctamente',
                type: 'green',
                typeAnimated: true,
                animation: 'zoom',
                closeAnimation: 'scale',
                autoClose: 'confirmar|1000',
                buttons: {
                    confirmar: {
                        isHidden: true,
                        action: function () {
                            cargar_rtecs(_id_registro_tmp);
                        }
                    },
                    cancelar: {
                        isHidden: true,
                        action: function () { }
                    },
                }
            });
        },
        error: function (json) {
            console.log(json.responseJSON);
            if (json.status === 422) {
                var jsonString = json.responseJSON;
                var errors = jsonString.errors;
            } else {
                alert('Ha ocurrido un error inesperado, contacte a su administrador.');
            }
        }
    });
}



function modal_rtec_esp(id) {
    get_especialidades_tecnicas_rtec(id);
    cargar_especialidades_colegio(id, $("#dtsp_id_especialidad_esp"));
    $("#mdl_dtrtec_esp").modal();
}

function get_especialidades_tecnicas_rtec(id_t_rep_tec) {
    $("#dtsp_id_tramite_esp").val(id_t_rep_tec);
    let url = project_name + "/tramites/get/especialidades-tecnicas-rtec/" + id_t_rep_tec;
    $.get(url, function (data, textStatus) {
        let string1 = "";
        let string2 = "";
        let string3 = "";
        $.each(data, function (i, valor) {
            const {
                id,
                clave,
                nombre
            } = valor;
            let chk = "checked";
            let string = "";
            string = "<div class='checkbox checkbox-css'><input " + chk + " id='chk2-" + id + "' type='checkbox' onclick='eliminar_especialidad_tecnica_rtec(" + id + ", " + id_t_rep_tec + ")'/><label for='chk2-" + id + "'>" + clave + " - " + nombre + " </label></div>";
            if (i < 10) {
                string1 += string;
            } else {
                if (i < 20) {
                    string2 += string;
                } else {
                    string3 += string;
                }
            }
        });
        $("#dtec_especialidades1_esp").html(string1);
        $("#dtec_especialidades2_esp").html(string2);
        $("#dtec_especialidades3_esp").html(string3);
    }, "json");
}

function cargar_especialidades_colegio(id_valor, combo) {
    let id_rtec = id_valor;
    let url = project_name + "/combos/colegios/especialidades/" + id_rtec;
    $.get(url, function (data, textStatus) {
        combo.empty();
        $.each(data, function (i, valor) {
            combo.append("<option value='" + i + "'>" + valor + "</option>");
        });
    }, "json");
}

function AddEspRtec() {
    var el = $('#frmAddEspRtec');
    var str_errors;
    $.ajax({
        type: "POST",
        url: project_name + '/tramites/store/especialidades-rtec',
        data: el.serialize(),
        success: function (json) {
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
            // }).then(function () {
            //     get_especialidades_tecnicas_rtec(json.data.id);
            //     cargar_rtecs(_id_registro_tmp);
            // });
            $.confirm({
                title: 'Confirmación',
                content: json.msg,
                type: 'green',
                typeAnimated: true,
                autoClose: 'close|1500',
                icon: 'fa fa-check',
                buttons: {
                    close: {
                        isHidden: true
                    }
                },
                onClose: function() {
                    get_especialidades_tecnicas_rtec(json.data.id);
                    cargar_rtecs(_id_registro_tmp);
                }
            });
        },
        error: function (json) {
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
                icon: 'fa fa-warning',
                type: 'orange',
                buttons:{
                    confirmar:{
                        text: 'Confirmar',
                        btnClass: 'btn-primary',
                    }
                }
            })
        }
    });
}

function eliminar_especialidad_tecnica_rtec(id, id_t_rep_tec) {
    let url = project_name + "/tramites/" + id_t_rep_tec + "/eliminar/especialidades-tecnicas-rtec/" + id;
    $.get(url, function (data, textStatus) {
        get_especialidades_tecnicas_rtec(id_t_rep_tec);
        cargar_rtecs($("#dtsp_id_tramite_rtec").val());
    }, "json");
}