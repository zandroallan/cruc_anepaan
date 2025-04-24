<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Backend\T_Tramite;
use App\Http\Models\Catalogos\C_Tipo_Tramite;
use App\Http\Models\Backend\T_Tramite_Observacion;
use App\Http\Classes\Imprimir;
use Auth;

class ImpresionController extends Controller
{
    private $route='impresion';
    public function __construct()
    {
        //  $this->middleware('auth');
    }

    public static function acuseObservacionSolventado($id_tramite, $mode='S')
    {
        # Autor Modifico: Sandro Alan Gómez Aceituno
        # Creación: 03/06/2021.
        # Descripción: Formato de acuse, carga de solventaciones.

        $imprimir = new Imprimir;
        $t_tramite = T_Tramite::detalle($id_tramite);        
        $data=['id_tramite'=>$id_tramite];
        
        $sujeto= ($t_tramite->id_sujeto==1) ? "Contratistas" : "Supervisores";
        $tipo_persona= ($t_tramite->id_tipo_persona==1) ? "Fisica" : "Moral";

        $domicilio_fiscal =" ";
        $domicilio_fiscal.=$t_tramite->calle_fiscal." Int.".$t_tramite->int_fiscal.", ";
        $domicilio_fiscal.="Ext.".$t_tramite->ext_fiscal.", ".$t_tramite->colonia_fiscal;
        $domicilio_fiscal.=" C.P. ".$t_tramite->cp_fiscal."; ".$t_tramite->municipio_fiscal.", ".$t_tramite->estado_fiscal;        

        $html ='<h3 class="titulo2">Acuse de envio de Observaciones</h3>';
        $html.='<h4 class="subtitulo">Padrón de '.$sujeto.'</h4>';      
        $html.='<table class="table_dts_dec" align="left">';
        $html.='    <tbody>';
        $html.='        <tr>';
        $html.='            <td class="variable td_dec" width="15%"><b>Razón social</b></td>';
        $html.='            <td class="contenido td_dec" width="45%"><b>'. $t_tramite->razon_social_o_nombre .'</b></td>';
        $html.='            <td class="variable td_dec" width="15%"><b>Folio</b></td>';
        $html.='            <td class="contenido td_dec" width="25%"><b>'. $t_tramite->folio .'</b></td>';
        $html.='        </tr>';
        $html.='        <tr>';
        $html.='            <td class="variable td_dec" width="15%"><b>Trámite</b></td>';
        $html.='            <td class="contenido td_dec" width="45%">'. $t_tramite->tipo_tramite .'</td>';
        $html.='            <td class="variable td_dec" width="15%"><b>Fecha</b></td>';
        $html.='            <td class="contenido td_dec" width="25%">'. $t_tramite->fecha_inicio .'</td>';
        $html.='        </tr>';           
        $html.='        <tr>'; 
        $html.='            <td class="variable td_dec" width="15%"><b>R.F.C</b></td>'; 
        $html.='            <td class="contenido td_dec" width="45%"><b>'. $t_tramite->rfc .'</b></td> '; 
        $html.='            <td class="variable td_dec" width="15%"><b>Persona</b></td>'; 
        $html.='            <td class="contenido td_dec" width="25%">'. $tipo_persona .'</td>';
        $html.='        </tr>'; 
        $html.='        <tr>'; 
        $html.='            <td class="variable td_dec" width="15%"><b>Teléfono</b></td>'; 
        $html.='            <td class="contenido td_dec" width="45%">'. $t_tramite->telefono .'</td> '; 
        $html.='            <td class="variable td_dec" width="15%"><b>Correo</b></td>'; 
        $html.='            <td class="contenido td_dec" width="25%">'. $t_tramite->email .'</td>';
        $html.='        </tr>';             
        $html.='        <tr>'; 
        $html.='            <td class="variable td_dec" width="15%"><b>Domicilio fiscal</b></td>'; 
        $html.='            <td class="contenido td_dec" width="85%" colspan=3>'.$domicilio_fiscal.'</td>';
        $html.='        </tr>';        
        $html.='    </tbody>'; 
        $html.='</table>'; 

        $html.= '<h2 class="titulo_modulos">Observaciones solventadas sujetas a revisión</h2><br />';
        $observacionesLegal=T_Tramite_Observacion::solventacionesEnRevision($id_tramite, 2)->get();
        $observacionesFinanciera=T_Tramite_Observacion::solventacionesEnRevision($id_tramite, 3)->get();
        $observacionesTecnica=T_Tramite_Observacion::solventacionesEnRevision($id_tramite, 4)->get();

        $html.= '<div class="lblarea">Área Legal</div> ';
        if( !$observacionesLegal->isEmpty() ) {
            $html.='<table class="table_dts_dec" align="left">';
            $html.='    <tbody>';
            foreach($observacionesLegal as $key => $vdatos) {                
                $html.='        <tr>';
                $html.='            <td class="contenido td_dec" width="80%">' . $vdatos['observacion'] . '</td>';
                $html.='            <td class="variable  td_dec" width="20%" style="text-align: center"><b>Sujeto a revisión</b></td>';
                $html.='        </tr>';
            }
            $html.='    </tbody>';
            $html.='</table>';
        }

        $html.= '<div class="lblarea">Área Financiera</div> ';
        if( !$observacionesFinanciera->isEmpty() ) {
            $html.='<table class="table_dts_dec" align="left">';
            $html.='    <tbody>';
            foreach($observacionesFinanciera as $key => $vdatos) {
                $html.='        <tr>';
                $html.='            <td class="contenido td_dec" width="80%">' . $vdatos['observacion'] . '</td>';
                $html.='            <td class="variable  td_dec" width="20%" style="text-align: center"><b>Sujeto a revisión</b></td>';
                $html.='        </tr>';
            }
            $html.='    </tbody>';
            $html.='</table>';
        }

        $html.= '<div class="lblarea">Área Tecnica</div> ';
        if( !$observacionesTecnica->isEmpty() ) {
            $html.='<table class="table_dts_dec" align="left">';
            $html.='    <tbody>';
            foreach($observacionesTecnica as $key => $vdatos) {                
                $html.='        <tr>';
                $html.='            <td class="contenido td_dec" width="80%">' . $vdatos['observacion'] . '</td>';
                $html.='            <td class="variable  td_dec" width="20%" style="text-align: center"><b>Sujeto a revisión</b></td>';
                $html.='        </tr>';
            }
            $html.='    </tbody>';
            $html.='</table>';
        }

        return $imprimir->acuse_observaciones($html, $mode, $t_tramite->folio);
    }

