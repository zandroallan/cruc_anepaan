//Socios legales
function cargar_socios_legales(id_tramite) {
    let url = project_name + "/mis-tramites/listas/socios-legales/" + id_tramite;
    
    $.get(url, function(data, textStatus) {
        let body = "";
        let j = 1;
        let status=false;

        if(data.length==0){
            $('#iconSocio').hide();
            $('#hdSocio').removeClass("head-color"); 
            $('#hdSocio').addClass("head-dark"); 
        }

        $.each(data, function(i, valor) {
            body += '<tr>' + '<td>' + j + '</td>' + '<td>' + valor.nombre + " " + valor.ap_paterno + " " + valor.ap_materno + '</td>' + '<td>' + valor.rfc + '</td>' + '<td>' + valor.correo_electronico + '</td>' + '<td class="text-center">' + '<a onclick="modal_socio_legal(' + valor.id + ');" class="btn btn-default btn-icon btn-circle"><i class="fa fa-pen"></i></a>' + '<a onclick="eliminar_socio_legal(' + valor.id + ');" class="btn btn-default btn-icon btn-circle"><i class="fa fa-trash"></i></a>' + '</td>' + '</tr>';
            j++;
            if(!status)
            {
                if(valor.id_registro_temp != '' )
                {
                    status=true;
                    $('#iconSocio').show();  
                    $('#hdSocio').addClass("head-color");                    
                    $('#hdSocio').removeClass("head-dark");                 
                }           
            }
        });
        $("#scs_tbl tbody").html(body);
        
    }, "json");
}

function get_socio_legal(id) {
    let url = project_name + "/mis-tramites/get/socio-legal/" + id;
    $.get(url, function(data, textStatus) {

        let id_estado=0;
        let id_municipio=0;
        let carga_est_mun=false;

        $.each(data, function(key, valor) {

            if(key =="id_estado_particular")
                id_estado = valor;                 
            
            if(key =="id_municipio_particular")
                id_municipio = valor;

            if(id_estado!=0 && id_municipio!=0 && carga_est_mun==false){
                cargar_municipios_edit(id_estado, "dlscs_id_municipio_particular", id_municipio); 
                carga_est_mun=true;
            }
            
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

function modal_socio_legal(id) {
    get_socio_legal(id);
    $("#mdl_dlscs").modal();
}
$('#dlscs_frm').on('submit', function(e) {
    var el = $('#dlscs_frm');
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
                cargar_socios_legales(json.data.id_registro_temp);
                $("#mdl_dlscs").modal("toggle");
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
        }
    });
});

function eliminar_socio_legal(id) {
    swal({
        title: 'Advertencia!',
        text: "Esta seguro de eliminar este registro ?",
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
            var url = $('#socios_frm_destroy').attr('action');
            url = url.replace(/\/[^\/]*$/, '/' + id)
            $('#socios_frm_destroy').attr('action', url).submit();
        }
    });
}
$('#socios_frm_destroy').on('submit', function(e) {
    var el = $('#socios_frm_destroy');
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
                var url = $('#socios_frm_destroy').attr('action');
                url = url.replace(/\/[^\/]*$/, '/0');
                $('#socios_frm_destroy').attr('action', url);
                cargar_socios_legales(json.id_tramite);
            });
        },
        error: function(json) {
            if (json.status === 422) {
                var jsonString = json.responseJSON;
                var errors = jsonString.errors;
            } else {
                alert('Ha ocurrido un error inesperado, contacte a su administrador.');
            }
        }
    });
});