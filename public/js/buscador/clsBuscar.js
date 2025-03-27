function buscar_folio(cadena){

	var texto = $('#txtBusca').val();
    buscar_ajax(texto);

}

function buscar_ajax(cadena){ 
	var token = $("meta[name=csrf-token]").attr("content");
    
	if(cadena=="")
    {        
        $("#resultados").empty();
    }
    else
    {    
        $.ajax({
            type: "GET",
            url: vuri + '/buscador/search',           
            data: {
                _token: token,
                cadena: cadena
            },            
            success: function(vresponse, vtextStatus, vjqXHR) {                
               var vrespuesta=vresponse;
               var vhtml ='';
               console.log(vrespuesta);

                if(vrespuesta.length==0)
                    vhtml+='<h2>No existe informacion con los datos proporcionados</h2>';                
                else
                {                       
                    vhtml+='<br><table class="table">';
                        vhtml+='<thead class="table-dark">';
                            vhtml+='<tr>';
                                vhtml+='<th>Folio</th>';                                
                                vhtml+='<th>RFC</th>';                                
                                vhtml+='<th>Razon social</th>';                                
                                vhtml+='<th>Tipo trámite</th>';                                
                                vhtml+='<th>Fecha inicio</th>';                                
                                vhtml+='<th>Opcion</th>';                                
                            vhtml+='</tr>';
                        vhtml+='</thead>';
                        vhtml+='<tbody>';
                        for(vi=0; vi<vrespuesta.length; vi++){ 
                            vhtml+='<tr>';
                                vhtml+='<td>'+vrespuesta[vi].folio+'</td>';                               
                                vhtml+='<td>'+vrespuesta[vi].rfc+'</td>';                               
                                vhtml+='<td>'+vrespuesta[vi].razon_social+'</td>';                               
                                vhtml+='<td>'+vrespuesta[vi].tipo_tramite+'</td>';                               
                                vhtml+='<td>'+vrespuesta[vi].fecha_inicio+'</td>';                               
                                vhtml+='<td>';
                                //vhtml+='	<a href="'+ vuri + '/buscador/'+ vrespuesta[vi].id +'/qr" class="btn btn-primary btn-outline btn-circle btn-sm m-r-4">Ver qr</a>';
                                vhtml+='    <a href="'+ vuri + '/constancia/validacion/'+ vrespuesta[vi].folio +'" class="btn btn-primary btn-outline btn-circle btn-sm m-r-4">Ver folio</a>';
                                vhtml+='</td>';
                            vhtml+='</tr>';                                        
                        }                                                                               
                        vhtml+='</tbody>';
                    vhtml+='</table>';                    
                }
                $('.resultados').html(vhtml);
            },
            error: function(vjqXHR, vtextStatus, verrorThrown)
            {
                
            }
        });
    }
}