	public function observaciones($id_tramite, $mode='D'){

        $imprimir = new Imprimir;
        $t_tramite = T_Tramite::detalle($id_tramite);        
        $data=['id_tramite'=>$id_tramite];
        $observaciones=  T_Tramite_Observacion::lstObservaciones($id_tramite);
      
        $sujeto= ($t_tramite->id_sujeto==1) ? "Contratistas" : "Supervisores";
        $folio= $t_tramite->folio;
        $tipo_tramite= $t_tramite->tipo_tramite;
        $razon_social_o_nombre= $t_tramite->razon_social_o_nombre;
        $rfc= $t_tramite->rfc;
        $tipo_persona= ($t_tramite->id_tipo_persona==1) ? "Fisica" : "Moral";
        $fecha_recepcion= $t_tramite->fecha_inicio;
        $domicilio_fiscal= $t_tramite->calle_fiscal." Int.".$t_tramite->int_fiscal.", Ext.".$t_tramite->ext_fiscal.", ".$t_tramite->colonia_fiscal. " C.P. ".$t_tramite->cp_fiscal."; ".$t_tramite->municipio_fiscal.", ".$t_tramite->estado_fiscal;
        $correo_electronico= $t_tramite->email;
        $telefono= $t_tramite->telefono;

        $html = '<h3 class="titulo2">Observaciones</h3>';
        $html.= '<h4 class="subtitulo">Padrón de '.$sujeto.'</h4>';

      
        $html.='<br><table class="table_dts_dec" align="left">
            <tbody>                            
                <tr>
                    <td class="variable td_dec" width="15%"><b>Razón social</b></td>
                    <td class="contenido td_dec" width="45%"><b>'.$razon_social_o_nombre.'</b></td>
                    <td class="variable td_dec" width="15%"><b>Folio</b></td>
                    <td class="contenido td_dec" width="25%"><b>'. $folio .'</b></td>                    
                </tr>
                <tr>
                    <td class="variable td_dec" width="15%"><b>Trámite</b></td>
                    <td class="contenido td_dec" width="45%">'.$tipo_tramite.'</td> 
                    <td class="variable td_dec" width="15%"><b>Fecha</b></td>
                    <td class="contenido td_dec" width="25%">'.$fecha_recepcion.'</td>                                         
                </tr>';        
        
        $html.='                          
                <tr>
                    <td class="variable td_dec" width="15%"><b>R.F.C</b></td>
                    <td class="contenido td_dec" width="45%"><b>'.$rfc.'</b></td> 
                    <td class="variable td_dec" width="15%"><b>Persona</b></td>
                    <td class="contenido td_dec" width="25%">'. $tipo_persona .'</td>                                      
                </tr>
                <tr>
                    <td class="variable td_dec" width="15%"><b>Teléfono</b></td>
                    <td class="contenido td_dec" width="45%">'.$telefono.'</td> 
                    <td class="variable td_dec" width="15%"><b>Correo</b></td>
                    <td class="contenido td_dec" width="25%">'. $correo_electronico .'</td>                                      
                </tr>                
                <tr>
                    <td class="variable td_dec" width="15%"><b>Domicilio fiscal</b></td>
                    <td class="contenido td_dec" width="85%" colspan=3>'.$domicilio_fiscal.'</td>                                      
                </tr>';        
        $html.='</tbody>
                </table>'; 

        //Documentación recibida       
        $html.= '<h2 class="titulo_modulos">Observaciones</h2>';

        $html.='<p style="text-align:justify; font-size: 10px;">Con fundamento en el artículo 5, fracción IV, de los “Lineamientos para el Trámite y Expedición de Constancias de Registro de Contratistas y de Supervisores Externos”, se le comunica que la Secretaría le previene por una sola vez, para que solvente las observaciones dentro del término de cinco días hábiles, contados a partir de que haya surtido efectos la notificación; transcurrido el plazo sin que el solicitante desahogue la prevención, se desechará el trámite de la solicitud, pudiendo el Interesado solicitar nuevamente el trámite correspondiente.</p>';

        $html.='<p style="text-align:justify; font-size: 10px;">Los Interesados deberán acusar de recibida la notificación de las observaciones, en un término no mayor a treinta días naturales en el SIRCSE, caso contrario será motivo de desechamiento, pudiendo el Interesado solicitar nuevamente el trámite correspondiente.</p>';        
        
        foreach($observaciones as $key=>$value) {			
            $html.= '<div class="lblarea">'.$key.'</div> ';
            foreach($value as $documento) {
                $html.= '<p class="texto_observacion">'.str_replace("\n", "<br />", $documento).'</p>';
            }		
        }

        $html.='<p style="text-align:justify; font-size: 10px;">Para cualquier duda o aclaración, llame a los números de Atención Telefónica reflejada en el encabezado de su sistema SIRCSE.</p>';


        return $imprimir->observaciones($html, $mode, $folio);
    } 
	
