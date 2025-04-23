function AddContacto() 
{
    var el = $("#frmContacto");
    var str_errors;
    $.ajax({
        type: "POST",
        url: vuri + "/mis-tramites/guardar-contacto",
        data: el.serialize(),
        success: function (json) {
            $("#hdIdContacto").val(json.data.id);
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
            // }).then(function(json) {
            //     cargar_contacto();
            // });
            $.confirm({
                title: 'Confirmación',
                content: json.msg,
                type: 'green',
                typeAnimated: 'true',
                icon: 'fa fa-check',
                autoClose: 'close|1000',
                buttons: {
                    close: {
                        isHidden: true,
                    },
                },
                onclose: function (json) {
                    cargar_contacto();
                }
            });
        },
        error: function (json) {
            var jsonString = json.responseJSON;
            if (json.status === 422) {
                messages_validation(null, false);
                str_errors =
                    "Hay campos pendientes o que han sido llenados con información incorrecta. <br> Porfavor verifique la información.";
                messages_validation(jsonString.errors, true);
            }
            if (json.status === 409) {
                str_errors = jsonString.msg;
            }
            // swal({
            //     title: "¡ Advertencia !",
            //     html: true,
            //     text: str_errors,
            //     type: "warning",
            //     buttons: {
            //         confirm: {
            //             text: "Confirmar",
            //             value: true,
            //             visible: true,
            //             className: "btn btn-primary",
            //             closeModal: true,
            //         },
            //     },
            // });
            $.confirm({
                title: "¡ Advertencia !",
                content: str_errors,
                type: 'orange',
                typeAnimated: 'true',
                icon: 'fa fa-warning',
                buttons: {
                    confirmar: {
                        text: 'Confirmar',
                        btnClass: 'btn btn-primary',
                        action: function () {
                            return true;
                        },
                    }
                },
            });
        },
    });
}

function messages_validation(fields, show) 
{
    if (show == true) {
        $.each(fields, function (key, value) {
            $("#el-" + key).html(value);
            $("#" + key).addClass("is-invalid");
        });
    } else {
        $(".lbl-error").html("");
        $(".lbl-error").removeClass("is-invalid");
        $(".form-control").removeClass("is-invalid");
    }
}

function cargar_contacto() {
    $.ajax({
        type: "GET",
        url: vuri + "/mis-tramites/contacto/get-contacto",
        success: function (json) {
            $("#iconContacto").show();
            $("#nombre_contacto").val(json.contacto.nombre);
            $("#ap_paterno_contacto").val(json.contacto.ap_paterno);
            $("#ap_materno_contacto").val(json.contacto.ap_materno);
            $("#cargo_contacto").val(json.contacto.cargo);
            $("#clave_atencion_contacto").val(json.contacto.clave_atencion);
            $("#telefono_contacto").val(json.contacto.telefono_contacto);
            $("#btn-guardar-contacto").html("Editar contacto");
        },
        error: function (json) { },
    });
}
