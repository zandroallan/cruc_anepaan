var buttonpressed;
var clicando = false;

function save(button) {
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
            if (result) {
                clicando = true;
                $("#frm-1").submit();
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
$("#b-check-1").click(function() {
    buttonpressed = $(this).attr('name');
    swal({
        title: "¡ Advertencia !",
        text: "¿ Realmente desea enviar a revisión este registro ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#31708f",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.value) {}
    });
});
$('#frm-1').on('submit', function(e) {
    var el = $('#frm-1');
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
                clicando = false;
                if (json.route_redirect != "") {
                    window.location = json.route_redirect;
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
            clicando = false;
        }
    });
});
$(".btn-eliminar").click(function() {
    buttonpressed = $(this).attr('name');
    swal({
        title: '¡ Advertencia !',
        text: "Esta seguro de eliminar los datos?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $(".myformdelete").submit();
        }
    });
});
$('#myform').on('submit', function(e) {
    var l = $('.' + buttonpressed).ladda();
    l.ladda('start');
    var el = $('#myform');
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: el.attr('action'),
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(json) {
            if (json.origin == 'create') {
                clean_form();
            }
            var fields = json.data;
            messages_validation(fields, false);
            swal({
                type: 'success',
                title: 'Exito',
                html: json.success,
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                l.ladda('stop');
                if (json.origin == 'update') {
                    window.location = json.url;
                }
            });
        },
        error: function(json) {
            var jsonString = json.responseJSON;
            if (json.status === 422) {
                messages_validation(null, false);
                swal({
                    type: 'error',
                    title: 'Lo siento',
                    html: 'Se han encontrado <b>errores</b>, favor de verificar los datos.',
                    showConfirmButton: false,
                    timer: 2000
                });
                var errors = jsonString.errors;
                messages_validation(errors, true);
            }
            if (json.status === 409) {
                var errors = jsonString.errors;
                swal({
                    type: 'error',
                    title: 'Error!',
                    html: errors
                });
            }
            l.ladda('stop');
        }
    });
});
$('#myformdelete').on('submit', function(e) {
    var el = $('#myformdelete');
    e.preventDefault();
    $.ajax({
        type: "DELETE",
        url: el.attr('action'),
        data: $(this).serialize(),
        success: function(json) {
            swal({
                type: 'success',
                title: 'Exito',
                html: json.success,
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location = json.url;
            });
        },
        error: function(json) {
            if (json.status === 422) {
                var jsonString = json.responseJSON;
                var errors = jsonString.errors;
            } else {
                alert('Incorrect credentials. Please try again.')
            }
        }
    });
});
$('#myformdeletei').on('submit', function(e) {
    var el = $('#myformdeletei');
    alert(2);
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
                var url = $('.myformdeletei').attr('action');
                url = url.replace(/\/[^\/]*$/, '/0');
                $('.myformdeletei').attr('action', url);
                $('.dt_default').DataTable().ajax.reload();
            });
        },
        error: function(json) {
            if (json.status === 422) {
                var jsonString = json.responseJSON;
                var errors = jsonString.errors;
            } else {
                alert('Incorrect credentials. Please try again.')
            }
        }
    });
});

function messages_validation(fields, show) {
    if (show == true) {
        $.each(fields, function(key, value) {
            $('#el-' + key).html(value);
            $('#' + key).addClass('is-invalid');
        });
    } else {
        $('.lbl-error').html("");
        $('.lbl-error').removeClass('is-invalid');
        $('.form-control').removeClass('is-invalid');
    }
}

function destroy(id) {
    swal({
        title: '¡ Advertencia !',
        text: "Esta seguro de eliminar los datos?",
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
            var url = $('.myformdeletei').attr('action');
            url = url.replace(/\/[^\/]*$/, '/' + id)
            $('.myformdeletei').attr('action', url).submit();
        }
    });
}