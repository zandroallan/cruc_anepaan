<?php
namespace App\Http\Controllers\Backend;

use App\Http\Classes\Correo;
use App\Http\Classes\CorreoPlantillas;
use App\Http\Classes\FormatDate;
use App\Http\Classes\TipoTramite;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ImpresionController;
use App\Http\Models\Backend\T_Registro;
use App\Http\Models\Backend\T_Tramite;
use App\Http\Models\Backend\T_Tramite_Documentacion;
use App\Http\Models\Backend\T_Tramite_Observacion;
use Auth;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Http\Request;
use Storage;

class MisObservacionesController extends Controller
{
    private $route = 'mis-observaciones';
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('title', 'Mis observaciones');
        view()->share('current_route', $this->route);
    }

    public function index()
    {
        $id    = Auth::User()->id_registro;
        $datos = T_Registro::edit($id);




        $n_dacs       = ["id_tramite" => $datos->id_ultimo_tramite, "id_c_notificacion" => 1, "acepto_condiciones" => 1];
        $t_n_usuarios = \App\Http\Models\Catalogos\N_Usuario::general2($n_dacs)->first();
        if (isset($t_n_usuarios->fecha_acuse)) {
            $fecha_acuse = $t_n_usuarios->fecha_acuse;
        }

        if (isset($t_n_usuarios->fecha_limite)) {
            $fecha_limite = $t_n_usuarios->fecha_limite;
        }

        $fecha_larga = '';
        $en_tiempo   = 0; // 1 = en tiempo  0=no esta en tiempo

        $folio_t  = "";
        $f_limite = "";
        if (isset($t_n_usuarios->folio)) {
            $folio_t = $t_n_usuarios->folio;
        }

        if (isset($fecha_limite)) {
            $f_limite = date("d-m-Y", strtotime($fecha_limite));
        }

        if (isset($t_n_usuarios->fecha_limite)) {
            $fecha_larga               = FormatDate::longDateFormat_day($fecha_limite, 1);
            $fecha_hoy                 = date('Y-m-d H:i:s');
            $fecha_notificacion_limite = date("Y-m-d H:i:s", strtotime($fecha_limite));

            if ($fecha_hoy > $fecha_notificacion_limite) {
                $en_tiempo = 1; //ya no esta en tiempo, ya paso mas de 5 dias desde la notificacion

                //se procedera a cancelar el tramite
                $cancelar = T_Tramite::find($datos->id_ultimo_tramite);

                if (isset($cancelar)) {

                    if ($cancelar->id_status == 4) {
                        $p_cancelar['id_status'] = 3;
                        $cancelar->fill($p_cancelar)->save();
                    }
                }
            }
        }

        //Obtener último trámite
        $ultimo_tramite        = T_registro::get_ultimo_tramite($datos->rfc);
        $clsTipoTramite        = new TipoTramite;
        $tramite_siguiente     = $clsTipoTramite->getNewTramite($ultimo_tramite);
        $lbl_tramite_siguiente = $clsTipoTramite->getTipoTramiteMsg();

        //Todas las observaciones
        $resultados = \App\Http\Models\Backend\T_Tramite_Observacion::observaciones(['id_tramite' => $datos->id_ultimo_tramite])->get();

        $si_o_no              = 1; //si es uno muestra el boton
        $contar_observaciones = 0;
        foreach ($resultados as $obs) {
            if ($obs->solventado == 0) {
                $si_o_no = 0; //si alguno es cero entonces oculto el boton hasta que ya no entre aqui
            }
            $contar_observaciones = $contar_observaciones + 1;
        }

        //tramite
        $_id_status = '';
        $t_tramite  = \App\Http\Models\Backend\T_Tramite::find($datos->id_ultimo_tramite);

        if (isset($t_tramite->id_status)) {
            $_id_status = $t_tramite->id_status;
        }

        $yano                      = 0; // 0 = muestra el boton
        $id_c_tramites_seguimiento = 0;
        if (isset($t_tramite)) {
            $id_c_tramites_seguimiento = $t_tramite->id_c_tramites_seguimiento;
        }

        if (isset($t_tramite->fecha_solventacion)) {
            $yano = 1;
        }
//cuando sea uno ya no muestra el boton

        //n_usuarios
        $n_dacs       = ["id_tramite" => $datos->id_ultimo_tramite, "id_c_notificacion" => 1];
        $t_n_usuarios = \App\Http\Models\Catalogos\N_Usuario::general($n_dacs)->first();

        if (!isset($t_n_usuarios->fecha_acuse)) {
            $si_o_no = 0;
        }

        $documentos_requeridos = [];

        return view('backend.mis-observaciones.index', [
            'contar_observaciones' => $contar_observaciones,
            'fecha_larga' => $fecha_larga, 
            'en_tiempo' => $en_tiempo,
            'yano' => $yano,
            'si_o_no' => $si_o_no,
            'datos' => $datos,
            'tramite_siguiente' => $tramite_siguiente,
            'lbl_tramite_siguiente' => $lbl_tramite_siguiente,
            'documentos_requeridos' => $documentos_requeridos,
            'id_c_tramites_seguimiento' => $id_c_tramites_seguimiento,
            'folio_t' => $folio_t,
            'f_limite' => $f_limite,
            'status_t' => $_id_status
        ]);
    }

    public function mis_observaciones($id_tramite)
    {
        //index de observaciones
        $resultados         = array();
        if ( $id_tramite != 0 ) {
            $resultados_tramite = \App\Http\Models\Backend\T_Tramite::find($id_tramite);
            
            $resultados         = \App\Http\Models\Backend\T_Tramite_Observacion::observaciones(['id_tramite' => $id_tramite, 'id_c_tramites_seguimiento' => $resultados_tramite->id_c_tramites_seguimiento])->get();
        }
        else {
            $resultados['codigo']=0;
            $resultados['mensaje']='Aun no existe un tramite para esta empresa';
        }
        return $resultados;
    }

    public function detalle_observacion($id_observacion)
    {
        //detalle de observacion

        $observacion = \App\Http\Models\Backend\T_Tramite_Observacion::observaciones(['id_tramite_observacion' => $id_observacion])->first();

        $id    = Auth::User()->id_registro;
        $datos = T_Registro::edit($id);

        return view('backend.mis-observaciones.observacion', ['datos' => $datos, 'observacion' => $observacion]);
    }

    public function solventaciones_subidas($idTramiteObservacion)
    {
        $vfiltro                              = array();
        $vfiltro['id_tramites_observaciones'] = $idTramiteObservacion;
        $varchivos_observacion                = T_Tramite_Observacion::solventaciones_subidas($vfiltro)->get();

        return response()->json($varchivos_observacion, 201);
    }

    public function guardar_observacion(Request $request)
     {

        $id_tramite       = $request->input('id_tramite');
        $id_observacion   = $request->input('id_observacion');
        $id_documento     = $request->input('id_documentacion');
        $vinputShowButton = $request->input('inputShowButton');

        try {
            //subir documento
            $files      = $request->file('file_documento');
            $t_tramite  = \App\Http\Models\Backend\T_Tramite::edit($id_tramite);
            $t_registro = \App\Http\Models\Backend\T_Registro::find($t_tramite->id_cs);

            $folder = '/expedientes/' . $t_tramite->anio_inicio . '/' . $t_registro->rfc . '/' . $t_tramite->folio . '/solventaciones';
            if ($t_tramite->anio_inicio < 2022) {
                $folder = '/expedientes/' . $t_registro->rfc . '/' . $t_tramite->folio;
            }

            $path = substr(Storage::disk('sircs')->getAdapter()->getPathPrefix(), 0, -1) . $folder;

            DB::beginTransaction();
            if (is_array($files)) {
                $vdatosAlmacenDesglose = [];
                $vprefijoNombreArchivo = $id_documento . '_' . time();
                foreach ($files as $key => $file) {
                    $vnombreLimpio = str_replace('_', '-', $key);
                    if ($file->isValid()) {
                        $vextensionArchivo = $file->extension();
                        $vnombreArchivo    = $vprefijoNombreArchivo . '_' . $vnombreLimpio . '.' . $vextensionArchivo;

                        $file->storeAs($folder, $vnombreArchivo, 'sircs');
                        array_push($vdatosAlmacenDesglose, $vnombreArchivo);
                    }
                }
                $post_documento["desglose"] = json_encode($vdatosAlmacenDesglose);
            }
            else {
                if ($request->hasFile('file_documento')) {
                    if ($request->file('file_documento')->isValid()) {
                        $file              = $request->file_documento;
                        $vextensionArchivo = $file->extension();
                        $vnombreArchivo    = $id_documento . '_' . time() . '_solventacion.' . $vextensionArchivo;

                        $file->storeAs($folder, $vnombreArchivo, 'sircs');
                    }
                }
            }

            // T_Tramite_Documentacion
            // se agrega el nuevo registro de solventacion
            $t_tramite_observacion = T_Tramite_Observacion::find($id_observacion);
            $valiasDocumento       = $request->input('alias');
            if (isset($valiasDocumento)) {
                $post_documento["alias"] = $valiasDocumento;
            }

            $post_documento["path"]                   = $folder;
            $post_documento["id_documentacion"]       = $id_documento;
            $post_documento["id_registro_temp"]       = $t_registro->id;
            $post_documento["id_tramite"]             = $id_tramite;
            $post_documento["extension"]              = $vextensionArchivo;
            $post_documento["tamanio"]                = 11;
            $post_documento["id_status"]              = 5;
            $post_documento["nombre"]                 = $vnombreArchivo;
            $post_documento["id_usuario_subio"]       = Auth::User()->id;
            $post_documento["id_tramite_observacion"] = $t_tramite_observacion->id;

            $t_tramite_documentacion = new T_Tramite_Documentacion;
            $t_tramite_documentacion->fill($post_documento)->save();

            $post_observacion["id_tramite_documentacion"] = $t_tramite_documentacion->id;
            $t_tramite_observacion->fill($post_observacion)->save();

            DB::commit();
            return redirect()->route('mis-observaciones.index');
        }
        catch (ModelNotFoundException $ex) {
            DB::rollback();
            return redirect('dashboard');
        }
     }

    public function eliminar_solventacion($id_tramite_documentacion)
     {
        if (isset($id_tramite_documentacion)) {
            $vflTramiteDocumentacion                  = T_Tramite_Documentacion::find($id_tramite_documentacion);
            $vdatosTramiteDocumentacion["deleted_at"] = Carbon::now();
            $vflTramiteDocumentacion->fill($vdatosTramiteDocumentacion)->save();

            $arreglo_doctos = "";

            //se procede a eliminar los archivos
            $path = substr(Storage::disk('sircs')->getAdapter()->getPathPrefix(), 0, -1) . $vflTramiteDocumentacion->path . '/';
            if ($vflTramiteDocumentacion->desglose == null) {
                $file = $path . $vflTramiteDocumentacion->nombre;
                File::delete($file);
            } else {
                $arreglo_doctos = json_decode($vflTramiteDocumentacion->desglose);
                foreach ($arreglo_doctos as $key => $value) {
                    $fileArray = "";
                    $fileArray = $path . $value;
                    File::delete($fileArray);
                }
            }
        }
     }

    public function terminar_solventacion(Request $request)
     {
        // Autor: Sandro Alan Gomez Aceituno
        // Modificación: 20 de Abril de 2022
        // Descripción: Terminar la solventación por observación.

        $vcodigoRespuesta = 0;
        $vrespuestaHTTP   = 201;
        $vrutaRedireccion = '';
        $msg              = 'No se pudido mandar la solventacion';
        try {
            DB::beginTransaction();

            $vflTramiteDocumentacion=T_Tramite_Documentacion::general(
                [
                    'id_tramite_observacion' => $request->id_observacion
                ]
            )->get();    

            if ( count($vflTramiteDocumentacion) >= 1 ) {
                $post_observacion["id_status"]  = 5;
                $post_observacion["solventado"] = 1;

                $t_tramite_observacion = T_Tramite_Observacion::find($request->id_observacion);
                $t_tramite_observacion->fill($post_observacion)->save();

                $vcodigoRespuesta = 1;
                $vrutaRedireccion = route('mis-observaciones.index');
                $msg              = 'Observación solventada';
            }
            else {
                $vcodigoRespuesta = 0;
                $vrespuestaHTTP   = 201;
                $vrutaRedireccion = '';
                $msg              = 'No se han cargado documentos para solventar';
            }

            DB::commit();
        }
        catch (Exception $e) {
            $vrespuestaHTTP = 500;
            DB::rollback();
        }

        return response()->json(
            [
                'code'            => $vcodigoRespuesta,
                'msg'             => $msg,
                'rutaRedireccion' => $vrutaRedireccion
                // 'data'            => $t_tramite_observacion
            ], $vrespuestaHTTP);
     }

    public function volverCargarObservacion($idTramiteObservacion)
     {
        # Autor Modifico: Sandro Alan Gómez Aceituno
        # Modificación: 17 de Junio de 2021
        # Descripción: Regresa las observaciones solventadas, para volver ha solventar.

        $vresponse      = array();
        $vrespuestaHTTP = 200;
        try {
            DB::beginTransaction();
            $vflTramiteObservacion             = T_Tramite_Observacion::findOrFail($idTramiteObservacion);
            $vflTramiteObservacion->id_status  = 4;
            $vflTramiteObservacion->solventado = 0;
            $vflTramiteObservacion->save();

            $vrespuesta['code']    = 1;
            $vrespuesta['message'] = 'La observacion ha sido puesto en observacion nuevamente.';
            DB::commit();
        }
        catch (Exception $e) {
            DB::rollback();
            $vrespuesta['code']    = -1;
            $vrespuesta['message'] = 'Ocurrio un error con el servidor, intentelo nuevamente.';
            $vrespuestaHTTP        = 500;
        }
        return response()->json($vrespuesta, $vrespuestaHTTP);
     }

    public function enviar_solventacion_observacion($id_tramite, Request $request)
     {
        # Autor Modifico: Sandro Alan Gómez Aceituno
        # Modificación: 03/06/2021.
        # Descripción: Enviar solventaciones a revision de las áreas.

        try {

            $vflTramite  = T_Tramite::find($id_tramite);
            $vflRegistro = T_Registro::find($vflTramite->id_cs);

            $post_tramite["id_status"]                 = 5;
            $post_tramite["id_c_tramites_seguimiento"] = 3;
            $post_tramite["fecha_solventacion"]        = Carbon::now();

            if ($vflTramite->id_status_area_tecnica == 4) {
                $post_tramite["id_status_area_tecnica"] = 5;
            }

            if ($vflTramite->id_status_area_legal == 4) {
                $post_tramite["id_status_area_legal"] = 5;
            }

            if ($vflTramite->id_status_area_financiera == 4) {
                $post_tramite["id_status_area_financiera"] = 5;
            }

            //creo el documento
            $vnombreArchivo      = "acuse_observaciones_" . $vflTramite->folio . ".pdf";
            $impresionController = new ImpresionController;
            $attachment          = $impresionController->acuseObservacionSolventado($id_tramite);

            $vdatos          = array();
            $vdatos['folio'] = $vflTramite->folio;
            $vdatos['name']  = $vflRegistro->razon_social_o_nombre;
            if ($vflTramite->id_tipo_tramite == 1) {
                $vdatos['tipo_tramite'] = "Inscripción";
            }

            if ($vflTramite->id_tipo_tramite == 2) {
                $vdatos['tipo_tramite'] = "Actualización";
            }

            if ($vflTramite->id_tipo_tramite == 3) {
                $vdatos['tipo_tramite'] = "Modificación";
            }

            $datos_correo                        = array();
            $datos_correo['asunto']              = 'Notificación del Sistema SIRCSE';
            $datos_correo['cuerpo']              = CorreoPlantillas::acuse_observaciones($vdatos);
            $datos_correo['correo_destinatario'] = $vflRegistro->email;
            $datos_correo['nombre_destinatario'] = $vflRegistro->razon_social_o_nombre;
            $vstatusCorreo                       = Correo::sendEmail($datos_correo, 0, $attachment, $vnombreArchivo);

            $vflTramite->fill($post_tramite)->save();
            return redirect()->back()->with('success', "El documento ha sido subido <b>satisfactoriamente</b>.");

        } catch (ModelNotFoundException $ex) {
            return redirect('dashboard');
        }
     }

    public function mis_observaciones2($id_tramite)
     {
        $resultados = \App\Http\Models\Backend\T_Tramite_Observacion::general(['id_tramite' => $id_tramite])->get();
        return $resultados;
     }
}
