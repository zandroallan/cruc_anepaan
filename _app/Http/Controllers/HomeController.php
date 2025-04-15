<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Models\Catalogos\N_Usuario;
use App\Http\Models\Backend\T_Tramite_Entrega;
use App\Http\Models\Backend\T_Tramite_Cancelado;
use App\Http\Models\Backend\T_Tramite;
use App\Http\Models\Backend\T_Execute_Cron;
use App\Http\Models\Catalogos\C_Especialidad;
use App\Http\Models\Backend\T_Tramite_Rep_Tecnico;
use App\Http\Models\Catalogos\C_Inhabiles;
use App\Http\Classes\CorreoPlantillas;
use App\Http\Classes\Correo;
use App\Http\Controllers\ImpresionController;
use Auth;
use DB; 


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
     {
        // $this->middleware('auth');
     }

    public function diasHabiles()
     {
        $vstatus=200;
        $vrespuesta=array();
        $vrespuesta=['codigo' => 1, 'mensaje' => 'Exito'];
        try {

            $finDeSemana = false;
            setlocale ( LC_TIME, 'spanish' );
            $diaDeLaSemana = strftime("%A");
            $diaActual     = date("w", strtotime(date('Y-m-d')));
            if ( 
                $diaDeLaSemana == "sábado"      || 
                $diaDeLaSemana == "sabado"      || 
                $diaDeLaSemana == "domingo"     || 
                $diaDeLaSemana == "Saturday"    || 
                $diaDeLaSemana == "Sunday"      ||
                $diaDeLaSemana == "saturday"    || 
                $diaDeLaSemana == "sunday"
            )   $finDeSemana = true;

            // $_foliosPorExpirar=N_Usuario::notificacionPorExpirarCron()->get();
            // if(!empty( $datosNotificacion )) {
            //     foreach ($datosNotificacion as $key => $datos) {
            //         $vrespuesta['folios_por_expirar_'. $_vi]='Folio: '. $datos->folio.', Fecha limite expiración: '.$datos->fecha_limite;
            //         ++$_vi;
            //     }
            // }

            // $vfldiasInhabiles=C_Inhabiles::diasInhabiles();
            // $_foliosExpirados=N_Usuario::notificacionesExpiradasCron()->get();            
            // if(!empty( $_foliosExpirados )) {
            //     $_vi=1;
            //     foreach ($_foliosExpirados as $key => $datos) {
            //         $vrespuesta['folios_expirados_'. $_vi]=$datos;
            //         // $vrespuesta['folios_expirados_'. $_vi]='Folio: '. $datos->folio.', Fecha expiración: '.$datos->fecha_limite;
            //         ++$_vi;
            //     }
            // }

            // $_foliosSinAcusar=N_Usuario::notificacionSinAcusarCron()->get();        
            // if ( !empty($_foliosSinAcusar) ) {
            //     $_vi=1;
            //     foreach ($_foliosSinAcusar as $key => $datos) {
            //         $vrespuesta['folios_sin_acusar_'. $_vi]='Folio: '. $datos->folio.', Fecha limite expiración: '.$datos->fecha_limite;
            //         ++$_vi;
            //     }
            // }
            
            // $vrespuesta['inhabil']=$vfldiasInhabiles;
            // $vrespuesta['dia']=$diaDeLaSemana;
            $vrespuesta['dia_num']=$diaActual;
            // $vrespuesta['dia_status']=$finDeSemana;

        }
        catch( Exception $vexception ) {
            $vrespuesta=['codigo' => -1, 'mensaje' => $vexception->getMessage()];
            $vstatus=500;
        }
        return response()->json($vrespuesta, $vstatus);
     }

    public function padron( $anio )
     {
        $vstatus=200;
        $vrespuesta=array();
        $vrespuesta=['codigo' => 0, 'mensaje' => 'Sin registros'];
        try {
            $vrespuesta['padron']=T_Tramite::consulta_portal(['anio'=>$anio])->get();
        }
        catch( Exception $vexception ) {
            DB::rollback();
            $vstatus=500;
            $vrespuesta=['codigo' => -1, 'mensaje' => $vexception->getMessage()];
        }
        return response()->json($vrespuesta, $vstatus);
     }

    public function detalleContratistaPadron( $id_tramite )
     {
        $vstatus=200;
        $vrespuesta=array();
        $vrespuesta=['codigo' => 0, 'mensaje' => 'Sin registros'];
        try {
            $datosTramite=T_Tramite::consulta_portal(['id_tramite'=>$id_tramite])->first();
            
            $arrayEspContratista=array();
            $jsonEsp_Contratista=json_decode($datosTramite->esp_contratista);
            foreach ($jsonEsp_Contratista as $key => $value) {
                // code...
                $datosEspecialidad=C_Especialidad::findOrFail($value);
                array_push($arrayEspContratista, $datosEspecialidad);
                unset($datosEspecialidad);
            }

            $arrayEspRTEC=array();
            $datosRepTecnicos=T_Tramite_Rep_Tecnico::getRepresentantesTecnico(['id_tramite'=>$id_tramite])->get();
            foreach ($datosRepTecnicos as $key => $value) {
                // code...
                $arrayEsp=array();
                $jsonEsp_RTEC=json_decode($value->especialidades);
                foreach ($jsonEsp_RTEC as $key_ii => $value_ii) {
                    // code...
                    $datosEspecialidad=C_Especialidad::findOrFail($value_ii);
                    array_push($arrayEsp, $datosEspecialidad);
                    unset($datosEspecialidad);
                }

                $arrayEspRTECForeach=array();
                $arrayEspRTECForeach['rtec']=$value;
                $arrayEspRTECForeach['especialidades']=$arrayEsp;
                array_push($arrayEspRTEC, $arrayEspRTECForeach);
                unset($arrayEspRTECForeach);
            }
            
            $vrespuesta['detalle']=$datosTramite;
            $vrespuesta['esp_contratista']=$arrayEspContratista;
            $vrespuesta['esp_rtec']=$arrayEspRTEC;
        }
        catch( Exception $vexception ) {
            DB::rollback();
            $vstatus=500;
            $vrespuesta=['codigo' => -1, 'mensaje' => $vexception->getMessage()];
        }
        return response()->json($vrespuesta, $vstatus);
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
     {
        return redirect()->route('mis-tramites.index');
     }

    public function notificaciones_forzadas()
     {
        $id_registro= Auth::User()->id_registro;
        $notificaciones_forzadas= \App\Http\Models\Catalogos\N_Usuario::general(['id_registro'=> $id_registro, 'id_tipo_notificacion'=>2, 'acepto_condiciones'=>null])->get();
        return view('notificaciones-observaciones', ['notificaciones_forzadas'=>$notificaciones_forzadas]);
     }

    public function notificacionFolioRepetido()
     {
        # Sandro Alan Gomez Aceituno
        # Codigo para notificar citas en el sistema.

        $arrayIDsTramite=array();

        
        $vstatus=200;
        $vrespuesta=array();
        $vrespuesta=['codigo' => 1, 'mensaje' => 'Exito'];
        try {
            foreach ($arrayIDsTramite as $key => $datos) {
                
                $datosTramite=T_Tramite::datos_buscador(['id_tramite'=> $datos])->first();
                # Code notificación citas Email...
       
                $vdatos=[];
                $vdatos['name']= $datosTramite->razon_social;
                $vdatos['folio']= $datosTramite->folio;
                $vdatos['fecha_inicio']= $datosTramite->fecha_inicio;
                $vdatos['tipo_tramite']= $datosTramite->tipo_tramite;


                $datos_correo = array();
                $datos_correo['asunto'] = 'Portal del contratista SHYFP: Reasignación de folio';
                $datos_correo['cuerpo'] = CorreoPlantillas::reasignacion_folio($vdatos);
                $datos_correo['correo_destinatario'] = [$datosTramite->email];
                // $datos_correo['correo_destinatario'] = ['zandroallan@gmail.com'];
                $datos_correo['nombre_destinatario'] = $datosTramite->razon_social;
                $impresion_controller = new ImpresionController();
                $attachment = $impresion_controller->constancia_documentacion($datosTramite->id, 'S');
                $vstatusCorreo = Correo::sendEmail($datos_correo, 1, $attachment);
                

                // DB::commit();
            }
        }
        catch( Exception $vexception ) {
            // DB::rollback();
            $vstatus=500;
            $vrespuesta=['codigo' => -1, 'mensaje' => $vexception->getMessage()];
        }
        return response()->json($vrespuesta, $vstatus);
     }

    public function notificacionCitas()
     {
        # Sandro Alan Gomez Aceituno
        # Codigo para notificar citas en el sistema.

        $vstatus=200;
        $vrespuesta=array();
        $vrespuesta=['codigo' => 1, 'mensaje' => 'Exito'];
        try {
            $datosTramiteEntrega=T_Tramite::tramitesCitas()->get();
            if(!empty( $datosTramiteEntrega )) {
                foreach ($datosTramiteEntrega as $key => $datos) {
                    # Code notificación citas Email...


                    //Enviar correo electrónico                
                    $vdatos=array();
                    $vdatos['name']= $datos->razon_social_o_nombre;
                    $vdatos['folio']= $datos->folio;
                    $vdatos['fecha_cita']= $datos->fecha_cita;
                    $vdatos['hora_cita']= $datos->horario_texto;

                    $id_tipo_tramite= $datos->id_tipo_tramite;
                    if($id_tipo_tramite==1) $tipo_tramite= "Inscripción"; 
                    if($id_tipo_tramite==2) $tipo_tramite= "Actualización"; 
                    if($id_tipo_tramite==3) $tipo_tramite= "Modificación"; 

                    $vdatos['tipo_tramite']= $tipo_tramite;

                    $datos_correo=array();
                    $datos_correo['asunto']= 'Contratista/Supervisor SHYFP: Cita para entrega de certificado';
                    $datos_correo['cuerpo']= CorreoPlantillas::tramite_finalizado($vdatos);
                    $datos_correo['correo_destinatario']=[$datos->email];
                    $datos_correo['nombre_destinatario']= $vdatos['name'];
                    $vstatusCorreo= Correo::sendEmail($datos_correo, 1);

                    $mensajeEnvioCorreo='Se notifico por correo electronico al folio '. $datos->folio;
                    $vrespuesta['MAIL-' . $datos->id_tramite ]=$mensajeEnvioCorreo;
                    $vrespuesta['NTF-'. $datos->id_tramite ]=$datos->id_registro .'Folio: '. $datos->folio .' Notificado.';
                    unset($vdatos);

                    /*

                    # Begin: Envio de Correo Electrónico.
                    $datosEnviarCorreo=array();
                    $datosEnviarCorreo['asunto']= 'Notificación del SIRCSE '. $datos->folio;
                    $datosEnviarCorreo['cuerpo']= CorreoPlantillas::notificacionEntrega($datos);
                    $datosEnviarCorreo['correo_destinatario']=$datos->email;
                    $datosEnviarCorreo['nombre_destinatario']=$datos->razon_social_o_nombre;
                    
                    $vstatusCorreo=0;
                    $vstatusCorreo=Correo::sendEmail($datosEnviarCorreo, 0, null);
                    $mensajeEnvioCorreo='No se pudo notificar por correo al folio '. $datos->folio;
                    if( $vstatusCorreo == 1 ) {
                        $mensajeEnvioCorreo='Se notifico por correo electronico al folio '. $datos->folio;

                        $vflTramiteEntrega=T_Tramite_Entrega::findOrFail($datos->id);
                        $vflTramiteEntrega->fill(['enviado'=>1])->save();
                        unset($vflTramiteEntrega);
                    }
                    unset($datosEnviarCorreo, $vdatosN_Usuario);
                    # End: Envio de Correo Electrónico. 
                    
                    */
                    // DB::commit();
                }
            }
        }
        catch( Exception $vexception ) {
            // DB::rollback();
            $vstatus=500;
            $vrespuesta=['codigo' => -1, 'mensaje' => $vexception->getMessage()];
        }
        return response()->json($vrespuesta, $vstatus);
     }

    public function notificacionEntrega()
     {
        # Sandro Alan Gomez Aceituno
        # Codigo para notificar las entregas de certificados.
        $vstatus=200;
        $vrespuesta=array();
        $vrespuesta=['codigo' => 1, 'mensaje' => 'Exito'];
        try {
            $datosTramiteEntrega=T_Tramite_Entrega::tramitesEntregas()->get();
            if(!empty( $datosTramiteEntrega )) {
                foreach ($datosTramiteEntrega as $key => $datos) {
                    # code Notificación...
                    # Begin: Registro de información en la tabla n_usuarios.


                    $txtNtfEntrega ='';
                    $txtNtfEntrega.=' <p class="text-right">Asunto: Notificación del SIRCSE.<br />';
                    $txtNtfEntrega.=  $datos->razon_social_o_nombre .'<br />';
                    $txtNtfEntrega.=  $datos->folio .'</p>';

                    $txtNtfEntrega.=' <p class="text-justify">Sistema de Registro de Contratistas y Supervisores Externos';
                    $txtNtfEntrega.=' Usted tiene una cita, el día <b>'. $datos->fecha .'</b> a las <b>'. $datos->hora .'</b>, en la';
                    $txtNtfEntrega.=' Mesa <b>'. $datos->mesa .'</b>. En las oficinas de la Secretaría de la Honestidad y';
                    $txtNtfEntrega.=' Función Pública, ubicadas en: Boulevard Los Castillos #410, planta baja,';
                    $txtNtfEntrega.=' Fraccionamiento Montes Azules.</p>';

                    $txtNtfEntrega.=' <p class="text-justify">Para la expedición y obtención de su Constancia por Actualización de';
                    $txtNtfEntrega.=' Registro de Contratistas 2020 (prorrogada 2019). Con el fin de agilizar';
                    $txtNtfEntrega.=' su trámite, deberá presentarse personalmente*, con los siguientes';
                    $txtNtfEntrega.=' requisitos:</p>';

                    $txtNtfEntrega.=' <p class="text-justify">1. Original y copia de Identificación Oficial INE o IFE, Cedula Profesional y/o Pasaporte.<br />';
                    $txtNtfEntrega.=' 2. Copia del Certificado de Registro de Contratistas 2019.<br />';
                    $txtNtfEntrega.=' 3. Impresión del presente documento.<br />';
                    $txtNtfEntrega.=' 4. Impresión de la Boleta de Pago de Derechos, de la Secretaría de Hacienda.</p>';

                    $txtNtfEntrega.=' <p class="text-justify"><b>*En los casos de personas morales, en que exista cambio de';
                    $txtNtfEntrega.=' Administrador único o Representante legal, el interesado deberá';
                    $txtNtfEntrega.=' presentar original del instrumento público notarial, donde se';
                    $txtNtfEntrega.=' acredite la personalidad jurídica del solicitante.</b></p>';

                    $txtNtfEntrega.=' <p class="text-justify">Como medida de seguridad sanitaria, para evitar aglomeración de';
                    $txtNtfEntrega.=' personas, se recomienda su puntualidad, no antes ni después del';
                    $txtNtfEntrega.=' horario indicado.</p>';

                    $txtNtfEntrega.=' <p class="text-justify">Se pone a su disposición para dudas el teléfono 01(961) 61 8 75 30, Extensiones:</p>';

                    $txtNtfEntrega.=' <p class="text-justify">22232.- Área Técnica <br />';
                    $txtNtfEntrega.=' 22351.- Área Financiera <br />';
                    $txtNtfEntrega.=' 22022.- Área Legal</p>';

                    $txtNtfEntrega.=' <p class="text-justify"> Coordinación de Verificación de la Supervisión Externa de la Obra';
                    $txtNtfEntrega.=' Pública Estatal, de la Secretaría de la Honestidad y Función Pública.</p>';
                    
                    /*
                    $textoDescripcion ='';
                    $textoDescripcion.=' Le notificamos que su trámite de <b>Inscripción</b> con el folio <b>'. $datos->folio .'</b>';
                    $textoDescripcion.=' presenta observaciones, las cuales podrá solventar a tráves de su portal. Le recordamos que tiene';
                    $textoDescripcion.=' término de <b>'. $datos->diasPendiente .' días hábiles</b> para solventar dichas observaciones.';
                    */
                
                    $vdatosN_Usuario=array();
                    $vdatosN_Usuario["id_c_notificacion"]=1;
                    $vdatosN_Usuario["id_tipo_notificacion"]=2;
                    $vdatosN_Usuario["id_tramite"]=$datos->id_tramite;
                    $vdatosN_Usuario["descripcion"]=$txtNtfEntrega;
                    $vdatosN_Usuario["visto"]=0;

                    // DB::beginTransaction();
                    $vflN_Usuario= new N_Usuario;
                    $vflN_Usuario->fill($vdatosN_Usuario)->save();
                    # End: Registro de informacion -> n_usuarios.

                    
                    # code Email
                    # Begin: Envio de Correo Electrónico.
                    $datosEnviarCorreo=array();
                    $datosEnviarCorreo['asunto']= 'Notificación del SIRCSE '. $datos->folio;
                    $datosEnviarCorreo['cuerpo']= CorreoPlantillas::notificacionEntrega($datos);
                    $datosEnviarCorreo['correo_destinatario']=$datos->email;
                    $datosEnviarCorreo['nombre_destinatario']=$datos->razon_social_o_nombre;
                    
                    $vstatusCorreo=0;
                    $vstatusCorreo=Correo::sendEmail($datosEnviarCorreo, 0, null);
                    $mensajeEnvioCorreo='No se pudo notificar por correo al folio '. $datos->folio;
                    if( $vstatusCorreo == 1 ) {
                        $mensajeEnvioCorreo='Se notifico por correo electronico al folio '. $datos->folio;

                        $vflTramiteEntrega=T_Tramite_Entrega::findOrFail($datos->id);
                        $vflTramiteEntrega->fill(['enviado'=>1])->save();
                        unset($vflTramiteEntrega);
                    }
                    unset($datosEnviarCorreo, $vflN_Usuario, $vdatosN_Usuario);
                    # End: Envio de Correo Electrónico. 
                    

                    $vrespuesta['MAIL-' . $datos->id_tramite ]=$mensajeEnvioCorreo;
                    $vrespuesta['NTF-'. $datos->id_tramite ]=$datos->id_registro .'Folio: '. $datos->folio .' Notificado.';
                    // DB::commit();
                }
            }
        }
        catch( Exception $vexception ) {
            // DB::rollback();
            $vstatus=500;
            $vrespuesta=['codigo' => -1, 'mensaje' => $vexception->getMessage()];
        }
        return response()->json($vrespuesta, $vstatus);
     }

    public function notificacionesSinAcusarCron()
     {
        /**
         * Sandro Alan Gómez Aceituno
         * Descripcion, copia exacta para la funcion del Cron que notifica los tramites cancelados
         * El Cron se encuentra en App\Console\Commands
         * */

        $vstatus=200;
        $vrespuesta=array();
        $vrespuesta=['codigo' => 1, 'mensaje' => 'Exito'];
        try {
            $datosNotificacion=N_Usuario::notificacionSinAcusarCron()->get();
            $vrespuesta['notificacion']=$datosNotificacion;
            
            if(!empty( $datosNotificacion )) {
                foreach ($datosNotificacion as $key => $datos) {
                    # Code Notificación...
                    # Begin: Registro de información en la tabla n_usuarios.
                    
                    if( $datos->id_tipo_tramite == 1 ) $tipoTramite= "Inscripción"; 
                    if( $datos->id_tipo_tramite == 2 ) $tipoTramite= "Actualización"; 
                    if( $datos->id_tipo_tramite == 3 ) $tipoTramite= "Modificación";
                    
                    $txtMotivo ='';
                    $txtMotivo.=' <p style="text-align:justify">Le notificamos que su trámite de <b>'. $tipoTramite .'</b> con el folio <b>'. $datos->folio .'</b> presentaba observaciones y no se solventarón.<br /><br />';
                    $txtMotivo.=' <b>Aviso:</b> El plazo para solventar las observaciones vencio el '. $datos->fecha_limite .', por tal motivo al no solventar se le notifica que su tramite ha sido <b>CANCELADO</b>.</p>';
                
                    DB::beginTransaction();

                    $vflTramite=T_Tramite::findOrFail($datos->id_tramite);
                    $vflTramite->fill(['id_status' => 3])->save();

                    $vflTramiteCancelado=new T_Tramite_Cancelado;
                    $vflTramiteCancelado->fill([
                        'id_tramite'=>$datos->id_tramite,
                        'id_area'=>0,
                        'id_autorizo'=>0,
                        'id_usuario_solicito'=>0,
                        'motivo'=>$txtMotivo
                    ])->save();

                    $vflN_Usuario= new N_Usuario;
                    $vflN_Usuario->fill([
                        "id_c_notificacion"=>4,
                        "id_tipo_notificacion"=>2,
                        "id_tramite"=>$datos->id_tramite,
                        "descripcion"=>$txtMotivo,
                        "visto"=>0
                    ])->save();      
                    
                    $datosPDF=[];
                    $datosPDF['tipo_tramite']=$tipoTramite;
                    $datosPDF['razon_social_o_nombre']=$datos->razon_social_o_nombre;
                    $datosPDF['folio']=$datos->folio;
                    $datosPDF['motivo']=$txtMotivo;

                    $datosEnviarCorreo=[];
                    $datosEnviarCorreo['asunto']='Notificación del Sistema SIRCSE';
                    $datosEnviarCorreo['cuerpo']= CorreoPlantillas::tramite_rechazado($datosPDF, $tipoTramite);
                    $datosEnviarCorreo['correo_destinatario']=$datos->email;
                    $datosEnviarCorreo['nombre_destinatario']=$datos->razon_social_o_nombre;  
                    
                    $vstatusCorreo=Correo::sendEmail($datosEnviarCorreo, 0, null);
                    $mensajeEnvioCorreo='No se pudo notificar por correo al folio '. $datos->folio;
                    if( $vstatusCorreo == 1 ) {
                        $mensajeEnvioCorreo='Se notifico por correo electronico al folio '. $datos->folio;
                    }
                    $vrespuesta['correo-' . $key ]=$mensajeEnvioCorreo;
                    unset($datosEnviarCorreo, $vflN_Usuario);                    
                    DB::commit();
                }
            }
            $vflExecuteCron= new T_Execute_Cron;
            $vflExecuteCron->fill(["cron"=> 'Ejecución de cron '. date('Y-m-d H:i:s') .' solventaciones que no se han acusado. '])->save();
        }
        catch( Exception $vexception ) {
            DB::rollback();
            $vstatus=500;
            $vrespuesta=['codigo' => -1, 'mensaje' => $vexception->getMessage()];
        }
        return response()->json($vrespuesta, $vstatus);
     }
	
	public function notificacionesPorExpirarCron()
     {
        /**
         * Sandro Alan Gómez Aceituno
         * Copia exacta para la funcion del Cron que notifica los tramites cancelados
         * El Cron se encuentra en App\Console\Commands
         * */

        $vstatus=200;
        $vrespuesta=array();
        $vrespuesta=['codigo' => 1, 'mensaje' => 'Exito'];
        try {
            $datosNotificacion=N_Usuario::notificacionPorExpirarCron()->get();
            $vrespuesta['notificacion']=$datosNotificacion;
            
            if(!empty( $datosNotificacion )) {
                foreach ($datosNotificacion as $key => $datos) {
                    # code Notificación...
                    # Begin: Registro de información en la tabla n_usuarios.
                    
                    if( $datos->id_tipo_tramite == 1 ) $tipoTramite= "Inscripción"; 
                    if( $datos->id_tipo_tramite == 2 ) $tipoTramite= "Actualización"; 
                    if( $datos->id_tipo_tramite == 3 ) $tipoTramite= "Modificación";
                    
                    $textoDescripcion ='';
                    $textoDescripcion.=' Le notificamos que su trámite de <b>'. $tipoTramite .'</b> con el folio <b>'. $datos->folio .'</b> presenta observaciones.<br /><br />';
                    $textoDescripcion.=' <b>Aviso:</b> El plazo para solventar las observaciones vence el '. $datos->fecha_limite .', en caso de no cumplirse con este, se cerrará el tramite.';
                
                    $vdatosN_Usuario=array();
                    $vdatosN_Usuario["id_c_notificacion"]=4;
                    $vdatosN_Usuario["id_tipo_notificacion"]=2;
                    $vdatosN_Usuario["id_tramite"]=$datos->id_tramite;
                    $vdatosN_Usuario["descripcion"]=$textoDescripcion;
                    $vdatosN_Usuario["visto"]=0;

                    DB::beginTransaction();
                    $vflN_Usuario= new N_Usuario;
                    $vflN_Usuario->fill($vdatosN_Usuario)->save();
                    $vrespuesta['notificacion -' . $key ]='Folio '. $datos->folio .' Notificado.';
                    # End: Registro de informacion -> n_usuarios.


                    # code Email
                    # Begin: Envio de Correo Electrónico.
                                 
                    $datosEnviarCorreo=array();
                    $datosEnviarCorreo['asunto']= 'Portal del contratista SHYFP: Recordatorio Folio '. $datos->folio;
                    $datosEnviarCorreo['cuerpo']= CorreoPlantillas::notificacionCron($datos, $tipoTramite);
                    $datosEnviarCorreo['correo_destinatario']=$datos->email; //[$p_registro['email']];
                    $datosEnviarCorreo['nombre_destinatario']=$datos->razon_social_o_nombre;  
                    
                    $vstatusCorreo=Correo::sendEmail($datosEnviarCorreo, 0, null);
                    $mensajeEnvioCorreo='No se pudo notificar por correo al folio '. $datos->folio;
                    if( $vstatusCorreo == 1 ) {
                        $mensajeEnvioCorreo='Se notifico por correo electronico al folio '. $datos->folio;
                    }
                    $vrespuesta['correo-' . $key ]=$mensajeEnvioCorreo;
                    unset($datosEnviarCorreo, $vflN_Usuario, $vdatosN_Usuario);
                    DB::commit();
                }
            }
            $vflExecuteCron= new T_Execute_Cron;
            $vflExecuteCron->fill(["cron"=> 'Ejecución de cron '. date('Y-m-d H:i:s') .' solventaciones por expirar. '])->save();
        }
        catch( Exception $vexception ) {
            DB::rollback();
            $vstatus=500;
            $vrespuesta=['codigo' => -1, 'mensaje' => $vexception->getMessage()];
        }
        return response()->json($vrespuesta, $vstatus);
     }  

    public function notificacionesExpiradasCron()
     {
        /**
         * Sandro Alan Gómez Aceituno
         * Copia exacta para la funcion del Cron que notifica los tramites cancelados
         * El Cron se encuentra en App\Console\Commands
         * */

        $vstatus=200;
        $vrespuesta=array();
        $vrespuesta=['codigo' => 1, 'mensaje' => 'Exito'];
        try {
            $datosNotificacion=N_Usuario::notificacionesExpiradasCron()->get();
            $vrespuesta['notificacion']=$datosNotificacion;
            
            if(!empty( $datosNotificacion )) {
                foreach ($datosNotificacion as $key => $datos) {
                    # Code Notificación...
                    # Begin: Registro de información en la tabla n_usuarios.
                    
                    if( $datos->id_tipo_tramite == 1 ) $tipoTramite= "Inscripción"; 
                    if( $datos->id_tipo_tramite == 2 ) $tipoTramite= "Actualización"; 
                    if( $datos->id_tipo_tramite == 3 ) $tipoTramite= "Modificación";
                    
                    $txtMotivo ='';
                    $txtMotivo.=' <p style="text-align:justify">Le notificamos que su trámite de <b>'. $tipoTramite .'</b> con el folio <b>'. $datos->folio .'</b> presentaba observaciones y no se solventarón.<br /><br />';
                    $txtMotivo.=' <b>Aviso:</b> El plazo para solventar las observaciones vencio el '. $datos->fecha_limite .', por tal motivo al no solventar se le notifica que su tramite ha sido <b>CANCELADO</b>.</p>';
                
                    DB::beginTransaction();

                    $vflTramite=T_Tramite::findOrFail($datos->id_tramite);
                    $vflTramite->fill(['id_status' => 3])->save();

                    $vflTramiteCancelado=new T_Tramite_Cancelado;
                    $vflTramiteCancelado->fill([
                        'id_tramite'=>$datos->id_tramite,
                        'id_area'=>0,
                        'id_autorizo'=>0,
                        'id_usuario_solicito'=>0,
                        'motivo'=>$txtMotivo
                    ])->save();

                    $vflN_Usuario= new N_Usuario;
                    $vflN_Usuario->fill([
                        "id_c_notificacion"=>4,
                        "id_tipo_notificacion"=>2,
                        "id_tramite"=>$datos->id_tramite,
                        "descripcion"=>$txtMotivo,
                        "visto"=>0
                    ])->save();      
                    
                    $datosPDF=[];
                    $datosPDF['tipo_tramite']=$tipoTramite;
                    $datosPDF['razon_social_o_nombre']=$datos->razon_social_o_nombre;
                    $datosPDF['folio']=$datos->folio;
                    $datosPDF['motivo']=$txtMotivo;

                    $datosEnviarCorreo=[];
                    $datosEnviarCorreo['asunto']='Notificación del Sistema SIRCSE';
                    $datosEnviarCorreo['cuerpo']= CorreoPlantillas::tramite_rechazado($datosPDF, $tipoTramite);
                    $datosEnviarCorreo['correo_destinatario']=$datos->email;
                    $datosEnviarCorreo['nombre_destinatario']=$datos->razon_social_o_nombre;  
                    
                    $vstatusCorreo=Correo::sendEmail($datosEnviarCorreo, 0, null);
                    $mensajeEnvioCorreo='No se pudo notificar por correo al folio '. $datos->folio;
                    if( $vstatusCorreo == 1 ) {
                        $mensajeEnvioCorreo='Se notifico por correo electronico al folio '. $datos->folio;
                    }
                    $vrespuesta['correo-' . $key ]=$mensajeEnvioCorreo;
                    unset($datosEnviarCorreo, $vflN_Usuario);
                    // $vrespuesta['notificacion -' . $key ]='Folio '. $datos->folio .' Notificado.';
                    DB::commit();
                }
            }
            $vflExecuteCron= new T_Execute_Cron;
            $vflExecuteCron->fill(["cron"=> 'Ejecución de cron '. date('Y-m-d H:i:s') .' solventaciones no realizadas en tiempo '])->save();
        }
        catch( Exception $vexception ) {
            DB::rollback();
            $vstatus=500;
            $vrespuesta=['codigo' => -1, 'mensaje' => $vexception->getMessage()];
        }
        return response()->json($vrespuesta, $vstatus);
     }
}
