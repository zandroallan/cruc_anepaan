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
                vhtml+='<table class="table table-bordered table-checkable dataTable no-footer dtr-inline">';
                vhtml+='    <thead class="thead-dark head-dark">';
                vhtml+='        <tr>';
                vhtml+='            <th style="color: #fff; padding: 15px 15px;" class="text-center">#</th>';
                vhtml+='            <th style="color: #fff; padding: 15px 15px;">CLAVE</th>';
                vhtml+='            <th style="color: #fff; padding: 15px 15px;">NOMBRE DOCUMENTO</th>';
                vhtml+='            <th style="color: #fff; padding: 15px 15px;" class="text-center">TIPO</th>';
                vhtml+='            <th style="color: #fff; padding: 15px 15px;" class="text-center">ACCIONES</th>';
                vhtml+='        </tr>';
                vhtml+='    </thead>';
                vhtml+='    <tbody>';
            for ( vi=0; vi<vrespuesta.length; vi++) {
                vhtml+='        <tr>';             
                vhtml+='            <td class="text-center"><b>' + (vi + 1) + '</b></td>';
                vhtml+='            <td>' + vrespuesta[vi].clave +'</td>';
                vhtml+='            <td>' + vrespuesta[vi].nombre + '</td>';               
                vhtml+='            <td class="text-center">' + vrespuesta[vi].tipo + '</td>';               
                vhtml+='            <td class="text-center">';
                vhtml+='                <a href="'+ vuri + '/descargas-formatos/'+ vrespuesta[vi].id +'/bajar" title="' + vrespuesta[vi].nombre + '">';
                vhtml+='                    <i class="fa fa-download"></i>';
                vhtml+='                </a>';                
                vhtml+='            </td>';
                vhtml+='        </tr>';
            }
                vhtml+='    </tbody>';
                vhtml+='</table>';   

            $('._response').html(vhtml);
            
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    }); 
}

