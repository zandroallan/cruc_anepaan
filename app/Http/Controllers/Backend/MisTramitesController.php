<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Http\Classes\FormatDate;
use App\Http\Classes\Herramientas;
use App\Http\Classes\TipoTramite;
use App\Http\Classes\Validations;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\D_Personal;
use App\Http\Models\Backend\D_Domicilio;
use App\Http\Models\Backend\T_Contacto;
use App\Http\Models\Backend\T_Registro;
use App\Http\Models\Backend\T_Tramite;
use App\Http\Models\Backend\T_Pagos;
use App\Http\Models\Backend\T_Tramite_Documentacion;
use App\Http\Models\Backend\T_Tramite_Contador;
use App\Http\Models\Backend\T_Tramite_Acta_Instrumento;
use App\Http\Models\Backend\T_Tramite_Dato_Legal;
use App\Http\Models\Backend\T_Tramite_Socio_Legal;
use App\Http\Models\Backend\T_Tramite_Rep_Legal;
use App\Http\Models\Backend\T_Tramite_Rep_Tecnico;
use App\Http\Models\Catalogos\C_Colegio;
use App\Http\Models\Catalogos\C_Municipio;
use App\Http\Models\Catalogos\C_Nacionalidad;
use App\Http\Models\Catalogos\C_Tipo_Identificacion;
use App\Http\Models\Catalogos\C_Especialidad;
use App\Http\Models\Catalogos\C_Estado;
use App\Http\Models\Catalogos\C_Inhabiles;
use App\Http\Models\Catalogos\C_Profesion;
use App\Http\Models\Catalogos\C_Tipo_Rep_Legal;
use App\Http\Models\Catalogos\C_Tipo_Tramite;
use App\Http\Requests\Backend\ContactoRequest;
use Storage;
use Auth;
use DB;
use File;

class MisTramitesController extends Controller
{
    private $route = 'mis-tramites';
    private $ventanillaCerrada=false;
    private $idRegistroAutorizada=array();

    public function __construct()
    {
        $this->middleware('auth');
        view()->share('title', 'Mis trámites');
        view()->share('current_route', $this->route);
    }

    public function resultados_registros(Request $request)
    {
        $array = [];
        $get   = $request->all();
        if (isset($get['i_search'])) {
            $array['i_search'] = $get['i_search'];
        }
        $resultados = T_Registro::general($array)->get();
        return $resultados;
    }

    public function resultados_tramites(Request $request)
    {
        $array = [];
        $get   = $request->all();
        if (isset($get['anio'])) {
            if ($get['anio'] != 0) {
                $array['anio'] = $get['anio'];
            }
        }
        $resultados = T_Tramite::general($array)->get();
        return $resultados;
    }

    public function mis_tramites($id_cs)
    {
        $resultados = T_Tramite::tramites(['id_cs' => $id_cs])->get();

        // print_r($resultados); exit();
        return $resultados;
    }

    public function index()
     {
        $id    = Auth::User()->id_registro;
        $datos = T_Registro::edit($id);

        //Obtener último trámite
        $ultimo_tramite    = T_registro::get_ultimo_tramite_(['id' => $datos->id, 'id_sujeto_tramite' => $datos->id_sujeto]);
        $clsTipoTramite    = new TipoTramite;
        $tramite_siguiente = $clsTipoTramite->getNewTramite($ultimo_tramite);
        $dts=C_Inhabiles::diaInhabil();

        //convierto todos los resultados en un array
        $array_inhabiles_=array();
        foreach ($dts as $registros) {
            array_push($array_inhabiles_,$registros->fecha);//meto al nuevo
        }

        $diaActual  = date('Y-m-d');
        $inhabil=$array_inhabiles_;
        if ( in_array($diaActual, $inhabil) ) {
            $this->ventanillaCerrada= true;
        }

        // if ($diaActual > '2024-09-06') {
        //      $this->ventanillaCerrada= true;
        // }


        $documentos_requeridos = [];
        return view('backend.mis-tramites.index', [
            'datos'                 => $datos, 
            'tramite_siguiente'     => $tramite_siguiente, 
            'lbl_tramite_siguiente' => $clsTipoTramite->getTipoTramiteMsg(), 
            'documentos_requeridos' => $documentos_requeridos,
            'ventanillaCerrada'     => $this->ventanillaCerrada,
            'idRegistroAutorizado'  => $this->idRegistroAutorizada
        ]);
     }

