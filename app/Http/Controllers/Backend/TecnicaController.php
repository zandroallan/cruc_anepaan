<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\AgregarEspecialidadRTEC;
use App\Http\Models\Backend\T_Registro;
use App\Http\Models\Backend\T_Tramite;
use App\Http\Requests\Backend\T_Tramite_Tecnica_Representante_Tecnico;
use App\Http\Models\Backend\T_Tramite_Rep_Tecnico;
use App\Http\Models\Catalogos\C_Especialidad;
use App\Http\Models\Backend\D_Personal;
use App\Http\Models\Backend\D_Domicilio;
use App\Http\Models\Catalogos\C_Colegio;
use App\Http\Models\Catalogos\C_Tipo_Colegio;
use App\Http\Classes\FormatDate;
use App\Http\Classes\Validations;
use Carbon\Carbon;
use Auth;
use DB;

class TecnicaController extends Controller
 {
    private $route_coordinador='tramites-area-tecnica';
    private $title_dinamic= 'Trámites';
    
    public function __construct() 
     {
        $this->middleware('auth');
        view()->share('title', $this->title_dinamic);
        view()->share('current_route', $this->route_coordinador);       
     }

    public function getRepresentanteTecnico( $id )
     {
        $t_tramites_rtec=T_Tramite_Rep_Tecnico::edit($id);
        if( !$t_tramites_rtec ) {
            $t_tramites_rtec["id"]= 0;
            $t_tramites_rtec["id_d_personal"]= 0;
            $t_tramites_rtec["id_profesion"]= 0;
            $t_tramites_rtec["id_colegio"]= 0;
            $t_tramites_rtec["id_tipo_constancia"]= 1;
            $t_tramites_rtec["num_constancia"]= "";
            $t_tramites_rtec["cedula"]= "";
            $t_tramites_rtec["fecha_cedula"]= "";
            $t_tramites_rtec["reposicion"]= 0;

            $t_tramites_rtec["nombre"]= "";
            $t_tramites_rtec["ap_paterno"]= "";
            $t_tramites_rtec["ap_materno"]= "";
            $t_tramites_rtec["curp"]= "";
            $t_tramites_rtec["rfc"]= "";
            $t_tramites_rtec["id_nacionalidad"]= 0;
            $t_tramites_rtec["telefono"]= "";
            $t_tramites_rtec["correo_electronico"]= "";
            $t_tramites_rtec["id_tipo_identificacion"]= 0;
            $t_tramites_rtec["numero_identificacion"]= "";

            $t_tramites_rtec["id_estado_particular"]= 0;
            $t_tramites_rtec["id_municipio_particular"]= 0;
            $t_tramites_rtec["ciudad_particular"]= "";
            $t_tramites_rtec["cp_particular"]= "";
            $t_tramites_rtec["calle_particular"]= "";
            $t_tramites_rtec["ext_particular"]= "";
            $t_tramites_rtec["int_particular"]= "";
            $t_tramites_rtec["colonia_particular"]= "";
            $t_tramites_rtec["referencias_particular"]= "";
            $t_tramites_rtec=(object)$t_tramites_rtec;
        }
        else {
            $t_tramites_rtec["fecha_cedula"]=$t_tramites_rtec["fecha_cedula"];
        }
        $t_tramites_rtec= $t_tramites_rtec;
        return response()->json($t_tramites_rtec);
     }

    public function datosRepresentanteTecnico($id_registro_tmp)
     {
        $resultados=T_Tramite_Rep_Tecnico::getRepresentantesTecnico(['id_registro_tmp'=>$id_registro_tmp])->get();
        return $resultados;
     }

    public function storeRepresentanteTecnico(T_Tramite_Tecnica_Representante_Tecnico $request)
     {
        $arr_validacion= [];
        $validation = new Validations;
        $status= 1; $code= 201;
        $post= $request->all();
        
        isset($post['dtrtec_id']) ? $id= $post['dtrtec_id'] : $id= 0; 
        
        //Datos personales
        $p_personal['nombre']= $post['dtrtec_nombre'];
        $p_personal['ap_paterno']= $post['dtrtec_ap_paterno'];
        $p_personal['ap_materno']= $post['dtrtec_ap_materno'];
        $p_personal['curp']= $post['dtrtec_curp'];    
        $p_personal['sexo']= $post['dtrtec_sexo'];
        

        //Datos representante técnico
        $p_rep_tecnico['id_tramite']=0;
        $p_rep_tecnico['id_registro_tmp']= Auth::user()->id_registro;
        $p_rep_tecnico['id_profesion']=$post['dtrtec_id_profesion'];
        $p_rep_tecnico['id_colegio']=$post['dtrtec_id_colegio'];
        $p_rep_tecnico['id_tipo_constancia']=$post['dtrtec_id_tipo_constancia'];
        $p_rep_tecnico['num_constancia']=$post['dtrtec_num_constancia'];
        
        $p_rep_tecnico['cedula']=$post['dtrtec_cedula'];        
        //formateo de fecha recibida    
        //$date =  Carbon::createFromFormat('d/m/Y', $post['dtrtec_fecha_cedula']);
        $p_rep_tecnico['fecha_cedula']=$post['dtrtec_fecha_cedula'];
        $p_rep_tecnico['reposicion']=$post['dtrtec_reposicion'];      

        $validation->repTecnicoNuevo([
            'id'=>$id, 
            'id_registro_tmp'=>$p_rep_tecnico['id_registro_tmp'],
            'id_tipo_constancia'=>$p_rep_tecnico['id_tipo_constancia'],
            'curp'=>$p_personal['curp'],
            'anio'=>FormatDate::anio(date('Y'), 1)
        ]);

        if(!$validation->getStatusB()) { 
            try {
                DB::beginTransaction();
                if( $id == 0 ) {
                    $p_rep_tecnico['especialidades']='[]';
                    $t_rep_tecnico= new T_Tramite_Rep_Tecnico;
                    $d_personal= new D_Personal;                                       
                    $datos_tramite= T_Tramite::find($post["dtrtec_id_tramite"]);
                }
                else {
                    $t_rep_tecnico= T_Tramite_Rep_Tecnico::find($id);
                    $d_personal= D_Personal::find($t_rep_tecnico->id_d_personal);                     
                }
               
                //Datos personales
                $d_personal->fill($p_personal)->save();
                $p_rep_tecnico['id_d_personal']= $d_personal->id; 
                //Representante técnico
                $t_rep_tecnico->fill($p_rep_tecnico)->save();
                DB::commit();

                if( $id == 0 ) {
                    $msg="El representante técnico ha sido registrado"; 
                    $route_redirect= "";
                }
                else {
                    $msg="El  representante técnico ha sido actualizado"; 
                    $route_redirect= "";
                } 
                $data=$t_rep_tecnico;
            }
            catch (\Exception $e) {
                $status= 3;
                $code= 409;
                $msg=$e->getMessage();
                $route_redirect="";
                $data= [];
                DB::rollback();                       
            }
        }
        else {
            $status=3;
            $code=$validation->getStatusCode();
            $msg=$validation->getStatusMsg();
            $route_redirect="";
            $data=[];
        }
        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$data], $code);
     }

    public function getEspecialidadesRTEC($id_t_rep_tec)
     {
        $t_rep_tec=T_Tramite_Rep_Tecnico::find($id_t_rep_tec);
        $especialidades=json_decode($t_rep_tec->especialidades);
        $resultados=[];

        foreach($especialidades as $esp) {
            $especialidad=C_Especialidad::find($esp);
            array_push($resultados, ['id'=> $especialidad->id, 'clave'=> $especialidad->clave, 'nombre'=> $especialidad->nombre]);
        }
        return response()->json($resultados);
     }

    public function destroyRTEC($id)
     {
        $_MDL_Tramite_Rep_Tecnico= T_Tramite_Rep_Tecnico::find($id);
        $id_tramite= $_MDL_Tramite_Rep_Tecnico->id_tramite;
        try {  
            DB::beginTransaction();
            $_MDL_Tramite_Rep_Tecnico->delete();                        
            DB::commit();
        }
        catch (\Exception $e) {            
            $error = $e->getMessage();
            DB::rollback();
            $message= ['errors'=>$error, 'id_tramite'=>$id_tramite];
            return response()->json($message, 409);
        }
        $message= ['success'=>'Los datos han sido <b>eliminados</b>.', 'id_tramite'=>$id_tramite];
        return response()->json($message, 201);
     }

    public function getColegiosEspecialidades($id_r_tec)
     {    
        $t_rep_tec=T_Tramite_Rep_Tecnico::find($id_r_tec);
        $t_registro=T_Registro::find($t_rep_tec->id_registro_tmp);
        
        $c_colegio=C_Colegio::find($t_rep_tec->id_colegio);
        $tipo_colegio=C_Tipo_Colegio::find($c_colegio->id_tipo_colegio);
        $todas_especialidades=C_Especialidad::lists(["id_sujeto"=>$t_registro->id_sujeto]);
        
        $especialidades=(array)json_decode($tipo_colegio->especialidades);
        $resultados=array();     
        foreach($todas_especialidades as $key => $value) {
            if(in_array($key, $especialidades)){
                $resultados[$key]=$value;
            }
        }        
        return $todas_especialidades;
     }

    public function storeEspecialidadRTEC(AgregarEspecialidadRTEC $request)
     { 
        
        $validation = new Validations;
        $status= 1; $code= 201;
        $post= $request->all();        
        
        $id_t_rep_tec= $post["dtsp_id_tramite_esp"];
        $id_especialidad= $post["dtsp_id_especialidad_esp"];
        $datos= T_Tramite_Rep_Tecnico::find($id_t_rep_tec);
        
        $rtec_especialidades= json_decode($datos->especialidades); 
        if($rtec_especialidades=="") { 
            $rtec_especialidades= []; 
        } 
        $validation->agregarEspecialidad($rtec_especialidades, $id_especialidad);
    
        if(!$validation->getStatusB()){ 
            try {
                DB::beginTransaction();
                array_push($rtec_especialidades, $id_especialidad);
                $p['especialidades']= json_encode(array_values($rtec_especialidades));
                $datos->fill($p)->save();                
                DB::commit(); 

                $msg= "La especialidad se ha agregado satisfactoriamente"; 
                $route_redirect= "";
                $data= $datos;
            }
            catch (\Exception $e) {
                $status= 3; $code= 409; $msg= $e->getMessage(); $route_redirect= ""; $data= [];
                DB::rollback();                       
            }
        }
        else {
            $status= 3; 
            $code=$validation->getStatusCode(); 
            $msg= $validation->getStatusMsg(); 
            $route_redirect= "";
            $data= [];
        }
        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$data], $code);
    }
    
    public function destroyEspecialidadesRTEC($id_t_rep_tec, $id_especialidad)
     {
        $code= 201; 
        $datos= T_Tramite_Rep_Tecnico::find($id_t_rep_tec);

        $tramite_especialidades= json_decode($datos->especialidades);
        $especialidades_actualizadas= array_diff( $tramite_especialidades, [$id_especialidad]);
        $p['especialidades']= json_encode(array_values($especialidades_actualizadas));
        try {
            DB::beginTransaction(); 
            $datos->fill($p)->save(); 
            $data=$datos;          
            DB::commit();
        }
        catch (\Exception $e) {  
            $code= 409;
            $data= [];
            DB::rollback();                       
        }
        return response()->json(['data'=>$data], $code);
     }
 }