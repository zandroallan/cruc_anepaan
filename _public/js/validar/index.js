$(function(){
    $('.btn-consulta').attr('onclick', 'consulta()'); 
    $('#btnTerminar').attr('onclick', 'terminar()'); 

    keyPressValidateForm();
});

function consulta()
 {
 	$('#dvEncontrado').hide();
 	if ( validaForm('my-form') ) {
	 	$.ajax({
	        type: "GET",
	        url: vuri + '/certificado/datos-certificado',
	        data: {          
	          folio: $('#folio').val(),
	          rfc: $('#rfc').val()
	        },
	        success: function(response) {
	        	var vtramite = response.respuesta.tramite;
	        	clear();
	            if(vtramite != null)
	            {
	            	$('#NoEncontrado').hide();
	            	$('#dvEncontrado').show();
	            	            	
	            	$('#spEmpresa').html(vtramite.razon_social);
	            	$('.spRfc').html(vtramite.rfc);

	            	$('#lblFolio').html(vtramite.folio);
	            	$('#lblFolioPago').html(vtramite.folio_pago);
	            	$('#lblFecha').html(vtramite.fecha_certificado);
	            	$('#lblFormatoV').html(vtramite.forma_valorada);

	            	var tipoPersona ='Fisica';
	            	if(vtramite.id_tipo_persona == 2) tipo='Moral';

	            	$('#lblTipoPersona').html(tipoPersona);
					$('#lblTipoTramite').html(vtramite.tipo_tramite);
					$('#lblResponsable').html(vtramite.coordinador);
					$('#lblInicio').html(vtramite.fecha_inicio);
					$('#lblFin').html(vtramite.fecha_fin);

					$("#lnkCertificado").attr("href", "https://apps.anticorrupcionybg.gob.mx/sircse-admin/impresion/certificado/"+ vtramite.id +"/validado")
					
	            }
	            else
	            {   
	            	$('#NoEncontrado').show();
	            	setTimeout(function() { 
	                    $('#NoEncontrado').hide();
	                    $('#folio').val('');
	                    $('#rfc').val('');
	                }, 3000);
	            }               
	        },
	        error: function(json) { }
	    });
	}
 }


function clear()
 {
 	$('#spEmpresa').html('');
	$('.spRfc').html('');

	$('#lblFolio').html('');
	$('#lblFolioPago').html('');
	$('#lblFecha').html('');
	$('#lblFormatoV').html('');

	$('#lblTipoPersona').html('');
	$('#lblTipoTramite').html('');
	$('#lblResponsable').html('');
	$('#lblInicio').html('');
	$('#lblFin').html('');

	$("#lnkCertificado").attr("href", "#");
 }


function terminar()
{
	$('#folio').val('');
	$('#rfc').val('');
	$('#dvEncontrado').hide();
	$('#NoEncontrado').hide();
	clear();
}

function keyPressValidateForm()
 {
    $('.removeIsInvalid').keypress(function(event){
        if ($("#" + this.id).hasClass("is-invalid")) {
            $("#" + this.id).removeClass("is-invalid");
        }     
    });
 }

function clearForm(vidFormulario)
 {
    var vformulario = document.getElementById(vidFormulario);
    for (vj = 0; vj < vformulario.elements.length; vj++) {
        if (vformulario.elements[vj].type == "text") $('#' + vformulario.elements[vj].id).val('');
    }
 }

function validaForm(vidFormulario)
 {
    limpiarCSS(vidFormulario);
    var vstatus = true;
    var vformulario = document.getElementById(vidFormulario);
    for (vj = 0; vj < vformulario.elements.length; vj++) {        
        if (vformulario.elements[vj].type == "text") {
            
            if ($('#' + vformulario.elements[vj].id).val() == '') {
              
                $('#' + vformulario.elements[vj].id).addClass("is-invalid");
                if (vstatus) {
                    $('#' + vformulario.elements[vj].id).focus();
                }
                vstatus = false;                               
            }
               
        }           
    }
    return vstatus;
 }

function limpiarCSS(idFormulario)
 {
    var vformulario = document.getElementById(idFormulario);
    for (j = 0; j < vformulario.elements.length; j++) {
        if (vformulario.elements[j].type == "text") {
            if ($("#" + vformulario.elements[j].id).hasClass("is-invalid")) {
                $("#" + vformulario.elements[j].id).removeClass("is-invalid");
            }           
        }        
    }
 }