    public function nuevo_tramite()
     {
        $id    = Auth::User()->id_registro;
        $datos = T_Registro::edit($id);
        $curp_ = $datos->curp;

        //$datos->fecha_pago_temp = FormatDate::dia_mes_anio($datos->fecha_pago_temp, 1);
        $ultimo_tramite         = T_registro::get_ultimo_tramite_(['id' => $datos->id, 'id_sujeto_tramite' => $datos->id_sujeto]);
        $clsTipoTramite         = new TipoTramite;
        $tramite_siguiente      = $clsTipoTramite->getNewTramite($ultimo_tramite);

        $id_contacto = 0;

        $contacto = T_Contacto::busca_contacto(['id_registro_temp' => $id])->first();

        if (isset($contacto)) {
            $id_contacto = $contacto->id;
        }

        $terminos = $datos->terminos_temp;

        $lbl_tramite_siguiente      = $clsTipoTramite->getTipoTramiteMsg();
        $lbl_contratista_supervisor = '';
        if ($datos->id_sujeto == 1) {
            $lbl_contratista_supervisor = 'Contratistas';
        }

        if ($datos->id_sujeto == 2) {
            $lbl_contratista_supervisor = 'Supervisores';
        }

        if ($tramite_siguiente != 1 && $tramite_siguiente != 2 && $tramite_siguiente != 3) {
            return redirect()->route($this->route . '.show', $datos->id);
        }

        $estados      = C_Estado::lists();
        $municipios_f = C_Municipio::lists(['id_estado' => $datos->id_estado_fiscal]);
        if ($datos->id_tipo_persona == 1) {
            $municipios_p = C_Municipio::lists(['id_estado' => $datos->id_estado_particular]);
        } else {
            $municipios_p = [0 => "Seleccionar"];
        }

        $nacionalidades        = C_Nacionalidad::lists();
        $tipo_identificaciones = C_Tipo_Identificacion::lists();
        $default_nacionalidad  = $datos->id_nacionalidad;

        $chk_id_sujeto_1        = "";
        $chk_id_sujeto_2        = "";
        $chk_id_tipo_persona_1  = '';
        $chk_id_tipo_persona_2  = "";
        $chk_sexo_1             = '';
        $chk_sexo_2             = "";
        $chk_tec_acredita_tmp_1 = '';
        $chk_tec_acredita_tmp_2 = "";

        $chk_obligado_dec_isr_1                                   = '';
        $chk_obligado_dec_isr_2                                   = "";
        ($datos->obligado_dec_isr == 2) ? $chk_obligado_dec_isr_2 = 'checked=""' : $chk_obligado_dec_isr_1 = 'checked=""';

        ($datos->id_sujeto == 1) ? $chk_id_sujeto_1               = 'checked=""' : $chk_id_sujeto_2               = 'checked=""';
        ($datos->id_tipo_persona == 1) ? $chk_id_tipo_persona_1   = 'checked=""' : $chk_id_tipo_persona_2   = 'checked=""';
        ($datos->tec_acredita_tmp == 2) ? $chk_tec_acredita_tmp_2 = 'checked=""' : $chk_tec_acredita_tmp_1 = 'checked=""';
        ($datos->sexo == 1) ? $chk_sexo_1                         = 'checked=""' : $chk_sexo_2                         = 'checked=""';

        # New CODE-SAGA
        $especialidades          = C_Especialidad::lists(["id_sujeto" => $datos->id_sujeto]);
        $representantes_tecnicos = T_Tramite_Rep_Tecnico::rtecs([]);
        $colegios_rtecs          = C_Colegio::lists(["id_tipo_colegio" => 100]);
        $profesiones             = C_Profesion::lists();
        $tipos_rep_legal         = C_Tipo_Rep_Legal::lists();
        $estados_m               = C_Estado::lists();
        $colegio_especialidades  = [0 => "Seleccionar"];

        return view('backend.mis-tramites.nuevo-tramite', [
            'especialidades'             => $especialidades,
            'representantes_tecnicos'    => $representantes_tecnicos,
            'colegios_rtecs'             => $colegios_rtecs,
            'profesiones'                => $profesiones,
            'colegio_especialidades'     => $colegio_especialidades,
            'tipos_rep_legal'            => $tipos_rep_legal,
            'estados_m'                  => $estados_m,
            'curp_estatica'              => $curp_,
            'datos'                      => $datos,
            'id_tipo_tramite'            => $tramite_siguiente,
            'lbl_tramite_siguiente'      => $lbl_tramite_siguiente,
            'estados'                    => $estados,
            'municipios_f'               => $municipios_f,
            'municipios_p'               => $municipios_p,
            'nacionalidades'             => $nacionalidades,
            'tipo_identificaciones'      => $tipo_identificaciones,
            'default_nacionalidad'       => $default_nacionalidad,
            'chk_id_sujeto_1'            => $chk_id_sujeto_1,
            'chk_id_sujeto_2'            => $chk_id_sujeto_2,
            'chk_id_tipo_persona_1'      => $chk_id_tipo_persona_1,
            'chk_id_tipo_persona_2'      => $chk_id_tipo_persona_2,
            'chk_sexo_1'                 => $chk_sexo_1,
            'chk_sexo_2'                 => $chk_sexo_2,
            'chk_tec_acredita_tmp_1'     => $chk_tec_acredita_tmp_1,
            'chk_tec_acredita_tmp_2'     => $chk_tec_acredita_tmp_2,
            'lbl_contratista_supervisor' => $lbl_contratista_supervisor,
            'chk_obligado_dec_isr_1'     => $chk_obligado_dec_isr_1,
            'chk_obligado_dec_isr_2'     => $chk_obligado_dec_isr_2,
            'id_contacto'                => $id_contacto,
            'terminos'                   => $terminos,
            'ventanillaCerrada'          => $this->ventanillaCerrada,
            'idRegistroAutorizado'       => $this->idRegistroAutorizada
        ]);
     }

