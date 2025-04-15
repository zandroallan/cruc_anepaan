<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Classes\clsTools;
use App\Http\Classes\Validations;
use App\Http\Classes\TipoTramite;
use App\Http\Models\Backend\T_Registro;
use Auth;
use DB;
use Hash;
use Str;

class RegistroController extends Controller
{
    private $route='registro';
    public function __construct(){
        $this->middleware('auth');
        view()->share('title', 'Registro');
        view()->share('current_route', $this->route);       
    } 

    public function resultados_registros(Request $request){
        $array= [];
        $get= $request->all();
        if(isset($get['i_search'])) {
            $array['i_search']= $get['i_search'];
        }        
        $resultados = T_Registro::general($array)->get();
        return $resultados;
    }
    
    public function resultados_tramites(Request $request){
        $array= [];
        $get= $request->all();
        if(isset($get['anio'])) {
            if($get['anio']!=0){
                $array['anio']= $get['anio'];
            }
        }     
        $resultados = \App\Http\Models\Backend\T_Tramite::general($array)->get();
        return $resultados;
    }      
    
    public function mis_tramites($id_cs){
        $resultados = \App\Http\Models\Backend\T_Tramite::tramites(['id_cs'=>$id_cs])->get();
        return $resultados;
    }    

    public function index(){      
        return view('backend.registro.index', []);
    }     

    public function create(){      
        $id_tipo_tramite= 1;
        $estados= \App\Http\Models\Catalogos\C_Estado::lists();
        $municipios_f= [0=>"Seleccionar"];
        $municipios_p= [0=>"Seleccionar"];
        $nacionalidades= \App\Http\Models\Catalogos\C_Nacionalidad::lists(); 
        $tipo_identificaciones= \App\Http\Models\Catalogos\C_Tipo_Identificacion::lists(); 
        $default_nacionalidad= 37;   
        $chk_id_sujeto_1='checked=""'; $chk_id_sujeto_2="";
        $chk_id_tipo_persona_1='checked=""'; $chk_id_tipo_persona_2="";
        $chk_sexo_1='checked=""'; $chk_sexo_2="";  
        
        return view('backend.registro.create', ['id_tipo_tramite'=>$id_tipo_tramite,'estados'=>$estados, 'municipios_f'=>$municipios_f, 'municipios_p'=>$municipios_p, 'nacionalidades'=>$nacionalidades, 'tipo_identificaciones'=>$tipo_identificaciones, 'default_nacionalidad'=>$default_nacionalidad, 'chk_id_sujeto_1'=>$chk_id_sujeto_1, 'chk_id_sujeto_2'=>$chk_id_sujeto_2, 'chk_id_tipo_persona_1'=>$chk_id_tipo_persona_1, 'chk_id_tipo_persona_2'=>$chk_id_tipo_persona_2, 'chk_sexo_1'=>$chk_sexo_1, 'chk_sexo_2'=>$chk_sexo_2]);
    }   

    public function edit($id){  
        $datos     = T_Registro::edit($id);
        $estados= \App\Http\Models\Catalogos\C_Estado::lists();
        $municipios_f= \App\Http\Models\Catalogos\C_Municipio::lists(['id_estado'=>$datos->id_estado_fiscal]);

        if($datos->id_tipo_persona==1){
            $municipios_p= \App\Http\Models\Catalogos\C_Municipio::lists(['id_estado'=>$datos->id_estado_particular]);
        }else{
            $municipios_p= [0=>"Seleccionar"];
        }

        $nacionalidades= \App\Http\Models\Catalogos\C_Nacionalidad::lists(); 
        $tipo_identificaciones= \App\Http\Models\Catalogos\C_Tipo_Identificacion::lists(); 
        $default_nacionalidad= $datos->id_nacionalidad; 

        $chk_id_sujeto_1=""; $chk_id_sujeto_2="";
        $chk_id_tipo_persona_1=''; $chk_id_tipo_persona_2="";
        $chk_sexo_1=''; $chk_sexo_2="";        

        ($datos->id_sujeto==1) ? $chk_id_sujeto_1= 'checked=""' : $chk_id_sujeto_2= 'checked=""';
        ($datos->id_tipo_persona==1) ? $chk_id_tipo_persona_1= 'checked=""' : $chk_id_tipo_persona_2= 'checked=""';
        ($datos->sexo==1) ? $chk_sexo_1= 'checked=""' : $chk_sexo_2= 'checked=""';

        return view('backend.registro.edit', ['datos'=>$datos,'estados'=>$estados, 'municipios_f'=>$municipios_f, 'municipios_p'=>$municipios_p, 'nacionalidades'=>$nacionalidades, 'tipo_identificaciones'=>$tipo_identificaciones, 'default_nacionalidad'=>$default_nacionalidad, 'chk_id_sujeto_1'=>$chk_id_sujeto_1, 'chk_id_sujeto_2'=>$chk_id_sujeto_2, 'chk_id_tipo_persona_1'=>$chk_id_tipo_persona_1, 'chk_id_tipo_persona_2'=>$chk_id_tipo_persona_2, 'chk_sexo_1'=>$chk_sexo_1, 'chk_sexo_2'=>$chk_sexo_2]);
    }    

