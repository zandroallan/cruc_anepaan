<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Models\Catalogos\N_Usuario;
use App\Http\Classes\CorreoPlantillas;
use App\Http\Models\Backend\T_Execute_Cron;
use App\Http\Classes\Correo;
use DB; 

class NotificacionesPorExpirarCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'por_expirar:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de notificaciones a los tramites que estan por expirar.';

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
        //
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
                    $datosEnviarCorreo['asunto']= 'Recordatorio Folio '. $datos->folio;
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
                    
                    # End: Envio de Correo Electrónico.               
					\Log::info("Cron is working fine!". $vrespuesta['notificacion -' . $key ]);
					$this->info('Demo:Cron Cummand Run successfully!');
					
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
    }
}