    public function store(\App\Http\Requests\Backend\Registro $request)
    {
        $arr_validacion              = [];
        $validation                  = new Validations;
        $status                      = 1;
        $code                        = 201;
        $post                        = $request->all();
        $status_mensaje              = 0;
        $statusExisteRepTecnico      = false;
        $statusExisteDatoLegal       = false;
        $statusExisteActaInstrumento = false;
        $statusExisteRepLegal        = false;
        $route_redirect              = "";
        $send                        = $post["enviar_stt"];
        $id_tipo_persona             = $post['id_tipo_persona'];
        $msg                         = 'Los datos han sido guardados exitosamente.';

        $finDeSemana = false;
        setlocale ( LC_TIME, 'spanish' );
        $diaDeLaSemana = strftime("%A");
        $diaActual     = date("w", strtotime(date('Y-m-d')));
        if ( ($diaActual == 0) || ($diaActual == 6)) $finDeSemana = true;
        if ( 
            $diaDeLaSemana == "sábado"      || 
            $diaDeLaSemana == "sabado"      || 
            $diaDeLaSemana == "domingo"     || 
            $diaDeLaSemana == "Saturday"    || 
            $diaDeLaSemana == "Sunday"      ||
            $diaDeLaSemana == "saturday"    || 
            $diaDeLaSemana == "sunday"
        ) $finDeSemana = true;

        # Sandro Alan
        # Verificar si no hay mas de 40 tramites enviados
        # 1. Begin Code
        if ( $send ) {
            $limiteTramite = true;            
            $diasInhabiles = C_Inhabiles::diasInhabiles();

            if ( count($this->idRegistroAutorizada) > 0 ) {
                foreach ($this->idRegistroAutorizada as $key => $value) {
                    if ( (int)$value == (int)Auth::User()->id_registro )  $limiteTramite = false;
                }
            }
            if ( $this->ventanillaCerrada && $limiteTramite ) {
                $send = 0;
                return response()->json([
                    'status'         => 3,
                    'code'           => 409,
                    'msg'            => 'A las y los Contratistas o Supervisores Externos, se les comunica el cierre de la ventanilla, para el trámite y expedición de las constancias de Registro de Contratistas y de Registro Supervisores Externos concluyó el día 07 de Octubre de 2022 hasta nuevo aviso.',
                    'route_redirect' => $route_redirect], 409);
            }
            else if ((!empty($diasInhabiles) || ($diaActual == 0) || ($diaActual == 6)) && ( $this->ventanillaCerrada && $limiteTramite )) {
                $send = 0;
                return response()->json([
                    'status'         => 3,
                    'code'           => 409,
                    'msg'            => 'Dia inhabil no se pueden enviar tramites.',
                    'route_redirect' => $route_redirect], 409);
            }
            else if ( $finDeSemana == true ) {
                $send = 0;
                return response()->json([
                    'status'         => 3,
                    'code'           => 409,
                    'msg'            => 'No se pueden enviar tramites, los fines de semana.',
                    'route_redirect' => $route_redirect], 409);
            }
            else {
                $vtotalTramites = T_Tramite::totalTramitesDia();
                if ( count($vtotalTramites) >= 1000 ) {
                    if ( $limiteTramite ) {
                        $send = 0;
                        return response()->json([
                            'status'         => 3,
                            'code'           => 409,
                            'msg'            => 'Solo se permite un total de 40 tramites por días.',
                            'route_redirect' => $route_redirect,
                            'data'           => $vtotalTramites],
                            409
                        );
                    }
                }
            }

            # Sandro Alan Gomez Aceituno
            # Asignar los representantes tecnicos con sus id´s de tramite
            # Begin T_Tramite_Rep_Tecnico
            $statusRepTecnico = Herramientas::setRepTecnicoContratista(Auth::user()->id_registro);
            if ($statusRepTecnico == 0) {
                $msg                    = "No se han agregado represententate tecnicos, favor de agregar.";
                $statusExisteRepTecnico = true;
                $send                   = 0;
            }
            # End T_Tramite_Rep_Tecnico

            if ( $id_tipo_persona != 1 ) {
                # Asignar los datos al Acta Instrumento con sus id´s de tramite
                # Begin T_Tramite_Acta_Instrumento
                $statusActaInstrumento = Herramientas::setActaInstrumento(Auth::user()->id_registro);
                if ($statusActaInstrumento == 0) {
                    $msg                         = "No se ha agregado el acta constitutiva, favor de agregar.";
                    $statusExisteActaInstrumento = true;
                    $send                        = 0;
                }
                # End T_Tramite_Dato_Legal

                # Asignar los datos legales con sus id´s de tramite
                # Begin T_Tramite_Dato_Legal
                $statusDatoLegal = Herramientas::setDatoLegal(Auth::user()->id_registro);
                if ( $statusDatoLegal == 0 ) {
                    $msg                   = "No se han agregado los datos legales, favor de agregar.";
                    $statusExisteDatoLegal = true;
                    $send                  = 0;
                }
                # End T_Tramite_Dato_Legal
            }
        }
        # 1. End Code


        $v_folio_p = Herramientas::setFolioPago($post['folio_pago_temp']);
        if ( $v_folio_p == 1 ) {
            $msg    = "No puedes utilizar este folio de pago, porque ya ha sido utilizado en un tramite distinto al suyo.";
            $status = 3;
            $code   = 409;
            $data   = [];
        } 
        else {

            isset($post['id_sujeto']) ? $id_sujeto             = $post['id_sujeto'] : $id_sujeto             = 0;
            isset($post['id']) ? $id                           = $post['id'] : $id                           = 0;
            isset($post['id_tipo_tramite']) ? $id_tipo_tramite = $post['id_tipo_tramite'] : $id_tipo_tramite = 0;
            isset($post['ssjjtt']) ? $ssjjtt                   = $post['ssjjtt'] : $ssjjtt                   = 0;

            //Datos para tabla T_Registro
            if ( $id_sujeto != 0 ) {
                $p_registro['id_sujeto'] = $id_sujeto;
            }
            $p_registro['id_tipo_persona'] = $id_tipo_persona;
            $p_registro['rfc']             = $post['rfc'];
            $p_registro['telefono']        = $post['telefono'];
            $p_registro['email']           = $post['correo'];
            $p_registro['folio_pago_temp'] = $post['folio_pago_temp'];
            $p_registro['fecha_pago_temp'] = $post['fecha_pago_temp'];

            //Datos para D_Domicilio fiscal
            $p_domicilio_fiscal['id_tipo_domicilio'] = 2;
            $p_domicilio_fiscal['id_municipio']      = $post['id_municipio_fiscal'];
            $p_domicilio_fiscal['ciudad']            = $post['ciudad_fiscal'];
            $p_domicilio_fiscal['codigo_postal']     = $post['cp_fiscal'];
            $p_domicilio_fiscal['calle']             = $post['calle_fiscal'];
            $p_domicilio_fiscal['num_exterior']      = $post['ext_fiscal'];
            $p_domicilio_fiscal['num_interior']      = $post['int_fiscal'];
            $p_domicilio_fiscal['colonia']           = $post['colonia_fiscal'];
            $p_domicilio_fiscal['referencias']       = $post['referencias_fiscal'];

            if ( $id_tipo_persona == 1 ) {
                //Datos para tabla T_Registro
                $p_registro['razon_social_o_nombre'] = $post['nombre'] . ' ' . $post['ap_paterno'] . ' ' . $post['ap_materno'];
                //Datos personales
                $p_personal['nombre']     = $post['nombre'];
                $p_personal['ap_paterno'] = $post['ap_paterno'];
                $p_personal['ap_materno'] = $post['ap_materno'];
                $p_personal['rfc']                    = $post['rfc'];
                $p_personal['id_nacionalidad']        = $post['id_nacionalidad'];
                $p_personal['sexo']                   = $post['sexo'];
                $p_personal['telefono']               = $post['telefono'];
                $p_personal['correo_electronico']     = $post['correo'];
                $p_personal['id_tipo_identificacion'] = $post['id_tipo_identificacion'];
                $p_personal['numero_identificacion']  = $post['numero_identificacion'];

                //Datos para D_Domicilio particular
                $p_domicilio_particular['id_tipo_domicilio'] = 1;
                $p_domicilio_particular['id_municipio']      = $post['id_municipio_particular'];
                $p_domicilio_particular['ciudad']            = $post['ciudad_particular'];
                $p_domicilio_particular['codigo_postal']     = $post['cp_particular'];
                $p_domicilio_particular['calle']             = $post['calle_particular'];
                $p_domicilio_particular['num_exterior']      = $post['ext_particular'];
                $p_domicilio_particular['num_interior']      = $post['int_particular'];
                $p_domicilio_particular['colonia']           = $post['colonia_particular'];
                $p_domicilio_particular['referencias']       = $post['referencias_particular'];
            } 
            else {
                //Datos para tabla T_Registro
                $p_registro['razon_social_o_nombre'] = $post['razon_social_o_nombre'];
            }

            $validation->registroNuevo(['id' => $id, 'rfc' => $p_registro['rfc'], 'id_tipo_tramite' => $id_tipo_tramite, 'id_sujeto' => $ssjjtt], $send);
            if (!$validation->getStatusB()) {
                //si todo esta bien entra
                try {
                    DB::beginTransaction();
                    if ( $id == 0 ) {
                        $d_registro         = new T_Registro;
                        $d_domicilio_fiscal = new D_Domicilio;
                        $t_tramite          = new T_Tramite;
                        if ( $id_tipo_persona == 1 ) {
                            $d_personal             = new D_Personal;
                            $d_domicilio_particular = new D_Domicilio;
                        }
                    }
                    else {
                        $d_registro = T_Registro::find($id);
                        if ($id_tipo_tramite != 0) {
                            $t_tramite = new T_Tramite;
                            if ($d_registro->id_d_domicilio_fiscal == null) {
                                $d_domicilio_fiscal = new D_Domicilio;
                            } 
                            else {
                                $d_domicilio_fiscal = D_Domicilio::find($d_registro->id_d_domicilio_fiscal);
                            }
                            if ($id_tipo_persona == 1) {
                                if ($d_registro->id_d_personal == null) {
                                    $d_personal             = new D_Personal;
                                    $d_domicilio_particular = new D_Domicilio;
                                }
                                else {
                                    $d_personal = D_Personal::find($d_registro->id_d_personal);
                                    if ($d_personal->id_d_domicilio == null) {
                                        $d_domicilio_particular = new D_Domicilio;
                                    } 
                                    else {
                                        $d_domicilio_particular = D_Domicilio::find($d_personal->id_d_domicilio);
                                    }
                                }
                            }
                        }
                        else {
                            $d_domicilio_fiscal = D_Domicilio::find($post['id_domicilio_fiscal']);
                            if ($id_tipo_persona == 1) {
                                $d_personal             = D_Personal::find($post['id_d_personal']);
                                $d_domicilio_particular = D_Domicilio::find($post['id_domicilio_particular']);
                            }
                        }
                    }

                    //Domicilio fiscal
                    $d_domicilio_fiscal->fill($p_domicilio_fiscal)->save();
                    $p_registro['id_d_domicilio_fiscal'] = $d_domicilio_fiscal->id;
                    if ($id_tipo_persona == 1) {
                        $d_domicilio_particular->fill($p_domicilio_particular)->save();
                        $p_personal['id_d_domicilio'] = $d_domicilio_particular->id;
                        $d_personal->fill($p_personal)->save();
                        $p_registro['id_d_personal'] = $d_personal->id;
                    }
                    $d_registro->fill($p_registro)->save();
                    $msg    = "Los datos han sido guardados exitosamente.";

                    if ($send == 1 && $id_tipo_tramite != 0) {
                        $v_folio_p = Herramientas::setFolioPago($d_registro->folio_pago_temp);
                        if ($v_folio_p == 1) {
                            $msg    = "No puedes utilizar este folio de pago, porque ya ha sido utilizado en un tramite distinto al suyo.";
                            $status = 3;
                            $code   = 409;
                            $data   = [];
                        } 
                        else {
                            $existe_contacto = Herramientas::setContacto($d_registro->id);
                            if ($existe_contacto == 0) {
                                $status_mensaje = 1;
                                $msg            = "No has agregado ningun contacto es obligatorio para que tu tramite se pueda generar.";
                                $status         = 3;
                                $code           = 409;
                                $data           = [];
                            } 
                            else {
                                //busca socios legales
                                $busca_socios_legales = T_Tramite_Socio_Legal::general(['id_registro_temp' => $id])->get();
                                if (count($busca_socios_legales) == 0 && $id_tipo_persona == 2) {
                                    $status_mensaje = 1;
                                    $msg            = "No has agregado ningun socio legal es obligatorio para que tu tramite se pueda generar.";
                                    $status         = 3;
                                    $code           = 409;
                                    $data           = [];
                                }
                                else {
                                    //enviar tramite
                                    $id_sujeto                        = $d_registro->id_sujeto;
                                    ($id_sujeto == 1) ? $clave_sujeto = "C" : $clave_sujeto = "S";
                                    $total_tramites                   = (T_Tramite::total_anio(date('Y'), $id_sujeto)) + 1;

                                    // Modificacion de folio
                                    $p_tramite['folio']      = str_pad($total_tramites, 4, "0", STR_PAD_LEFT) . '-' . $clave_sujeto . '-' . date('Y');
                                    $documentacion_recibida  = T_Tramite_Documentacion::documentacion_temporal_array($id);
                                    $documentacion_requerida = C_Tipo_Tramite::documentacion_requerida($id_tipo_tramite, $id_sujeto);
                                    $documentacion_pendiente = array_diff($documentacion_requerida, $documentacion_recibida);

                                    $p_tramite['id_cs']                       = $d_registro->id;
                                    $p_tramite['id_tipo_tramite']             = $id_tipo_tramite;
                                    $p_tramite['fecha_inicio']                = date('Y-m-d H:i:s');
                                    $p_tramite['especialidades_tecnicas']     = json_encode([]);
                                    $p_tramite['documentacion_recibida']      = json_encode($documentacion_recibida);
                                    $p_tramite['documentacion_pendiente']     = json_encode(array_values($documentacion_pendiente));
                                    $p_tramite['documentacion_revisada']      = json_encode([]);
                                    $p_tramite['documentacion_no_revisada']   = json_encode($documentacion_recibida);
                                    $p_tramite['documentacion_observaciones'] = json_encode([]);
                                    $p_tramite['id_d_domicilio_fiscal']       = $d_domicilio_fiscal->id;
                                    $p_tramite['telefono']                    = $post['telefono'];
                                    $p_tramite['email']                       = $post['correo'];
                                    $p_tramite['obligado_dec_isr']            = $d_registro->obligado_dec_isr;

                                    //Asignar responsables
                                    $turnar        = new \App\Http\Classes\Turnar;
                                    $turnar_status = $turnar->asignar_responsables();
                                    if ($turnar_status == true) {
                                        $array                        = [];
                                        $p_tramite['id_r_area_legal'] = $turnar->getResponsableAreaLegal();
                                        array_push($array, $turnar->getResponsableAreaLegal());
                                        if ($id_sujeto == 1) {
                                            $p_tramite['id_r_area_financiera'] = $turnar->getResponsableAreaFinanciera();
                                            array_push($array, $turnar->getResponsableAreaFinanciera());
                                        }
                                        $p_tramite['id_r_area_tecnica'] = $turnar->getResponsableAreaTecnica();
                                        array_push($array, $turnar->getResponsableAreaTecnica());
                                    }

                                    $p_tramite['id_sujeto_tramite'] = $id_sujeto;
                                    $p_tramite['terminos']          = 1;
                                    $t_tramite->fill($p_tramite)->save();

                                    $upd_reg                    = T_Registro::find($id);
                                    $p_upd_reg['terminos_temp'] = 0;
                                    $upd_reg->fill($p_upd_reg)->save();

                                    # Sandro Alan Gomez Aceituno
                                    # Asignar los representantes tecnicos con sus id´s de tramite
                                    # Begin T_Tramite_Rep_Tecnico

                                    $_MDL_Tramite_Contador=T_Tramite_Contador::where('id_registro_tmp', Auth::User()->id_registro)->first();
                                    $_MDL_Tramite_Contador->fill(['id_registro_tmp'=>null, 'id_tramite'=> $t_tramite->id])->save();

                                    $datosRepTecnico = T_Tramite_Rep_Tecnico::getRepTecnicoTMP(['id_registro_tmp' => Auth::user()->id_registro])->get();
                                    if (count($datosRepTecnico) > 0) {
                                        foreach ($datosRepTecnico as $key => $value) {
                                            # code...
                                            $vdatoRepTecnico                  = T_Tramite_Rep_Tecnico::findOrFail($value->id);
                                            $vflRepTecnico['id_tramite']      = $t_tramite->id;
                                            $vflRepTecnico['id_registro_tmp'] = null;
                                            $vdatoRepTecnico->fill($vflRepTecnico)->save();
                                            unset($vflRepTecnico, $vdatoRepTecnico);
                                        }
                                    }
                                    #End T_Tramite_Rep_Tecnico

                                    # Asignar los datos legales con sus id´s de tramite
                                    # Begin T_Tramite_Dato_Legal
                                    $datosDatoLegal = T_Tramite_Dato_Legal::general(['id_registro_tmp' => Auth::user()->id_registro])->first();
                                    if (isset($datosDatoLegal)) {
                                        $vflDatoLegal['id_tramite']      = $t_tramite->id;
                                            $vflDatoLegal['id_registro_tmp'] = null;
                                        $vdatoDatoLegal                  = T_Tramite_Dato_Legal::findOrFail($datosDatoLegal->id);
                                        $vdatoDatoLegal->fill($vflDatoLegal)->save();
                                        unset($vflDatoLegal, $vdatoDatoLegal, $datosDatoLegal);
                                    }
                                    #End T_Tramite_Rep_Tecnico

                                    # Asignar los datos al acta instrumento con sus id´s de tramite
                                    # Begin T_Tramite_Acta_Instrumento
                                    $datosActaInstrumento = T_Tramite_Acta_Instrumento::general(['id_registro_tmp' => Auth::user()->id_registro])->first();
                                    if (isset($datosActaInstrumento)) {
                                        $vfldatoActaInstrumento['id_tramite']      = $t_tramite->id;
                                        $vfldatoActaInstrumento['id_registro_tmp'] = null;
                                        $vdatoActaInstrumento                      = T_Tramite_Acta_Instrumento::findOrFail($datosActaInstrumento->id);
                                        $vdatoActaInstrumento->fill($vfldatoActaInstrumento)->save();
                                        unset($vfldatoActaInstrumento, $vdatoActaInstrumento, $datosActaInstrumento);
                                    }
                                    #End T_Tramite_Acta_Instrumento

                                    if ($id_tipo_persona != 1) {
                                        # Asignar los datos al acta instrumento con sus id´s de tramite
                                        # Begin T_Tramite_Rep_Legal
                                        $datosRepLegal = T_Tramite_Rep_Legal::general(['id_registro_tmp' => Auth::user()->id_registro])->first();
                                        if (isset($datosRepLegal)) {
                                            $vfldatoRepLegal['id_tramite']      = $t_tramite->id;
                                            $vfldatoRepLegal['id_registro_tmp'] = null;
                                            $vdatoRepLegal                      = T_Tramite_Rep_Legal::findOrFail($datosRepLegal->id);
                                            $vdatoRepLegal->fill($vfldatoRepLegal)->save();

                                            $vfldatoActaInstrumentoRepLegal['id_tramite'] = $t_tramite->id;
                                            $vdatoActaInstrumentoRepLegal                 = T_Tramite_Acta_Instrumento::findOrFail($vdatoRepLegal->id_acta_instrumento);
                                            $vdatoActaInstrumentoRepLegal->fill($vfldatoActaInstrumentoRepLegal)->save();
                                            unset($vfldatoRepLegal, $vdatoRepLegal, $datosRepLegal, $vfldatoActaInstrumentoRepLegal, $vdatoActaInstrumentoRepLegal);
                                        }
                                        #End T_Tramite_Rep_Legal
                                    }

                                    $t_pago                   = new T_Pagos;
                                    $p_pago['id_tramite']     = $t_tramite->id;
                                    $p_pago['folio_hacienda'] = $d_registro->folio_pago_temp;
                                    $p_pago['fecha_pago']     = $d_registro->fecha_pago_temp;
                                    $t_pago->fill($p_pago)->save();

                                    //Enviar notificaciones
                                    if ($turnar_status == true) {
                                        $notificacion     = new \App\Http\Classes\Notificacion;
                                        $notificacion_msg = 'Tienes turnado un nuevo trámite en tu bandeja con folio <b>' . $p_tramite['folio'] . '</b>';
                                        $notificacion->setIdTramite($t_tramite->id);
                                        $notificacion->setDescripcion($notificacion_msg);
                                        $r = $notificacion->turnarAreasNotificacion($array);
                                    }

                                    $d_registro2                      = T_Registro::find($d_registro->id);
                                    $p_registro2['id_ultimo_tramite'] = $t_tramite->id;
                                    $d_registro2->fill($p_registro2)->save();

                                    $t_contacto_t                        = T_Contacto::busca_contacto(['id_registro_temp' => $d_registro->id])->first();
                                    $post_contacto_t['id_registro_temp'] = null;
                                    $post_contacto_t['id_tramite']       = $t_tramite->id;
                                    $t_contacto_t->fill($post_contacto_t)->save();

                                    //Actualizar documentacion
                                    $documentacion_subida = T_Tramite_Documentacion::general(['id_registro_temp' => $id])->get();
                                    $folder               = '/expedientes/' . date('Y') . '/' . $d_registro2->rfc . '/' . $t_tramite->folio;

                                    foreach ($documentacion_subida as $doc_subida) {
                                        $t_tramites_documentacion                    = T_Tramite_Documentacion::find($doc_subida->id);
                                        $p_tramite_documentacion['id_tramite']       = $t_tramite->id;
                                        $p_tramite_documentacion['path']             = $folder;
                                        $p_tramite_documentacion['id_registro_temp'] = null;
                                        $t_tramites_documentacion->fill($p_tramite_documentacion)->save();
                                    }

                                    //Actualizar socios legales
                                    $socios_legales_agregados = T_Tramite_Socio_Legal::general(['id_registro_temp' => $id])->get();

                                    foreach ($socios_legales_agregados as $socio) {
                                        $t_tramites_socios_legales                     = T_Tramite_Socio_Legal::find($socio->id);
                                        $p_tramites_socios_legales['id_tramite']       = $t_tramite->id;
                                        $p_tramites_socios_legales['id_registro_temp'] = null;
                                        $t_tramites_socios_legales->fill($p_tramites_socios_legales)->save();
                                    }

                                    $vdatos                 = array();
                                    $vdatos['name']         = $p_registro['razon_social_o_nombre'];
                                    $vdatos['folio']        = $t_tramite->folio;
                                    $vdatos['fecha_inicio'] = $p_tramite['fecha_inicio'];
                                    if ($id_tipo_tramite == 1) {$tipo_tramite = "Inscripción";}
                                    if ($id_tipo_tramite == 2) {$tipo_tramite = "Actualización";}
                                    if ($id_tipo_tramite == 3) {$tipo_tramite = "Modificación";}
                                    $vdatos['tipo_tramite'] = $tipo_tramite;

                                    $datos_correo                        = array();
                                    $datos_correo['asunto']              = 'Portal del contratista SAyBG: Registro de cuenta de usuario';
                                    $datos_correo['cuerpo']              = \App\Http\Classes\CorreoPlantillas::solicitud_enviada($vdatos);
                                    $datos_correo['correo_destinatario'] = [$p_registro['email']];
                                    $datos_correo['nombre_destinatario'] = $p_registro['razon_social_o_nombre'];
                                    $impresion_controller                = new \App\Http\Controllers\ImpresionController();
                                    $attachment                          = $impresion_controller->constancia_documentacion($t_tramite->id, 'S');
                                    $vstatusCorreo                       = \App\Http\Classes\Correo::sendEmail($datos_correo, 1, $attachment);
                                }
                            }
                        }
                    }

                    DB::commit();
                    if ($id == 0) {
                        if (
                            $status_mensaje != 1 &&
                            !$statusExisteRepTecnico &&
                            !$statusExisteActaInstrumento &&
                            !$statusExisteRepLegal
                        ) {
                            $msg            = "La información ha sido registrada";
                            $route_redirect = route($this->route . '.index');
                        }
                    }
                    else {
                        if (
                            $status_mensaje != 1 &&
                            !$statusExisteRepTecnico &&
                            !$statusExisteActaInstrumento &&
                            !$statusExisteRepLegal
                        ) {
                            if ($send != 0) {
                                $msg = "La información ha sido actualizada";
                            }
                            $route_redirect = route($this->route . '.index');
                        }
                    }
                    $data = [];
                }
                catch (\Exception $e) {
                    $status         = 3;
                    $code           = 409;
                    $msg            = "No pudimos procesar la solicitud de su navegador porque hay peticiones simultaneas al recurso correspondiente, intente de nuevo.". $e->getMessage();
                    $route_redirect = "";
                    $data           = [];
                    DB::rollback();
                }
            } 
            else {
                $status         = 3;
                $code           = $validation->getStatusCode();
                $msg            = $validation->getStatusMsg();
                $route_redirect = "";
                $data           = [];
            }
            if ($status == 1 && $send == 1) {
                Storage::disk('sircs')->makeDirectory($folder);
                $folderTMP = 'expedientes/' . date('Y') . '/' . $d_registro2->rfc . '/tmp';
                $oldFolder = substr(Storage::disk('sircs')->getAdapter()->getPathPrefix(), 0, -1) . '/' . $folderTMP;
                $newFolder = substr(Storage::disk('sircs')->getAdapter()->getPathPrefix(), 0, -1) . '/' . $folder;

                // Se comprueba que realmente sea la ruta de un directorio
                if (is_dir($oldFolder)) {
                    // Abre un gestor de directorios para la ruta indicada
                    $gestor = opendir($oldFolder);
                    // Recorre todos los elementos del directorio
                    while (($archivo = readdir($gestor)) !== false) {
                        $ruta_completa = $oldFolder . "/" . $archivo;

                        // Se muestran todos los archivos y carpetas excepto "." y ".."
                        if ($archivo != "." && $archivo != "..") {
                            File::move($oldFolder . '/' . $archivo, $newFolder . '/' . $archivo, 'sircs');
                        }
                    }
                    // Cierra el gestor de directorios
                    closedir($gestor);
                }
            }
        }

        return response()->json(['status' => $status, 'code' => $code, 'msg' => $msg, 'route_redirect' => $route_redirect, 'data' => $data], $code);
    }