    public function constancia_documentacion($id_tramite, $mode='D'){

        $imprimir = new Imprimir;
        $t_tramite = T_Tramite::detalle($id_tramite);
        $documentacion_recibida = C_Tipo_Tramite::documentacion_requerida_t_combo($id_tramite);

        $sujeto= ($t_tramite->id_sujeto==1) ? "contratistass" : "supervisores";
        $folio= $t_tramite->folio;
        $tipo_tramite= $t_tramite->tipo_tramite;
        $razon_social_o_nombre= $t_tramite->razon_social_o_nombre;
        $rfc= $t_tramite->rfc;
        $tipo_persona= ($t_tramite->id_tipo_persona==1) ? "Fisica" : "Moral";
        $fecha_recepcion= $t_tramite->fecha_inicio;
        //$domicilio_fiscal= "Av. Juan Sabines Int. 101, Ext. 16, Fovissste II C.P. 29024; Tuxtla Gutiérrez, Chiapas";
        $domicilio_fiscal= $t_tramite->calle_fiscal." Int.".$t_tramite->int_fiscal.", Ext.".$t_tramite->ext_fiscal.", ".$t_tramite->colonia_fiscal. " C.P. ".$t_tramite->cp_fiscal."; ".$t_tramite->municipio_fiscal.", ".$t_tramite->estado_fiscal;
        $correo_electronico= $t_tramite->email;
        $telefono= $t_tramite->telefono;

        $html= '<h3 class="titulo2">Constancia de recepción de documentos</h3>';
        $html.= '<h4 class="subtitulo">Padrón de '.$sujeto.'</h4>';

        //Primera tabla
        $html.='<br><table class="table_dts_dec" align="left">
            <tbody>                            
                <tr>
                    <td class="variable td_dec" width="15%"><b>Razón social</b></td>
                    <td class="contenido td_dec" width="45%"><b>'.$razon_social_o_nombre.'</b></td>
                    <td class="variable td_dec" width="15%"><b>Folio</b></td>
                    <td class="contenido td_dec" width="25%"><b>'. $folio .'</b></td>                    
                </tr>
                <tr>
                    <td class="variable td_dec" width="15%"><b>Trámite</b></td>
                    <td class="contenido td_dec" width="45%">'.$tipo_tramite.'</td> 
                    <td class="variable td_dec" width="15%"><b>Fecha</b></td>
                    <td class="contenido td_dec" width="25%">'.$fecha_recepcion.'</td>                                         
                </tr>';   
        $html.='                          
                <tr>
                    <td class="variable td_dec" width="15%"><b>R.F.C</b></td>
                    <td class="contenido td_dec" width="45%"><b>'.$rfc.'</b></td> 
                    <td class="variable td_dec" width="15%"><b>Persona</b></td>
                    <td class="contenido td_dec" width="25%">'. $tipo_persona .'</td>                                      
                </tr>';        
        $html.='</tbody>
                </table>'; 
				
		$html.='<p style="text-align:justify; font-size: 10px;">Con fundamento en el artículo 5, fracción III, de los “Lineamientos para el Trámite y Expedición de Constancias de Registro de Contratistas y de Registro Supervisores Externos”, publicados en el Periódico Oficial del Estado No. 175, de fecha 14 de julio de 2021, se emite la presente constancia de recepción de documentos, la cual NO tiene validez jurídica para participar en procedimientos de adjudicación y contratación de la obra pública, regulados por la Ley de Obra Pública del Estado de Chiapas.</p>';

        //Documentación recibida       
        $html.= '<h2 class="titulo_modulos">Documentación presentada para su revisión</h2> ';
        foreach($documentacion_recibida as $key=>$value) {
            $html.= '<div class="lblarea">'.$key.'</div> ';
            $html.= '<ol class="a" type="b">';
            foreach($value as $documento) {
                $html.= '<li>'.$documento.'</li>';
            }
            $html.= '</ol>';
        }

         //Final
        $html.= '<p style="text-align:justify; font-size: 10px;">La presente constancia de recepción de documentos es de forma cuantitativa, la documentación presentada está sujeta a revisión para constatar su existencia legal y personalidad jurídica, así como su capacidad financiera, y especialidad técnica en la materia de la obra pública, por si o a través del representante técnico que designe, y estar en cumplimiento de sus obligaciones fiscales, como lo establece el artículo 25 de la Ley de Obra Púbica del Estado de Chiapas.</p>';
		
		$html.= '<p style="text-align:justify; font-size: 10px;">Esta Secretaría procederá al análisis de la documentación proporcionada, en el caso de no cumplir con los requisitos aplicables o se le requiera alguna aclaración; se le prevendrá por una sola vez, para que subsane la omisión u observaciones dentro del término de <b>cinco días hábiles</b>, con base en la fracción IV, del artículo 5, de los Lineamientos para el Trámite y Expedición de Constancias de Registro de Contratistas y de Registro Supervisores Externos y 19, primer parrafo de la Ley de Procedimientos Administrativos para el Estado de Chiapas.</p>';
		
        return $imprimir->tramite_acuse_recepcion($html, $mode);
    }  
    
    
    public function constancia_documentos($id_tramite, $mode='D'){

        $imprimir = new Imprimir;
        $t_tramite = T_Tramite::detalle($id_tramite);
        $documentacion_recibida = C_Tipo_Tramite::documentacion_recibida_docs($id_tramite);
        
        $sujeto= ($t_tramite->id_sujeto==1) ? "contratistass" : "supervisores";
        $folio= $t_tramite->folio;
        $tipo_tramite= $t_tramite->tipo_tramite;
        $razon_social_o_nombre= $t_tramite->razon_social_o_nombre;
        $rfc= $t_tramite->rfc;
        $tipo_persona= ($t_tramite->id_tipo_persona==1) ? "Fisica" : "Moral";
        $fecha_recepcion= $t_tramite->fecha_inicio;
        //$domicilio_fiscal= "Av. Juan Sabines Int. 101, Ext. 16, Fovissste II C.P. 29024; Tuxtla Gutiérrez, Chiapas";
        $domicilio_fiscal= $t_tramite->calle_fiscal." Int.".$t_tramite->int_fiscal.", Ext.".$t_tramite->ext_fiscal.", ".$t_tramite->colonia_fiscal. " C.P. ".$t_tramite->cp_fiscal."; ".$t_tramite->municipio_fiscal.", ".$t_tramite->estado_fiscal;
        $correo_electronico= $t_tramite->email;
        $telefono= $t_tramite->telefono;

        $html= '<h3 class="titulo2">Constancia de recepción de documentos</h3>';
        $html.= '<h4 class="subtitulo">Padrón de '.$sujeto.'</h4>';

        //Primera tabla
        $html.='<br><table class="table_dts_dec" align="left">
            <tbody>                            
                <tr>
                    <td class="variable td_dec" width="15%"><b>Razón social</b></td>
                    <td class="contenido td_dec" width="45%"><b>'.$razon_social_o_nombre.'</b></td>
                    <td class="variable td_dec" width="15%"><b>Folio</b></td>
                    <td class="contenido td_dec" width="25%"><b>'. $folio .'</b></td>                    
                </tr>
                <tr>
                    <td class="variable td_dec" width="15%"><b>Trámite</b></td>
                    <td class="contenido td_dec" width="45%">'.$tipo_tramite.'</td> 
                    <td class="variable td_dec" width="15%"><b>Fecha</b></td>
                    <td class="contenido td_dec" width="25%">'.$fecha_recepcion.'</td>                                         
                </tr>';    
        $html.='                          
                <tr>
                    <td class="variable td_dec" width="15%"><b>R.F.C</b></td>
                    <td class="contenido td_dec" width="45%"><b>'.$rfc.'</b></td> 
                    <td class="variable td_dec" width="15%"><b>Persona</b></td>
                    <td class="contenido td_dec" width="25%">'. $tipo_persona .'</td>                                      
                </tr>';        
        $html.='</tbody>
                </table>'; 
				
		$html.='<p style="text-align:justify; font-size: 10px;">Con fundamento en el artículo 5, fracción III, de los “Lineamientos para el Trámite y Expedición de Constancias de Registro de Contratistas y de Registro Supervisores Externos”, publicados en el Periódico Oficial del Estado No. 122, de fecha 19 de agosto de 2020, se emite la presente constancia de recepción de documentos, la cual NO tiene validez jurídica para participar en procedimientos de adjudicación y contratación de la obra pública, regulados por la Ley de Obra Pública del Estado de Chiapas.</p>';

        //Documentación recibida       
        $html.= '<h2 class="titulo_modulos">Documentación presentada para su revisión</h2> ';
        foreach($documentacion_recibida as $key=>$value) {
            $html.= '<div class="lblarea">'.$key.'</div> ';
            $html.= '<ol class="a" type="b">';
            foreach($value as $documento) {
                $html.= '<li>'.$documento.'</li>';
            }
            $html.= '</ol>';
        }

         //Final
        $html.= '<p style="text-align:justify; font-size: 10px;">La documentación presentada está sujeta a revisión para constatar su existencia legal y personalidad jurídica, así como su capacidad financiera, y especialidad técnica en la materia de la obra pública, por si o a través del representante técnico que designe, y estar en cumplimiento de sus obligaciones fiscales, como lo establece el artículo 25 de la Ley de Obra Púbica del Estado de Chiapas.</p>';
		
		$html.= '<p style="text-align:justify; font-size: 10px;">Esta Secretaría procederá al análisis de la documentación proporcionada, en el caso de no cumplir con los requisitos aplicables o se le requiera alguna aclaración; se le prevendrá por una sola vez, para que subsane la omisión u observaciones dentro del término de <b>cinco días hábiles</b>, con base en la fracción IV, del artículo 5, de los Lineamientos para el Trámite y Expedición de Constancias de Registro de Contratistas y de Registro Supervisores Externos y 19, primer parrafo de la Ley de Procedimientos Administrativos para el Estado de Chiapas.</p>';
		
        return $imprimir->tramite_acuse_recepcion($html, $mode);
    }   

}

