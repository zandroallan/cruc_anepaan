<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Backend\T_Tramite;
use App\Http\Models\Backend\T_Tramite_Observacion;
use App\Http\Models\Backend\T_Tramite_Cancelado;
use App\Http\Models\Backend\T_Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use File;
use DB;

class TramitesController extends Controller
{
    private $route = 'tramites';
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('title', 'Trámites');
        view()->share('current_route', $this->route);
    }

    public function tramitesSeguimientos()
     {
        // code... 
        $vflT_Tramite=[];
        $observaciones=[];
        $vflT_Registro=T_Registro::edit((int)Auth::User()->id_registro);

        $folio='<span class="badge badge-warning">Hasta el momento no existe ningún tramite en proceso.</span>';
        if ( !empty($vflT_Registro->id_ultimo_tramite) ) {
            $idTramite=(int)$vflT_Registro->id_ultimo_tramite;
            $vflT_Tramite=T_Tramite::detalle($idTramite);
            $observaciones=T_Tramite_Observacion::observacionesAreas($idTramite);

            $folio=$vflT_Tramite->folio;
            $spanfolio = '<span class="label label-lg font-weight-bold label-light-'. $vflT_Tramite->status_general_color .' label-inline">
                <span class="label label-'. $vflT_Tramite->status_general_color .' label-dot mr-2"></span><b>'. $vflT_Tramite->status_general .'</b>
            </span>';
        }
    
        return view('backend.mis-tramites-seguimiento.index', [
            'folio' => $folio,
            'datos' => $vflT_Registro,
            'datosTramite' => $vflT_Tramite,
            'observaciones' => $observaciones,
            'spanfolio' => $spanfolio
        ]);
     }

    public function downloadAdjuntoCancelado($idTramiteCancelado)
    {
        $datos = T_Tramite_Cancelado::where('id_tramite', $idTramiteCancelado)->first();

        $path = '/var/cores/c-sircse-admin/storage/app' . $datos->path . '/';
        $file = $path . $datos->archivo;

        if (($datos->acuse == '') || ($datos->acuse == null)) {
            $vflTramiteCancelado = T_Tramite_Cancelado::find($datos->id);
            $vflTramiteCancelado->fill(['acuse' => date('Y-m-d H:i:s')])->save();
        }
        if (($datos->archivo != '') || ($datos->archivo != null)) {
            return response()->download($file);
        }
    }

    public function resultados(Request $request)
    {
        $anio       = $request->input('anio');
        $i_search   = $request->input('i_search');
        $resultados = T_Tramite::tramites(['anio' => $anio, 'i_search' => $i_search])->get();
        return $resultados;
    }

    public function download_adjunto($id_tramite_documentaion)
    {
        $datos = \App\Http\Models\Backend\T_Tramite_Documentacion::find($id_tramite_documentaion);
        $file  = $datos->nombre;
        $path  = substr(Storage::disk('sircs')->getAdapter()->getPathPrefix(), 0, -1) . $datos->path . '/' . $file;

        return response()->download($path);
    }

    public function destroy_adjunto($id_tramite_documentaion)
    {
        $datos          = \App\Http\Models\Backend\T_Tramite_Documentacion::find($id_tramite_documentaion);
        $arreglo_doctos = "";

        $id_tramite = $datos->id_tramite;
        $datos2     = $datos;

        try {
            DB::beginTransaction();
            $datos->delete();

            //se procede a eliminar los archivos
            $path = substr(Storage::disk('sircs')->getAdapter()->getPathPrefix(), 0, -1) . $datos->path . '/';
            if ($datos->desglose == null) {
                $file = $path . $datos->nombre;
                File::delete($file);
            } else {
                $arreglo_doctos = json_decode($datos->desglose);
                foreach ($arreglo_doctos as $key => $value) {
                    $fileArray = "";
                    $fileArray = $path . $value;
                    File::delete($fileArray);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            $message = ['errors' => $error, 'id_tramite' => $id_tramite];
            return response()->json($message, 409);
        }
        $message = ['success' => 'Los datos han sido <b>eliminados</b>.', 'datos' => $datos2];
        return response()->json($message, 201);
    }

    public function download_adjunto_by_name($id_tramite_documentaion, $nombre_documento)
    {
        $datos = \App\Http\Models\Backend\T_Tramite_Documentacion::find($id_tramite_documentaion);
        $file  = $nombre_documento;
        $path  = substr(Storage::disk('sircs')->getAdapter()->getPathPrefix(), 0, -1) . $datos->path . '/' . $file;

        return response()->download($path);
    }

    public function tramite_datos($id_tramite)
    {

        $datos    = \App\Http\Models\Backend\T_Tramite::find($id_tramite);
        $registro = \App\Http\Models\Backend\T_Registro::find($datos->id_cs);

        $tramite_datos["id_registro"]      = $datos->id_cs;
        $tramite_datos["id_tipo_tramite"]  = $datos->id_tipo_tramite;
        $tramite_datos["id_sujeto"]        = $registro->id_sujeto;
        $tramite_datos["obligado_dec_isr"] = $registro->obligado_dec_isr;
        return response()->json($tramite_datos);
    }
}
