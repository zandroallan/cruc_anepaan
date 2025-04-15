<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Classes\clsTools;
use App\Http\Classes\Validations;
use App\Http\Classes\TipoTramite;
use App\Http\Models\Backend\T_Registro;
use Auth;
use Str;
use DB;
use \App\Http\Models\Catalogos\N_Usuario;
class NotificacionesController extends Controller
{
    private $route='notificaciones';
    public function __construct(){
        $this->middleware('auth');
        view()->share('title', 'Notificaciones');
        view()->share('current_route', $this->route);       
    }

    public function acusar($id){    
        $status= 1; $code= 201;   
        $helper= new \App\Http\Classes\Helper;
        $hoy= date("Y-m-d");
        $fechaLimite= $helper->fechaLimieSolventacion($hoy);
        $n_usuario = N_Usuario::find($id);
        $p_usuario["visto"]= 1;
        $p_usuario["fecha_acuse"]= date("Y-m-d H:i:s");
        $p_usuario["fecha_limite"]= $fechaLimite." 23:59:59";

        $p_usuario["acepto_condiciones"]= 1;
        DB::beginTransaction();
        try {
            $n_usuario->fill($p_usuario)->save(); 

            $msg= 'Se ha acusado la notificación con fecha <b>'.$p_usuario["fecha_acuse"].'</b>';
            $route_redirect= route('home');
            $data= []; 

            DB::commit();
        }catch (\Exception $e) {            
            $status= 3; $code= 409; $msg= $e->getMessage(); $route_redirect= ""; $data= [];
            DB::rollback(); 
        }
        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$data], $code);
    } 
}