    public function tec_acredita($id, $tec_acredita)
     {
        $arr_validacion = [];
        $validation     = new Validations;
        $status         = 1;
        $code           = 201;

        if (!$validation->getStatusB()) {
            try {
                DB::beginTransaction();
                $d_registro                     = T_Registro::find($id);
                $p_registro['tec_acredita_tmp'] = $tec_acredita;
                $d_registro->fill($p_registro)->save();
                DB::commit();
                $msg            = "La información ha sido actualizada";
                $route_redirect = "";
                $data           = $d_registro;
            } catch (\Exception $e) {
                $status         = 3;
                $code           = 409;
                $msg            = $e->getMessage();
                $route_redirect = "";
                $data           = [];
                DB::rollback();
            }
        } else {
            $status         = 3;
            $code           = $validation->getStatusCode();
            $msg            = $validation->getStatusMsg();
            $route_redirect = "";
            $data           = [];
        }
        return response()->json(['status' => $status, 'code' => $code, 'msg' => $msg, 'route_redirect' => $route_redirect, 'data' => $data], $code);
     }

    public function obligado_dec_isr($id, $obligado_dec_isr)
     {
        //actaliza si esta obligado a presentear declaracion anual cada vez que oprime el radiobutton
        $arr_validacion = [];
        $validation     = new Validations;
        $status         = 1;
        $code           = 201;

        if (!$validation->getStatusB()) {
            try {
                DB::beginTransaction();
                $d_registro                     = T_Registro::find($id);
                $p_registro['obligado_dec_isr'] = $obligado_dec_isr;
                $d_registro->fill($p_registro)->save();
                DB::commit();
                $msg            = "La información ha sido actualizada";
                $route_redirect = "";
                $data           = $d_registro;
            } catch (\Exception $e) {
                $status         = 3;
                $code           = 409;
                $msg            = $e->getMessage();
                $route_redirect = "";
                $data           = [];
                DB::rollback();
            }
        } else {
            $status         = 3;
            $code           = $validation->getStatusCode();
            $msg            = $validation->getStatusMsg();
            $route_redirect = "";
            $data           = [];
        }
        return response()->json(['status' => $status, 'code' => $code, 'msg' => $msg, 'route_redirect' => $route_redirect, 'data' => $data], $code);
     }

