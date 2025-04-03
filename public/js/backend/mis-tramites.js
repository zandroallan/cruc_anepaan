
function index(id_cs)
 {
    $.ajax({
        type: 'GET',
        url: project_name + "/mis-tramites/expediente/" + id_cs,
        dataType: "JSON",
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vhtml ='';
                vhtml+='<table id="mis-observaciones" class="table table-bordered table-checkable dataTable no-footer dtr-inline">';
                vhtml+='    <thead class="thead-dark head-dark">';
                vhtml+='        <tr>';
                vhtml+='            <th>#</th>';
                vhtml+='            <th>FOLIO</th>';
                // vhtml+='            <th>Sujeto</th>';
                vhtml+='            <th>TIPO DE TRAMITE</th>';
                vhtml+='            <th>ESTATUS</th>';
                vhtml+='            <th>INICIO</th>';
                vhtml+='            <th>FIN</th>';
                // vhtml+='            <th><i class="fe fe-book-open"></i></th>';
                vhtml+='            <th class="text-center">';
                vhtml+='                <i class="fe fe-align-center"></i>';
                vhtml+='            </th>';
                vhtml+='        </tr>';
                vhtml+='    </thead>';
                vhtml+='    <tbody>';
                for ( vi=0; vi<vresponse.length; vi++ ) {
                    let f_fin = "-";
                    let url_download_constancia = project_name + "/impresion/tramite/constancia-documentos/" + vresponse[vi].id;
                    let url_download_observaciones = project_name + "/impresion/tramite/observaciones/" + vresponse[vi].id;
                    let url_mi_documentacion = project_name + '/mis-tramites/'+ vresponse[vi].id +'/documentacion';

                    if (vresponse[vi].fecha_fin != null) {
                        f_fin = vresponse[vi].fecha_fin;
                    }

                    vhtml+=' <tr>';
                    vhtml+='     <td>'+ (vi + 1) +'</td>';
                    vhtml+='     <td>';
                    vhtml+='         <strong>';
                    vhtml+='             <span class="label label-inline label-light-' + vresponse[vi].status_color + ' font-weight-bold">' + vresponse[vi].folio + '</span>';
                    vhtml+='         </strong>';
                    vhtml+='     </td>';
                    // vhtml+='     <td>'+ sujeto_tramite +'</td>';
                    vhtml+='     <td>'+ vresponse[vi].tipo_tramite +'</td>';
                    vhtml+='     <td>';
                    vhtml+='         <strong>';
                    vhtml+='             <span class="label label-inline label-light-' + vresponse[vi].status_color + ' font-weight-bold">' + vresponse[vi].status + '</span>';
                    vhtml+='         </strong>';
                    vhtml+='     </td>';
                    vhtml+='     <td>' + vresponse[vi].fecha_inicio + '</td>';
                    vhtml+='     <td>' + f_fin + '</td>';
                    // vhtml+='     <td class="text-center">';
                    // vhtml+='         <a href="' + url_mi_documentacion + '" class="btn ripple btn-secondary btn-icon btn-sm">';
                    // vhtml+='             <i class="fe fe-file-text fa-lg"></i>';
                    // vhtml+='         </a>';
                    // vhtml+='     </td>';
                    vhtml+='     <td class="text-center">';
                    if (vresponse[vi].id_c_tramites_seguimiento >= 2) {
                        vhtml+= '     <a target="_blank" href="' + url_download_observaciones + '" class="btn ripple btn-sm">';
                        vhtml+= '         <i class="fa fa-print fa-lg"></i>';
                        vhtml+= '     </a>';
                    }
                    vhtml+='         <a target="_blank" href="' + url_download_constancia + '" class="btn ripple btn-sm">';
                    vhtml+='             <i class="fa fa-print fa-lg"></i>';
                    vhtml+='         </a>';
                    vhtml+='         <a target="_blank" onclick="modal_contacto(' + vresponse[vi].id + ');" class="btn ripple btn-sm">';
                    vhtml+='             <i class="fa fa-address-card fa-lg"></i>';
                    vhtml+='         </a>';
                    vhtml+='     </td>';
                    vhtml+=' </tr>';
                }
                vhtml+='    </tbody>';
                vhtml+='</table>';

            $('._response').html(vhtml);

        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });
 }


