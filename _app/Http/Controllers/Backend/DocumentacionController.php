<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\T_Tramite;
use App\Http\Models\Backend\T_Registro;
use App\Http\Models\Catalogos\C_Documentacion_II;
use App\Http\Models\Backend\T_Tramite_Documentacion;
use App\Http\Models\Backend\T_Tramite_Observacion;
use Storage;
use File;
use Auth;
use DB;

class DocumentacionController extends Controller
{
    // private $route = 'mis-tramites';

    public function __construct()
    {
        $this->middleware('auth');
        view()->share('title', 'Mi documentación enviada');
        view()->share('current_route', 'mis-tramites');
    }

    public function mi_documentacion($id_tramite)
     {
        // code...
        $datos = T_Registro::edit(Auth::User()->id_registro);
        $t_tramites = T_Tramite::find($id_tramite);

        $folio='<span class="badge badge-warning">Hasta el momento no existe ningún tramite en proceso.</span>';
        if ( !empty($datos->id_ultimo_tramite) ) {
            $idTramite=(int)$datos->id_ultimo_tramite;
            $vflT_Tramite=T_Tramite::detalle($idTramite);
            
            $folio=$vflT_Tramite->folio .'<span style="display: inline; color: #fff;" class="badge badge-'. $vflT_Tramite->status_general_color .'">'. $vflT_Tramite->status_general .'</span>';

        }

        return view('backend.mis-tramites.mis-documentos', [
            'id_tramite' => $id_tramite,
            'id_tipo_tramite' => $t_tramites->id_tipo_tramite,
            'id_registro'=> $t_tramites->id_cs,
            'datos' => $datos,

            'folio' => $folio,
            'datosTramite' => $vflT_Tramite,
        ]);

     }

    public function solventaciones($id_tramite)
     {
        $filtro=array();       
        $tramites_observacion_status_total=T_Tramite_Observacion::totalObservaciones(['id_tramite'=>$id_tramite]);
        
        $resultados=array();
        $resultados= T_Tramite_Observacion::solventaciones(['id_tramite'=>$id_tramite])->get();
        
        $vfiltro_nDocumentos=array();
        $vfiltro_nDocumentos['id_tramite']=$id_tramite;
        // $vfiltro_nDocumentos['id_area']=$id_area;

        $resultados['n_documentos']=T_Tramite_Observacion::solventacionesAreas( $vfiltro_nDocumentos )->get();
        $resultados['total_observacion']=$tramites_observacion_status_total;

        return response()->json($resultados);
     }

    // 2   LEGAL
    // 3   FINANCIERA
    // 4   TÉCNICA

    public function lista_documentacion_legal($id_tipo_tramite, $id_tramite)
     {
        $tramite=T_Tramite::find($id_tramite);
        $registro=T_Registro::find($tramite->id_cs);
        $resultados=C_Documentacion_II::documentacion_tramite_area($id_tipo_tramite, $registro->id_sujeto, $id_tramite, 2, $registro->id_tipo_persona);
        return $resultados;
     }

    public function lista_documentacion_financiera($id_tipo_tramite, $id_tramite, $obligado_dec_isr)
     {
        $tramite=T_Tramite::find($id_tramite);
        $registro=T_Registro::find($tramite->id_cs);        
        $resultados=C_Documentacion_II::documentacion_tramite_area($id_tipo_tramite, $registro->id_sujeto, $id_tramite, 3, $registro->id_tipo_persona, $registro->obligado_dec_isr);
        return $resultados;        
     } 

    public function lista_documentacion_tecnica($id_tipo_tramite, $id_tramite, $tec_acredita_tmp)
     {
        $tramite=T_Tramite::find($id_tramite);
        $registro=T_Registro::find($tramite->id_cs);
        $resultados=C_Documentacion_II::documentacion_tramite_area($id_tipo_tramite, $registro->id_sujeto, $id_tramite, 4, $registro->id_tipo_persona, $tec_acredita_tmp);
        return $resultados;
     } 


    public function documentacion_adjunta_descargar($id_tramite_documentaion)
     {
        $datos=T_Tramite_Documentacion::where('id', $id_tramite_documentaion)->withTrashed()->first();
        $path=storage_path().'/app/'.$datos->path.'/';
        $file=$path.$datos->nombre;
        return response()->download($file);
     }

    public function download_adjunto_by_name($id_tramite_documentaion, $nombre_documento)
     {
        $datos=T_Tramite_Documentacion::where('id',$id_tramite_documentaion)->withTrashed()->first();
        $path=storage_path().'/app/'.$datos->path.'/';
        $file=$path.$nombre_documento;
        return response()->download($file);
     } 
}