    public function store_document_tmp(\App\Http\Requests\Backend\SubirDocumento $request)
     {
        $arr_validacion = [];
        $validation     = new Validations;
        $status         = 1;
        $code           = 201;
        $post           = $request->all();
        $id_registro    = $post["id_registro"];
        $id_documento   = $post["id_documento"];

        $t_registro = T_Registro::find($id_registro);
        $folder     = '/expedientes/' . date('Y') . '/' . $t_registro->rfc . '/tmp';

        $path = substr(Storage::disk('sircs')->getAdapter()->getPathPrefix(), 0, -1) . $folder;
        $validation->registroSubirDocumentoTmp(['id_registro' => $id_registro, 'id_documento' => $id_documento]);
        if (!$validation->getStatusB()) {
            try {
                DB::beginTransaction();
                $t_tramite_documentacion = new T_Tramite_Documentacion;

                if ($request->hasFile('archivosubido')) {
                    if ($request->file('archivosubido')->isValid()) {
                        $file      = $request->archivosubido;
                        $extension = $file->extension();
                        $fileName  = $id_documento . '_' . time() . '.' . $extension;
                        $request->file('archivosubido')->storeAs($folder, $fileName, 'sircs');
                    }
                }

                $post_documento["id_registro_temp"] = $id_registro;
                $post_documento["id_documentacion"] = $id_documento;
                $post_documento["path"]             = $folder;
                $post_documento["nombre"]           = $fileName;
                $post_documento["extension"]        = $extension;
                $post_documento["tamanio"]          = 11;
                $post_documento["id_status"]        = 2;
                $post_documento["id_usuario_subio"] = Auth::User()->id;
                $t_tramite_documentacion->fill($post_documento)->save();
                DB::commit();

                $msg                      = "El documento ha sido subido satisfactoriamente";
                $route_redirect           = route($this->route . '.index');
                $data                     = $t_tramite_documentacion;
                $data["id_sujeto"]        = $t_registro->id_sujeto;
                $data["tec_acredita_tmp"] = $t_registro->tec_acredita_tmp;
                $data["obligado_dec_isr"] = $t_registro->obligado_dec_isr;
            } 
            catch (\Exception $e) {
                $status         = 3;
                $code           = 409;
                $msg            = $e->getMessage();
                $route_redirect = "";
                $data           = [];
                DB::rollback();
            }
        } else {
            $status         = 3;
            $code           = $validation->getStatusCode();
            $msg            = $validation->getStatusMsg();
            $route_redirect = "";
            $data           = [];
        }
        return response()->json(['status' => $status, 'code' => $code, 'msg' => $msg, 'route_redirect' => $route_redirect, 'data' => $data], $code);
     }

