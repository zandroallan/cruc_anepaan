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
            body += '<tr>' + '<td>' + j + '</td>' + '<td>' + valor.nombre + " " + valor.ap_paterno + " " + valor.ap_materno + '</td>' + '<td>' + valor.rfc + '</td>' + '<td>' + valor.correo_electronico + '</td>' + '<td class="text-center">' + '<a onclick="modal_socio_legal(' + valor.id + ');" class="btn btn-icon btn-outline-primary btn-circle btn-sm mr-2"><i class="fa fa-pen"></i></a>' + '<a onclick="eliminar_socio_legal(' + valor.id + ');" class="btn btn-icon btn-outline-danger btn-circle btn-sm mr-2"><i class="fa fa-trash"></i></a>' + '</td>' + '</tr>';
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

function get_socio_legal(id) 
{
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

function modal_socio_legal(id) 
{
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
                            cargar_socios_legales(json.data.id_registro_temp);
                            $("#mdl_dlscs").modal("toggle");
                        }
                    },
                    cancelar: { 
                        isHidden: true,                
                        action: function () {}
                    },
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
        }
    });
});

function eliminar_socio_legal(id) {
    $.confirm({   
        icon: 'fa fa-warning',
        title: 'Confirmar !',
        content: 'Esta seguro de eliminar el socio legal ?',
        type: 'dark',       
        typeAnimated: true,
        confirmButton: 'Yes i agree',
        cancelButton: 'NO never !',             
        buttons: {
            confirmar: function () {
                var url = $('#socios_frm_destroy').attr('action');
                url = url.replace(/\/[^\/]*$/, '/' + id)
                $('#socios_frm_destroy').attr('action', url).submit();
            },
            cancelar: function () {
                
            }           
        },      
        animation: 'zoom',
        closeAnimation: 'scale'     
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
            $.confirm({   
                icon: 'fa fa-info-circle',
                title: 'Notificacion !',
                content: 'Socio legal eliminado correctamente',
                type: 'green',       
                typeAnimated: true,
                animation: 'zoom',
                closeAnimation: 'scale',
                autoClose: 'confirmar|1000',
                buttons: {
                    confirmar: {
                        isHidden: true,                
                        action: function () {
                            var url = $('#socios_frm_destroy').attr('action');
                            url = url.replace(/\/[^\/]*$/, '/0');
                            $('#socios_frm_destroy').attr('action', url);
                            cargar_socios_legales(json.id_tramite);
                        }
                    },
                    cancelar: { 
                        isHidden: true,                
                        action: function () {}
                    },
                }
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