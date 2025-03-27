var dt_default;

//Route::get('descargas-formatos/{id}/bajar', ['as'=>'descargas-f.bajar','uses' =>'Backend\DescargasController@descargar']);
//Route::get('descargas/resultados', ['as'=>'descargas-f.resultados','uses' =>'Backend\DescargasController@resultados']);
function cargarTabla(){
    $.ajax({
        type: 'GET',
        url: vuri + '/descargas/resultados',
        dataType: "JSON",
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vrespuesta=vresponse;
            var vhtml ='';
                vhtml+='<table class="table table-hover">';
                vhtml+='    <thead style="background-color: #333333 !important;">';
                vhtml+='        <tr>';
                vhtml+='            <th style="color: #fff; padding: 15px 15px;">#</th>';
                vhtml+='            <th style="color: #fff; padding: 15px 15px;">Clave</th>';
                vhtml+='            <th style="color: #fff; padding: 15px 15px;">Nombre</th>';
                vhtml+='            <th style="color: #fff; padding: 15px 15px;">Tipo</th>';
                vhtml+='            <th style="color: #fff; padding: 15px 15px;">Accion</th>';
                vhtml+='        </tr>';
                vhtml+='    </thead>';
                vhtml+='    <tbody>';
            for ( vi=0; vi<vrespuesta.length; vi++) {
                vhtml+='        <tr>';             
                vhtml+='            <td>' + (vi + 1) + '</td>';
                vhtml+='            <td>' + vrespuesta[vi].clave +'</td>';
                vhtml+='            <td>' + vrespuesta[vi].nombre + '</td>';               
                vhtml+='            <td>' + vrespuesta[vi].tipo + '</td>';               
                vhtml+='            <td class="text-center">';
                vhtml+='                <a href="'+ vuri + '/descargas-formatos/'+ vrespuesta[vi].id +'/bajar" title="Editar"><i class="fa fa-download"></i></a>';                
                vhtml+='            </td>';
                vhtml+='        </tr>';
            }
                vhtml+='    </tbody>';
                vhtml+='</table>';    
            $('#dvFormatos').html(vhtml);
            
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    }); 
}