    public function store_document_soporte(\App\Http\Requests\Backend\SubirDocumentoSoporte $request)
     {
        $arr_validacion = [];
        $validation     = new Validations;
        $status         = 1;
        $code           = 201;
        $post           = $request->all();
        $id_registro    = $post["id_registro"];
        $id_documento   = $post["id_documento_soporte"];
        $files          = $request->file('files');

        $file_alias = $post["files-alias"];

        if (!$validation->getStatusB()) {
            try {

                DB::beginTransaction();
                $t_tramite_documentacion = new T_Tramite_Documentacion;
                $prefijo                 = $id_documento . '_' . time();

                $t_registro = T_Registro::find($id_registro);

                $folder   = '/expedientes/' . date('Y') . '/' . $t_registro->rfc . '/tmp';
                $path     = substr(Storage::disk('sircs')->getAdapter()->getPathPrefix(), 0, -1) . $folder;
                $desglose = [];

                foreach ($files as $key => $file) {
                    $key2 = str_replace('_', '-', $key);
                    if ($file->isValid()) {
                        $extension = $file->extension();
                        $fileName  = $prefijo . '_' . $key2 . '.' . $extension;
                        $file->storeAs($folder, $fileName, 'sircs');
                        array_push($desglose, $fileName);
                    }
                }

                if (count($desglose) > 0) {
                    // if ($id_documento == 266 || $id_documento == 317) {
                    //     $post_documento["alias"] = $file_alias;
                    // }

                    $post_documento["id_registro_temp"] = $id_registro;
                    $post_documento["id_documentacion"] = $id_documento;
                    $post_documento["path"]             = $folder;
                    $post_documento["nombre"]           = $fileName;
                    $post_documento["extension"]        = $extension;
                    $post_documento["desglose"]         = json_encode($desglose);
                    $post_documento["tamanio"]          = 11;
                    $post_documento["id_status"]        = 2;
                    $post_documento["id_usuario_subio"] = Auth::User()->id;
                    $t_tramite_documentacion->fill($post_documento)->save();
                }

                DB::commit();

                $msg                      = "Los documentos han sido subidos satisfactoriamente";
                $route_redirect           = route($this->route . '.index');
                $data                     = $t_tramite_documentacion;
                $data["id_sujeto"]        = $t_registro->id_sujeto;
                $data["tec_acredita_tmp"] = $t_registro->tec_acredita_tmp;
                $data["obligado_dec_isr"] = $t_registro->obligado_dec_isr;

                $d_registro = T_Registro::find($id_registro);

                $data["tec_acredita_tmp"] = $d_registro->tec_acredita_tmp;
                $data["obligado_dec_isr"] = $d_registro->obligado_dec_isr;
            } catch (\Exception $e) {
                $status         = 3;
                $code           = 409;
                $msg            = $e->getMessage();
                $route_redirect = "";
                $data           = [];
                DB::rollback();
            }
        } 
        else {
            $status         = 3;
            $code           = $validation->getStatusCode();
            $msg            = $validation->getStatusMsg();
            $route_redirect = "";
            $data           = [];
        }
        return response()->json(['status' => $status, 'code' => $code, 'msg' => $msg, 'route_redirect' => $route_redirect, 'data' => $data], $code);
     }

