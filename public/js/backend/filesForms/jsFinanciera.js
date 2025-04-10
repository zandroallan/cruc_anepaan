

function get_contadores_certificados()
 {
    $('.btn_store_cpc').attr('onclick', 'store_contador_publico()');

    $.ajax({
        type: "GET",
        url: vuri + '/contadores/publicos/certificados',
        data: {
            method: 'get'
        },
        success: function(vresponse) {
            let html ='';
                html+='<option value="">-- Seleccionar --</option>';
            $.each(vresponse.data, 
                function (i, valor) {
                    html+='<option value='+ valor.id +'>';
                    html+=  valor.nombre +' '+ valor.ap_paterno +' '+ valor.ap_materno;
                    html+='</option>';   
                }
            );

            $("#id_contador").html(html);
        },
        error: function(vresponse) { }
    });
 }


function store_contador_publico()
 {
    $.confirm({
        title: '¡ Advertencia !',
        content: '¿Realmente desea guardar el contador público?',
        type: 'orange',
        theme: 'material',
        buttons: {
            Aceptar: function() {
                $.ajax({
                    type: "POST",
                    url: vuri + '/contadores/publicos/certificados/store',
                    data: $('.frm-contador-publico').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },            
                    success: function(vresponse) {
                        $.alert({
                            title: 'Mensaje!',
                            content: vresponse.mensaje,
                            type: 'orange'
                        });

                        get_contador_tramite();
                    },
                    error: function(json) {

                    }
                }); 
            },
            Cancelar: function() {
                $.alert({
                    title: 'Mensaje!',
                    content: '¡El usuario ha cancelado la acción!',
                    type: 'orange'
                });
            }
        }
    });
 }

function get_contador_tramite()
 {
    // $('.btn_store_cpc').attr('onclick', 'store_contador_publico()');

    $.ajax({
        type: "GET",
        url: vuri + '/contadores/publicos/certificados',
        data: {
            method: 'show'
        },
        success: function(vresponse) {
            var vhtml ='';
            if (vresponse.codigo == 0) {

            }
            else {
                vhtml+='<table class="table table-bordered table-checkable dataTable no-footer dtr-inline">';
                vhtml+='    <thead class="thead-dark">';
                vhtml+='        <tr>';
                vhtml+='            <th>Nombre completo</th>';
                vhtml+='            <th>Teléfono</th>';
                vhtml+='            <th>Curp</th>';
                vhtml+='            <th>Correo electrónico</th>';
                vhtml+='        </tr>';
                vhtml+='    </thead>';
                vhtml+='    <tbody>';
            // for ( vi=0; vi<vresponse.data.length; vi++ ) {
                vhtml+='        <tr>';
                vhtml+='            <td class="fs-sm">' + vresponse.data.nombre_completo + '</td>';
                vhtml+='            <td class="fs-sm">' + vresponse.data.telefono + '</td>';
                vhtml+='            <td class="fs-sm">' + vresponse.data.curp + '</td>';
                vhtml+='            <td class="fs-sm">' + vresponse.data.correo_electronico + '</td>';
                vhtml+='        </tr>';
            // }
                vhtml+='    </tbody>';
                vhtml+='</table>';
            }
                
            $('._tbl_response_cpc').html(vhtml);
            // alert('oik');
        },
        error: function(vresponse) { }
    });
 }
 

// function get_capital_contable()
//  {
//     $('.btn-store-capital-contable').attr('onclick', 'store_capital_contable()');

//     $.ajax({
//         type: "GET",
//         url: vuri + '/financiero/capital/contable',
//         success: function(vresponse) {
//             if ( vresponse.codigo == 1 ) {
//                 document.getElementById('id_capital_contable').value=vresponse.data.id;
//                 document.getElementById('capital').value=vresponse.data.capital;
//                 document.getElementById('fecha_elaboracion').value=vresponse.data.fecha_elaboracion;
//                 document.getElementById('fecha_declaracion').value=vresponse.data.fecha_declaracion;
//                 document.getElementById('observaciones').value=vresponse.data.observaciones;
//             }
//         },
//         error: function(vresponse) { }
//     });
//  }

// function get_estados_financieros()
//  {
//     $('.btn-store-estados-financieros').attr('onclick', 'store_estados_financiero()');

//  $.ajax({
//         type: "GET",
//         url: vuri + '/financiero/estados/financieros',
//         success: function(vresponse) {
//             if ( vresponse.codigo == 1 ) {
//                 document.getElementById('id_estado_financiero').value=vresponse.data.id;
//                 document.getElementById('utilidad_perdida').value=vresponse.data.utilidad_perdida.actual;
//                 document.getElementById('balance_gral').value=vresponse.data.balance_gral.actual;
//                 document.getElementById('razon_liquidez').value=vresponse.data.razon_liquidez.actual;
//                 document.getElementById('razon_endeudamiento').value=vresponse.data.razon_endeudamiento.actual;
//                 document.getElementById('razon_rentabilidad').value=vresponse.data.razon_rentabilidad.actual;
//                 document.getElementById('capital_neto').value=vresponse.data.capital_neto.actual;
//             }
//         },
//         error: function(vresponse) { }
//     });
//  }

// function store_capital_contable()
//  {
//     $.confirm({
//         title: '¡ Advertencia !',
//         content: '¿Realmente desea guardar los datos del capital contable?',
//         type: 'orange',
//         theme: 'material',
//         buttons: {
//             Aceptar: function() {
//                 $.ajax({
//                     type: "POST",
//                     url: vuri + '/capital/contable/store',
//                     data: $('.frm-capital-contable').serialize(),
//                     headers: {
//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                     },            
//                     success: function(vresponse) {
//                         if ( vresponse.codigo == 1 ) {
//                             get_capital_contable();
//                         }
                        
//                         $.alert({
//                             title: 'Mensaje!',
//                             content: vresponse.mensaje,
//                             type: 'orange'
//                         });

//                     },
//                     error: function(json) {

//                     }
//                 }); 
//             },
//             Cancelar: function() {
//                 $.alert({
//                     title: 'Mensaje!',
//                     content: '¡El usuario ha cancelado la acción!',
//                     type: 'orange'
//                 });
//             }
//         }
//     });
//  }

// function store_estados_financiero()
//  {
//     $.confirm({
//         title: '¡ Advertencia !',
//         content: '¿Realmente desea guardar los datos del capital contable?',
//         type: 'orange',
//         theme: 'material',
//         buttons: {
//             Aceptar: function() {
//                 $.ajax({
//                     type: "POST",
//                     url: vuri + '/estados/financieros/store',
//                     data: $('.frm-estados-financieros').serialize(),
//                     headers: {
//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                     },            
//                     success: function(vresponse) {
//                         if ( vresponse.codigo == 1 ) {
//                             get_estados_financieros();
//                         }
                        
//                         $.alert({
//                             title: 'Mensaje!',
//                             content: vresponse.mensaje,
//                             type: 'orange'
//                         });
//                     },
//                     error: function(json) {

//                     }
//                 }); 
//             },
//             Cancelar: function() {
//                 $.alert({
//                     title: 'Mensaje!',
//                     content: '¡El usuario ha cancelado la acción!',
//                     type: 'orange'
//                 });
//             }
//         }
//     });
//  }