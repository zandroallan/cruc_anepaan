
function get_capital_contable()
 {
    $('.btn-store-capital-contable').attr('onclick', 'store_capital_contable()');

	$.ajax({
        type: "GET",
        url: vuri + '/financiero/capital/contable',
        success: function(vresponse) {
            if ( vresponse.codigo == 1 ) {
                document.getElementById('id_capital_contable').value=vresponse.data.id;
                document.getElementById('capital').value=vresponse.data.capital;
                document.getElementById('fecha_elaboracion').value=vresponse.data.fecha_elaboracion;
                document.getElementById('fecha_declaracion').value=vresponse.data.fecha_declaracion;
                document.getElementById('observaciones').value=vresponse.data.observaciones;
            }
        },
        error: function(vresponse) { }
    });
 }

function get_estados_financieros()
 {
    $('.btn-store-estados-financieros').attr('onclick', 'store_estados_financiero()');

	$.ajax({
        type: "GET",
        url: vuri + '/financiero/estados/financieros',
        success: function(vresponse) {
            if ( vresponse.codigo == 1 ) {
                document.getElementById('id_estado_financiero').value=vresponse.data.id;
                document.getElementById('utilidad_perdida').value=vresponse.data.utilidad_perdida.actual;
                document.getElementById('balance_gral').value=vresponse.data.balance_gral.actual;
                document.getElementById('razon_liquidez').value=vresponse.data.razon_liquidez.actual;
                document.getElementById('razon_endeudamiento').value=vresponse.data.razon_endeudamiento.actual;
                document.getElementById('razon_rentabilidad').value=vresponse.data.razon_rentabilidad.actual;
                document.getElementById('capital_neto').value=vresponse.data.capital_neto.actual;
            }
        },
        error: function(vresponse) { }
    });
 }

function store_capital_contable()
 {
    $.confirm({
        title: '¡ Advertencia !',
        content: '¿Realmente desea guardar los datos del capital contable?',
        type: 'orange',
        theme: 'material',
        buttons: {
            Aceptar: function() {
                $.ajax({
                    type: "POST",
                    url: vuri + '/capital/contable/store',
                    data: $('.frm-capital-contable').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },            
                    success: function(vresponse) {
                        if ( vresponse.codigo == 1 ) {
                            get_capital_contable();
                        }
                        
                        $.alert({
                            title: 'Mensaje!',
                            content: vresponse.mensaje,
                            type: 'orange'
                        });

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

function store_estados_financiero()
 {
    $.confirm({
        title: '¡ Advertencia !',
        content: '¿Realmente desea guardar los datos del capital contable?',
        type: 'orange',
        theme: 'material',
        buttons: {
            Aceptar: function() {
                $.ajax({
                    type: "POST",
                    url: vuri + '/estados/financieros/store',
                    data: $('.frm-estados-financieros').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },            
                    success: function(vresponse) {
                        if ( vresponse.codigo == 1 ) {
                            get_estados_financieros();
                        }
                        
                        $.alert({
                            title: 'Mensaje!',
                            content: vresponse.mensaje,
                            type: 'orange'
                        });
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