    public function mis_observaciones($id_tramite)
     {
        $resultados = T_Tramite_Observacion::general(['id_tramite' => $id_tramite, 'id_c_tramites_seguimiento' => 2])->get();
        return $resultados;
     }

    //Socios legales
    //lista todos los socios en la tabla
    public function resultados_socios_legales($id_tramite)
     {
        $resultados = T_Tramite_Socio_Legal::general(['id_registro_temp' => $id_tramite])->get();
        return $resultados;
     }

    public function destroy_socios_legales($id)
    {

        $d_registro = T_Tramite_Socio_Legal::find($id);

        $id_tramite = $d_registro->id_registro_temp;
        try {
            DB::beginTransaction();
            $d_registro->delete();
            DB::commit();
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            $message = ['errors' => $error, 'id_tramite' => $id_tramite];
            return response()->json($message, 409);
        }
        $message = ['success' => 'Los datos han sido <b>eliminados</b>.', 'id_tramite' => $id_tramite];
        return response()->json($message, 201);
    }

    public function get_socio_legal($id)
    {
        //
        $t_tramites_socios_legales = T_Tramite_Socio_Legal::edit($id);

        if (!$t_tramites_socios_legales) {

            $t_tramites_socios_legales["id"]                     = 0;
            $t_tramites_socios_legales["id_d_personal"]          = 0;
            $t_tramites_socios_legales["nombre"]                 = "";
            $t_tramites_socios_legales["ap_paterno"]             = "";
            $t_tramites_socios_legales["ap_materno"]             = "";
            $t_tramites_socios_legales["curp"]                   = "";
            $t_tramites_socios_legales["rfc"]                    = "";
            $t_tramites_socios_legales["id_nacionalidad"]        = 0;
            $t_tramites_socios_legales["telefono"]               = "";
            $t_tramites_socios_legales["correo_electronico"]     = "";
            $t_tramites_socios_legales["id_tipo_identificacion"] = 0;
            $t_tramites_socios_legales["numero_identificacion"]  = "";

            $t_tramites_socios_legales["id_estado_particular"]    = 0;
            $t_tramites_socios_legales["id_municipio_particular"] = 0;
            $t_tramites_socios_legales["ciudad_particular"]       = "";
            $t_tramites_socios_legales["cp_particular"]           = "";
            $t_tramites_socios_legales["calle_particular"]        = "";
            $t_tramites_socios_legales["ext_particular"]          = "";
            $t_tramites_socios_legales["int_particular"]          = "";
            $t_tramites_socios_legales["colonia_particular"]      = "";
            $t_tramites_socios_legales["referencias_particular"]  = "";

            $t_tramites_socios_legales = (object) $t_tramites_socios_legales;
        }
        $t_tramites_socios_legales = $t_tramites_socios_legales;

        return response()->json($t_tramites_socios_legales);
    }

