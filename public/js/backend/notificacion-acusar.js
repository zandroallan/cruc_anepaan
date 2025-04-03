var clicando = false;

function acusar(id)
 {
    if (!clicando) {


        $.confirm({   
            icon: 'fa fa-info-circle',
            title: 'Notificacion !',
            content: '¿ Desea acusar de recibido esta Notificación?',
            type: 'green',       
            typeAnimated: true,
            animation: 'zoom',
            closeAnimation: 'scale',
            // autoClose: 'confirmar|8000',
            buttons: {
                confirmar: {
                    action: function () {
                     
            // if (result) {
                clicando = true;
                let url = project_name + "/notificaciones/observaciones/acusar/" + id;
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(json) {
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
                        //     clicando = false;
                        //     if (json.route_redirect != "") {
                        //         window.location = json.route_redirect;
                        //     }
                        // });
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
                        clicando = false;
                    }
                });
            // }
            // else {
            //     clicando = false;
            // }


                    }
                },
                cancelar: { 
                    // isHidden: true,                
                    // action: function () {}
                },
            }
        });





        // swal({
        //     title: "¡ Advertencia !",
        //     text: "¿ Desea acusar de recibido ?",
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

    //     });
    // } 
    // else {
    //     swal({
    //         type: 'info',
    //         title: 'Notificación',
    //         text: "Por favor espere un momento, la información esta siendo procesada.",
    //         icon: "info",
    //         timer: 1500
    //     });
    



    }
 }