    public function nuevo_tramite($id){
        
        $datos= T_Registro::edit($id);
        $ultimo_tramite= T_registro::get_ultimo_tramite($datos->rfc);        
        $clsTipoTramite = new TipoTramite;
        $tramite_siguiente= $clsTipoTramite->getNewTramite($ultimo_tramite);
        $lbl_tramite_siguiente= $clsTipoTramite->getTipoTramiteMsg();

        if($tramite_siguiente!=1 && $tramite_siguiente!=2 && $tramite_siguiente!=3) {
            return redirect()->route($this->route.'.show', $datos->id);
        }
        
        $estados= \App\Http\Models\Catalogos\C_Estado::lists();
        $municipios_f= \App\Http\Models\Catalogos\C_Municipio::lists(['id_estado'=>$datos->id_estado_fiscal]);

        if($datos->id_tipo_persona==1){
            $municipios_p= \App\Http\Models\Catalogos\C_Municipio::lists(['id_estado'=>$datos->id_estado_particular]);
        }else{
            $municipios_p= [0=>"Seleccionar"];
        }

        $nacionalidades= \App\Http\Models\Catalogos\C_Nacionalidad::lists(); 
        $tipo_identificaciones= \App\Http\Models\Catalogos\C_Tipo_Identificacion::lists(); 
        $default_nacionalidad= $datos->id_nacionalidad; 

        $chk_id_sujeto_1=""; $chk_id_sujeto_2="";
        $chk_id_tipo_persona_1=''; $chk_id_tipo_persona_2="";
        $chk_sexo_1=''; $chk_sexo_2="";        

        ($datos->id_sujeto==1) ? $chk_id_sujeto_1= 'checked=""' : $chk_id_sujeto_2= 'checked=""';
        ($datos->id_tipo_persona==1) ? $chk_id_tipo_persona_1= 'checked=""' : $chk_id_tipo_persona_2= 'checked=""';
        ($datos->sexo==1) ? $chk_sexo_1= 'checked=""' : $chk_sexo_2= 'checked=""';

        return view('backend.registro.nuevo-tramite', ['datos'=>$datos, 'id_tipo_tramite'=>$tramite_siguiente, 'lbl_tramite_siguiente'=>$lbl_tramite_siguiente, 'estados'=>$estados, 'municipios_f'=>$municipios_f, 'municipios_p'=>$municipios_p, 'nacionalidades'=>$nacionalidades, 'tipo_identificaciones'=>$tipo_identificaciones, 'default_nacionalidad'=>$default_nacionalidad, 'chk_id_sujeto_1'=>$chk_id_sujeto_1, 'chk_id_sujeto_2'=>$chk_id_sujeto_2, 'chk_id_tipo_persona_1'=>$chk_id_tipo_persona_1, 'chk_id_tipo_persona_2'=>$chk_id_tipo_persona_2, 'chk_sexo_1'=>$chk_sexo_1, 'chk_sexo_2'=>$chk_sexo_2]);
    }      