    public function store_socios_legales(\App\Http\Requests\Backend\T_Tramite_Legal_Socio_Legal $request)
    {
        $arr_validacion = [];
        $validation     = new Validations;
        $status         = 1;
        $code           = 201;
        $post           = $request->all();

        isset($post['dlscs_id']) ? $id = $post['dlscs_id'] : $id = 0; //id

        //Datos personales
        $p_personal['nombre']                 = $post['dlscs_nombre'];
        $p_personal['ap_paterno']             = $post['dlscs_ap_paterno'];
        $p_personal['ap_materno']             = $post['dlscs_ap_materno'];
        $p_personal['curp']                   = $post['dlscs_curp'];
        $p_personal['rfc']                    = $post['dlscs_rfc'];
        $p_personal['id_nacionalidad']        = $post['dlscs_id_nacionalidad'];
        $p_personal['sexo']                   = $post['dlscs_sexo'];
        $p_personal['telefono']               = $post['dlscs_telefono'];
        $p_personal['correo_electronico']     = $post['dlscs_correo_electronico'];
        $p_personal['id_tipo_identificacion'] = $post['dlscs_id_tipo_identificacion'];
        $p_personal['numero_identificacion']  = $post['dlscs_numero_identificacion'];
        $nombre_completo                      = $p_personal['nombre'] . " " . $p_personal['ap_paterno'] . " " . $p_personal['ap_materno'];

        //Datos para D_Domicilio particular
        $p_domicilio_particular['id_tipo_domicilio'] = 1;
        $p_domicilio_particular['id_municipio']      = $post['dlscs_id_municipio_particular'];
        $p_domicilio_particular['ciudad']            = $post['dlscs_ciudad_particular'];
        $p_domicilio_particular['codigo_postal']     = $post['dlscs_cp_particular'];
        $p_domicilio_particular['calle']             = $post['dlscs_calle_particular'];
        $p_domicilio_particular['num_exterior']      = $post['dlscs_ext_particular'];
        $p_domicilio_particular['num_interior']      = $post['dlscs_int_particular'];
        $p_domicilio_particular['colonia']           = $post['dlscs_colonia_particular'];
        $p_domicilio_particular['referencias']       = $post['dlscs_referencias_particular'];

        //Datos socio legal
        $p_socio_legal['id_registro_temp'] = Auth::user()->id_registro;
        $p_socio_legal['id_tramite']       = 0;

        $validation->socioLegalNuevo(['id' => $id, 'id_registro_temp' => $p_socio_legal['id_registro_temp'], 'nombre_completo' => $nombre_completo]);
        if (!$validation->getStatusB()) {
            try {
                DB::beginTransaction();
                if ($id == 0) {
                    $t_socio_legal          = new T_Tramite_Socio_Legal;
                    $d_personal             = new D_Personal;
                    $d_domicilio_particular = new D_Domicilio;
                } else {
                    $t_socio_legal          = T_Tramite_Socio_Legal::find($id);
                    $d_personal             = D_Personal::find($t_socio_legal->id_d_personal);
                    $d_domicilio_particular = D_Domicilio::find($d_personal->id_d_domicilio);
                }
                //Domicilio particular
                $d_domicilio_particular->fill($p_domicilio_particular)->save();
                $p_personal['id_d_domicilio'] = $d_domicilio_particular->id;
                //Datos personales
                $d_personal->fill($p_personal)->save();
                $p_socio_legal['id_d_personal'] = $d_personal->id;

                //Representante legal
                $t_socio_legal->fill($p_socio_legal)->save();
                DB::commit();

                if ($id == 0) {
                    $msg            = "El socio legal ha sido registrado";
                    $route_redirect = "";
                } else {
                    $msg            = "El  socio legal ha sido actualizado";
                    $route_redirect = "";
                }
                $data = $t_socio_legal;
            } catch (\Exception $e) {
                $status         = 3;
                $code           = 409;
                $msg            = $e->getMessage();
                $route_redirect = "";
                $data           = [];
                DB::rollback();
            }
        } else {
            $status         = 3;
            $code           = $validation->getStatusCode();
            $msg            = $validation->getStatusMsg();
            $route_redirect = "";
            $data           = [];
        }
        return response()->json(['status' => $status, 'code' => $code, 'msg' => $msg, 'route_redirect' => $route_redirect, 'data' => $data], $code);
    }

    public function store_contacto(ContactoRequest $request)
    {
        $status = 1;
        $code   = 201;
        $post   = $request->all();

        $id_contacto = $post['hdIdContacto'];
        $contacto['id_registro_temp'] = $post['hdIdRegistro'];
        $contacto['nombre']           = $post['nombre_contacto'];
        $contacto['ap_paterno']       = $post['ap_paterno_contacto'];
        $contacto['ap_materno']       = $post['ap_materno_contacto'];
        $contacto['cargo']            = $post['cargo_contacto'];
        $contacto['telefono']         = $post['telefono_contacto'];

        if ($id_contacto == 0) {
            $t_contacto = new T_Contacto;

            //genero un random
            $vkeyrandom   = '';
            $vlength_vkey = 10;
            $vchar_random = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $vmax_letter  = strlen($vchar_random) - 1;
            for ($i = 0; $i < $vlength_vkey; $i++) {
                $vkeyrandom .= substr($vchar_random, rand(0, $vmax_letter), 1);
            }
            $contacto['clave_atencion'] = $vkeyrandom;
        } else {
            $t_contacto = T_Contacto::find($id_contacto);
        }

        try {
            DB::beginTransaction();
            $t_contacto->fill($contacto)->save();
            DB::commit();
            if ($id_contacto == 0) {
                $msg = "El contacto ha sido registrado";
            } else {
                $msg = "El contacto ha sido actualizado";
            }

            $route_redirect = $this->route . '.nuevo.tramite';
            $data           = $t_contacto;
        } catch (\Exception $e) {
            $status         = 3;
            $code           = 409;
            $msg            = $e->getMessage();
            $route_redirect = "";
            $data           = [];
            DB::rollback();
        }

        return response()->json(['status' => $status, 'code' => $code, 'msg' => $msg, 'route_redirect' => $route_redirect, 'data' => $data], $code);
    }

    public function getContacto()
    {
        $vstatus    = 200;
        $vrespuesta = array();
        try {
            $vfiltro                     = array();
            $vfiltro['id_registro_temp'] = Auth::user()->id_registro;

            $vrespuesta['contacto'] = T_Contacto::busca_contacto($vfiltro)->first();
        } catch (Exception $vexception) {
            $vstatus               = 500;
            $vrespuesta['message'] = $vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
    }

    public function getContactoTramite($id_tramite)
    {
        $vstatus    = 200;
        $vrespuesta = array();
        try {
            $vfiltro               = array();
            $vfiltro['id_tramite'] = $id_tramite;

            $vrespuesta['contacto'] = T_Contacto::busca_contacto($vfiltro)->first();
        } catch (Exception $vexception) {
            $vstatus               = 500;
            $vrespuesta['message'] = $vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
    }

    public function storeCondiciones()
    {
        $status                  = 1;
        $code                    = 201;
        $t_registro              = T_Registro::find(Auth::User()->id_registro);
        $post_r['terminos_temp'] = 1;
        try {
            DB::beginTransaction();
            $t_registro->fill($post_r)->save();
            DB::commit();
            $msg            = "Has aceptado los terminos y condiciones ahora puedes continuar con el tramite.";
            $route_redirect = $this->route . '.nuevo.tramite';
            $data           = $t_registro;
        } catch (\Exception $e) {
            $status         = 3;
            $code           = 409;
            $msg            = $e->getMessage();
            $route_redirect = "";
            $data           = [];
            DB::rollback();
        }

        return response()->json(['status' => $status, 'code' => $code, 'msg' => $msg, 'route_redirect' => $route_redirect, 'data' => $data], $code);
    }

}
