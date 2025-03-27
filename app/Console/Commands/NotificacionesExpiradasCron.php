<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Models\Catalogos\N_Usuario;
use App\Http\Models\Backend\T_Tramite_Cancelado;
use App\Http\Models\Backend\T_Tramite;
use App\Http\Models\Backend\T_Execute_Cron;
use App\Http\Models\Catalogos\C_Inhabiles;
use App\Http\Classes\CorreoPlantillas;
use App\Http\Classes\Correo;
use DB; 

class NotificacionesExpiradasCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expiradas:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de notificaciones de cancelado a los tramites que expiraron la fecha limite';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
     {
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

                    $vflTramite=T_Tramite::find($datos->id_tramite);
                    $vflTramite->fill(['id_status' => 3])->save();

                    $vflTramiteCancelado=new T_Tramite_Cancelado;
                    $vflTramiteCancelado->fill([
                        'id_tramite'=>$datos->id_tramite,
                        'id_area'=>0,
                        'id_autorizo'=>0,
                        'id_usuario_solicito'=>0,
                        'motivo'=>$txtMotivo
                    ])->save();

                    $vnotificado=0;
                    $vdiaActual=date("w", strtotime(date('Y-m-d')));
                    $vfldiasInhabiles=C_Inhabiles::diasInhabiles();
                    if ( !empty($vfldiasInhabiles) || ($vdiaActual == 0) || ($vdiaActual == 6)) {
                        $datosPDF=[];
                        $datosPDF['tipo_tramite']=$tipoTramite;
                        $datosPDF['razon_social_o_nombre']=$datos->razon_social_o_nombre;
                        $datosPDF['folio']=$datos->folio;
                        $datosPDF['motivo']=$txtMotivo;

                        $datosEnviarCorreo=[];
                        $datosEnviarCorreo['asunto']='Notificación del Sistema SIRCSE';
                        $datosEnviarCorreo['cuerpo']= CorreoPlantillas::tramite_rechazado($datosPDF);
                        $datosEnviarCorreo['correo_destinatario']=$datos->email;
                        $datosEnviarCorreo['nombre_destinatario']=$datos->razon_social_o_nombre;  
                        
                        Correo::sendEmail($datosEnviarCorreo, 0, null);
                        
                        $vrespuesta['correo-' . $key ]=$mensajeEnvioCorreo;
                        unset($datosPDF, $datosEnviarCorreo);
                    }

                    $vflN_Usuario= new N_Usuario;
                    $vflN_Usuario->fill([
                        "id_c_notificacion"=>4,
                        "id_tipo_notificacion"=>2,
                        "id_tramite"=>$datos->id_tramite,
                        "descripcion"=>$txtMotivo,
                        "visto"=>0
                    ])->save();
                    unset($vflN_Usuario);


                    $vflExecuteCron= new T_Execute_Cron;
                    $vflExecuteCron->fill(["cron"=> 'Ejecución de cron '. date('Y-m-d H:i:s') .' solventaciones no realizadas en tiempo, FOLIO: '. $datos->folio, "description" => $txtMotivo])->save();

                    # End: Envio de Correo Electrónico.               
                    \Log::info("¡Cron está funcionando bien!");
                    $this->info('Demostración: ¡Ejecutar Cron Cummand con éxito!');
                    
                    DB::commit();
                }
            }
            $vflExecuteCron= new T_Execute_Cron;
            $vflExecuteCron->fill(["cron"=> 'Ejecución de cron '. date('Y-m-d H:i:s') .' solventaciones no realizadas en tiempo'])->save();
        }
        catch( Exception $vexception ) {
            DB::rollback();
            $vstatus=500;
            $vrespuesta=['codigo' => -1, 'mensaje' => $vexception->getMessage()];
        }
     }
}