    public function show($id){
        $datos= T_Registro::edit($id);

        //Obtener último trámite
        $ultimo_tramite= T_registro::get_ultimo_tramite($datos->rfc);
        $clsTipoTramite = new TipoTramite;
        $tramite_siguiente= $clsTipoTramite->getNewTramite($ultimo_tramite);
        $lbl_tramite_siguiente= $clsTipoTramite->getTipoTramiteMsg();

        $documentos_requeridos= [];
        return view('backend.registro.show',['datos'=>$datos, 'tramite_siguiente'=>$tramite_siguiente, 'lbl_tramite_siguiente'=>$lbl_tramite_siguiente,'documentos_requeridos'=>$documentos_requeridos]);
    }

    public function store(\App\Http\Requests\Backend\Registro $request){        
        $arr_validacion= [];
        $validation = new Validations;
        $status= 1; $code= 201;
        $post= $request->all();

        isset($post['id_sujeto']) ? $id_sujeto= $post['id_sujeto'] : $id_sujeto= 0;        
        $id_tipo_persona= $post['id_tipo_persona'];
        isset($post['id']) ? $id=$post['id'] : $id= 0; 
        isset($post['id_tipo_tramite']) ? $id_tipo_tramite=$post['id_tipo_tramite'] : $id_tipo_tramite= 0;

        //Datos para tabla T_Registro
        if($id_sujeto!=0){
            $p_registro['id_sujeto']= $id_sujeto;    
        }    
        $p_registro['id_tipo_persona']= $id_tipo_persona;
        $p_registro['rfc']= $post['rfc'];
        $p_registro['telefono']= $post['telefono'];
        $p_registro['email']= $post['correo'];

        //Datos para D_Domicilio fiscal
        $p_domicilio_fiscal['id_tipo_domicilio']= 2;
        $p_domicilio_fiscal['id_municipio']= $post['id_municipio_fiscal'];
        $p_domicilio_fiscal['ciudad']= $post['ciudad_fiscal'];
        $p_domicilio_fiscal['codigo_postal']= $post['cp_fiscal'];
        $p_domicilio_fiscal['calle']= $post['calle_fiscal'];
        $p_domicilio_fiscal['num_exterior']= $post['ext_fiscal'];
        $p_domicilio_fiscal['num_interior']= $post['int_fiscal'];
        $p_domicilio_fiscal['colonia']= $post['colonia_fiscal'];
        $p_domicilio_fiscal['referencias']= $post['referencias_fiscal'];        

        if($id_tipo_persona==1){

            //Datos para tabla T_Registro
            $p_registro['razon_social_o_nombre']= $post['nombre'].' '.$post['ap_paterno'].' '.$post['ap_materno'];

            //Datos personales
            $p_personal['nombre']= $post['nombre'];
            $p_personal['ap_paterno']= $post['ap_paterno'];
            $p_personal['ap_materno']= $post['ap_materno'];
            $p_personal['curp']= $post['curp'];
            $p_personal['rfc']= $post['rfc'];
            $p_personal['id_nacionalidad']= $post['id_nacionalidad'];
            $p_personal['sexo']= $post['sexo'];
            $p_personal['telefono']= $post['telefono'];
            $p_personal['correo_electronico']= $post['correo'];
            $p_personal['id_tipo_identificacion']= $post['id_tipo_identificacion'];
            $p_personal['numero_identificacion']= $post['numero_identificacion'];

            //Datos para D_Domicilio particular
            $p_domicilio_particular['id_tipo_domicilio']= 1;
            $p_domicilio_particular['id_municipio']= $post['id_municipio_particular'];
            $p_domicilio_particular['ciudad']= $post['ciudad_particular'];
            $p_domicilio_particular['codigo_postal']= $post['cp_particular'];
            $p_domicilio_particular['calle']= $post['calle_particular'];
            $p_domicilio_particular['num_exterior']= $post['ext_particular'];
            $p_domicilio_particular['num_interior']= $post['int_particular'];
            $p_domicilio_particular['colonia']= $post['colonia_particular'];
            $p_domicilio_particular['referencias']= $post['referencias_particular'];  

        }else{
            //Datos para tabla T_Registro
            $p_registro['razon_social_o_nombre']= $post['razon_social_o_nombre'];
        }

        $validation->registroNuevo(['id'=> $id, 'rfc'=>$p_registro['rfc']]);
        if(!$validation->getStatusB()){ 
            try{
                DB::beginTransaction();                
                
                if($id==0){                    
                    $d_registro= new T_Registro;                    
                    $d_domicilio_fiscal= new \App\Http\Models\Backend\D_Domicilio;
                    $t_tramite= new \App\Http\Models\Backend\T_Tramite; 
                    if($id_tipo_persona==1){
                        $d_personal= new \App\Http\Models\Backend\D_Personal;
                        $d_domicilio_particular= new \App\Http\Models\Backend\D_Domicilio; 
                    }                   
                }else{
                    $d_registro= T_Registro::find($id);                    
                    if($id_tipo_tramite!=0){
                        $t_tramite= new \App\Http\Models\Backend\T_Tramite; 
                        $d_domicilio_fiscal= new \App\Http\Models\Backend\D_Domicilio;
                        if($id_tipo_persona==1){
                            $d_personal= new \App\Http\Models\Backend\D_Personal;
                            $d_domicilio_particular= new \App\Http\Models\Backend\D_Domicilio; 
                        }                         
                    }else {
                        $d_domicilio_fiscal= \App\Http\Models\Backend\D_Domicilio::find($post['id_domicilio_fiscal']);
                        if($id_tipo_persona==1){
                            $d_personal= \App\Http\Models\Backend\D_Personal::find($post['id_d_personal']);
                            $d_domicilio_particular= \App\Http\Models\Backend\D_Domicilio::find($post['id_domicilio_particular']); 
                        }
                    }
                }

                //Domicilio fiscal
                $d_domicilio_fiscal->fill($p_domicilio_fiscal)->save();
               
                $p_registro['id_d_domicilio_fiscal']= $d_domicilio_fiscal->id;
                
                if($id_tipo_persona==1){
                    $d_domicilio_particular->fill($p_domicilio_particular)->save();
                    $p_personal['id_d_domicilio']= $d_domicilio_particular->id;

                    $d_personal->fill($p_personal)->save();
                    $p_registro['id_d_personal']= $d_personal->id;
                }
                $d_registro->fill($p_registro)->save();

                if($id==0 || $id_tipo_tramite!=0 ){
                    $id_sujeto= $d_registro->id_sujeto;
                    ($id_sujeto==1) ? $clave_sujeto="C" : $clave_sujeto="S";
                    $total_tramites= (\App\Http\Models\Backend\T_Tramite::total_anio(date('Y')))+1;

                    $p_tramite['folio']= date('Y').'-'.$clave_sujeto.'-'.str_pad($total_tramites,6,"0",STR_PAD_LEFT);
                    $documentacion_recibida= $post['docto_recibida'];
                    $documentacion_requerida= \App\Http\Models\Catalogos\C_Tipo_Tramite::documentacion_requerida($id_tipo_tramite, $id_sujeto);
                    $documentacion_pendiente= array_diff( $documentacion_requerida, $documentacion_recibida);

                    $p_tramite['id_cs']= $d_registro->id;
                    $p_tramite['id_tipo_tramite']= $id_tipo_tramite;
                    $p_tramite['fecha_inicio']= date('Y-m-d H:i:s');
                    $p_tramite['especialidades_tecnicas']= json_encode([]);
                    $p_tramite['documentacion_recibida']= json_encode($documentacion_recibida);
                    $p_tramite['documentacion_pendiente']= json_encode(array_values($documentacion_pendiente));
                    $p_tramite['documentacion_revisada']= json_encode([]);
                    $p_tramite['documentacion_no_revisada']= json_encode([]);                    
                    $p_tramite['documentacion_observaciones']= json_encode([]);
                    $p_tramite['id_d_domicilio_fiscal']= $d_domicilio_fiscal->id;
                    $p_tramite['telefono']= $post['telefono'];
                    $p_tramite['email']= $post['correo'];
                    $t_tramite->fill($p_tramite)->save();

                    $d_registro2= T_Registro::find($d_registro->id);
                    $p_registro2['id_ultimo_tramite']= $t_tramite->id;
                    $d_registro2->fill($p_registro2)->save();
                }
                DB::commit();
                
                if($id==0){
                    $msg= "La información ha sido registrada"; 
                    $route_redirect= route($this->route.'.index');
                }else{
                    $msg= "La información ha sido actualizada"; 
                    $route_redirect= route($this->route.'.show', $d_registro->id);
                } 
                $data= [];
            }catch (\Exception $e) {
                $status= 3; $code= 409; $msg= $e->getMessage(); $route_redirect= ""; $data= [];
                DB::rollback();                       
            }
        }else{
            $status= 3; $code= $validation->getStatusCode(); $msg= $validation->getStatusMsg(); $route_redirect= ""; $data= [];
        }
        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$data], $code);
    } 

    public function destroy($id){        
        $d_registro = T_Registro::find($id);
        $id_tipo_persona= $d_registro->id_tipo_persona;
        $d_domicilio_fiscal= \App\Http\Models\Backend\D_Domicilio::find($d_registro->id_d_domicilio_fiscal);

        DB::beginTransaction();
        try {  

            if($id_tipo_persona==1){
                $d_personal= \App\Http\Models\Backend\D_Personal::find($d_registro->id_d_personal);
                $d_domicilio_particular= \App\Http\Models\Backend\D_Domicilio::find($d_personal->id_d_domicilio);
                $d_personal->delete();
                $d_domicilio_particular->delete();
            } 
            $d_registro->delete();
            $d_domicilio_fiscal->delete();
                        
            DB::commit();
        }catch (\Exception $e) {            
            $error = $e->getMessage();
            DB::rollback();
            $message= ['errors'=>$error,'url'=>route($this->route.'.index')];
            return response()->json($message, 409);
        }
        $message= ['success'=>'Los datos han sido <b>eliminados</b>.','url'=>route($this->route.'.index')];
        return response()->json($message, 201);
    }
    
    public function store_document(\App\Http\Requests\Backend\SubirDocumento $request){
        $arr_validacion= [];
        $validation = new Validations;
        $status= 1; $code= 201;
        $post= $request->all();
        $id_tramite= $post["id_tramite"];
        $id_documento= $post["id_documento"];
        $t_tramite= \App\Http\Models\Backend\T_Tramite::find($post['id_tramite']); 
        $t_registro= \App\Http\Models\Backend\T_Registro::find($t_tramite->id_cs);
        $folder= '/expedientes/'.$t_registro->rfc.'/'.$t_tramite->folio;
        $path= storage_path().$folder;

        $validation->registroSubirDocumento(['id_tramite'=> $id_tramite, 'id_documento'=>$id_documento]);
        if(!$validation->getStatusB()){ 
            try{
                DB::beginTransaction();  
                $t_tramite_documentacion= new \App\Http\Models\Backend\T_Tramite_Documentacion;

                if ($request->hasFile('archivosubido')) {
                    if ($request->file('archivosubido')->isValid()) {
                        $file= $request->archivosubido;
                        $extension= $file->extension();
                        $fileName = $id_documento.'_'.time().'.'.$extension;
                        $file->move($path, $fileName);
                    }
                }

                $post_documento["id_tramite"]= $id_tramite;
                $post_documento["id_documentacion"]= $id_documento;
                $post_documento["path"]= $folder;
                $post_documento["nombre"]= $fileName;
                $post_documento["extension"]= $extension;
                $post_documento["tamanio"]= 11;
                $post_documento["id_status"]= 2;
                $post_documento["id_usuario_subio"]= Auth::User()->id;
                $t_tramite_documentacion->fill($post_documento)->save();                
                DB::commit(); 

                $msg= "El documento ha sido subido satisfactoriamente"; 
                $route_redirect= route($this->route.'.index');
                $data= $t_tramite_documentacion;
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