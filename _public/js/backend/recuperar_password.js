function recuperarPass() {
    var el = $('#frmRecuperarPass');
    var str_errors;
    $.ajax({
        type: "POST",
        url: vuri + '/password/recuperar',
        data: el.serialize(),
        success: function(json) {
            messages_validation(json.data, false);
            
            Swal.fire({
                text: json.msg,
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Aceptar",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-primary",
                }
            });

            setTimeout(function() { 
                if (json.route_redirect != "") {
                    window.location = json.route_redirect;
                }
            }, 4000);
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

            Swal.fire({
                html: str_errors,
                icon: "danger",
                buttonsStyling: false,
                confirmButtonText: "Aceptar",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-primary",
                }
            });
        }
    });
}

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