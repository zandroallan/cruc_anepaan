<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Classes\clsTools;
use App\Http\Classes\Validations;
use App\Http\Models\Aportacion;
use Auth;
use DB;
use Hash;
use Str;

class SolicitudRegistroController extends Controller
{
    private $route='solicitud';
    public function __construct()
    {
        //  $this->middleware('auth');
        view()->share('title', 'Solicitud');
        view()->share('current_route', $this->route);       
    } 

    public function create()
    {      
        $estados= \App\Http\Models\Catalogos\C_Estado::lists();
        $municipios= \App\Http\Models\Catalogos\C_Municipio::lists();
        $tipo_identificaciones= \App\Http\Models\Catalogos\C_Tipo_Identificacion::lists();
        return view('frontend.registro.create', ['estados'=>$estados, 'municipios'=>$municipios, 'tipo_identificaciones'=>$tipo_identificaciones]);
    }   


    public function store(AportacionModRequest $request)
    {
        $arr_validacion= [];
        $validation = new Validations;
        $status= 1; $code= 201;
        $post= $request->all();
        isset($post['id']) ? $id=$post['id'] : $id= 0;
        if($id==0){
            $id_dependenciaa=  Auth::User()->id_dependencia;
            $post['id_dependencia']=  $id_dependenciaa;

        }else{
            if(Auth::User()->hasRole(['dpaportacion'])){  
                $id_dependenciaa= Auth::User()->id_dependencia;
            }else{
                $id_dependenciaa= 0;
            }          
        }

        $validation->dpAportacionNew(['id'=> $id, 'id_dependencia'=>$id_dependenciaa]);
        if(!$validation->getStatusB()){ 
            try{
                DB::beginTransaction();
                isset($post['id']) ? $datos= Aportacion::find($id) : $datos= new Aportacion; 
                $datos->fill($post)->save();

                //Historial
                $hstrl_datos= new HstrlAportacion;
                $hstrl_post["id_movimiento"]= $post["id_movimiento"];                
                $hstrl_post["id_usuario"]= Auth::User()->id;
                $hstrl_post["id_aportacion"]= $datos->id;
                $hstrl_post["n_aportacion"]= $post["n_aportacion"];
                $hstrl_post["total_aportacion"]= $post["total_aportacion"];
                $hstrl_datos->fill($hstrl_post)->save();

                DB::commit();
                $msg= "La información ha sido registrada"; $route_redirect= route($this->route.'.index'); $data= $datos;
            }catch (\Exception $e) {
                $status= 3; $code= 409; $msg= $e->getMessage(); $route_redirect= ""; $data= [];
                DB::rollback();                       
            }
        }else{
            $status= 3; $code= $validation->getStatusCode(); $msg= $validation->getStatusMsg(); $route_redirect= ""; $data= [];
        }
        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$data], $code);
    }
}
