<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Classes\Validations;
use App\Http\Models\Backend\T_Registro;
use App\Http\Classes\CorreoPlantillas;
use App\Http\Classes\Correo;
use App\Http\Classes\clsFunciones;
use DB;
use Hash;
use Str;
use App\User;
class CrearCuentaController extends Controller
{
    private $route='crear-cuenta';
    public function __construct()
    {
        view()->share('title', 'crear-cuenta');
        view()->share('current_route', $this->route);       
    } 

    public function create(){
        $estados= \App\Http\Models\Catalogos\C_Estado::lists();
        $municipios_f= [0=>"Seleccionar"];
        $municipios_p= [0=>"Seleccionar"];
        $nacionalidades= \App\Http\Models\Catalogos\C_Nacionalidad::lists(); 
        $tipo_identificaciones= \App\Http\Models\Catalogos\C_Tipo_Identificacion::lists(); 
        $default_nacionalidad= 37;   
        $chk_id_sujeto_1='checked=""'; $chk_id_sujeto_2="";
        $chk_id_tipo_persona_1='checked=""'; $chk_id_tipo_persona_2="";
        $chk_sexo_1='checked=""'; $chk_sexo_2="";  

        return view('frontend.crear-cuenta.create', ['estados'=>$estados, 'municipios_f'=>$municipios_f, 'municipios_p'=>$municipios_p, 'nacionalidades'=>$nacionalidades, 'tipo_identificaciones'=>$tipo_identificaciones, 'default_nacionalidad'=>$default_nacionalidad, 'chk_id_sujeto_1'=>$chk_id_sujeto_1, 'chk_id_sujeto_2'=>$chk_id_sujeto_2, 'chk_id_tipo_persona_1'=>$chk_id_tipo_persona_1, 'chk_id_tipo_persona_2'=>$chk_id_tipo_persona_2, 'chk_sexo_1'=>$chk_sexo_1, 'chk_sexo_2'=>$chk_sexo_2]);
    }

    public function store(\App\Http\Requests\Frontend\CrearCuenta $request){  
        $arr_validacion= [];
        $validation = new Validations;
        $status= 1; $code= 201;
        $post= $request->all();

        
        $id_tipo_persona= $post['id_tipo_persona'];       
        
        $id_sujeto= $post['id_sujeto'];
        $p_registro['id_sujeto']= $id_sujeto;
        $p_registro['id_tipo_persona']= $id_tipo_persona;
        $p_registro['rfc']= strtoupper($post['rfc']);
        $p_registro['telefono']= $post['telefono'];
        $p_registro['email']= $post['correo'];
        if($id_tipo_persona==1){
            //Datos para tabla T_Registro
            $p_registro['razon_social_o_nombre']= strtoupper(trim($post['nombre'].' '.$post['ap_paterno'].' '.$post['ap_materno']));

            //Datos personales
            $p_personal['nombre']= strtoupper(trim($post['nombre']));
            $p_personal['ap_paterno']= strtoupper(trim($post['ap_paterno']));
            $p_personal['ap_materno']= strtoupper(trim($post['ap_materno']));
            $p_personal['curp']= strtoupper(trim($post['curp']));
            $p_personal['rfc']= strtoupper(trim($post['rfc']));
            $p_personal['id_nacionalidad']= $post['id_nacionalidad'];
            $p_personal['sexo']= $post['sexo'];
            $p_personal['telefono']= $post['telefono'];
            $p_personal['correo_electronico']= strtolower(trim($post['correo']));
            $p_personal['id_tipo_identificacion']= $post['id_tipo_identificacion'];
            $p_personal['numero_identificacion']= $post['numero_identificacion'];            
              

        }else{
            //Datos para tabla T_Registro
            $p_registro['razon_social_o_nombre']= strtoupper(trim($post['razon_social_o_nombre']));
        }        
        
        $p_usuario['name']= strtoupper(trim($p_registro['razon_social_o_nombre']));
        $p_usuario['nickname']= $post['nickname'];
        $p_usuario['email']= $post['correo'];
        $claro= trim($post['password']);
        $p_usuario['password']= Hash::make(trim($post['password']));  

        
        $validation->crearCuentaNueva(['nickname'=>$post['nickname'], 'rfc'=>$p_registro['rfc']]);
        if(!$validation->getStatusB()){ 
            try{
                    DB::beginTransaction();   
                            
                        $get_registro= T_Registro::get_rfc(['rfc'=>$p_registro['rfc']])->get();
                                      
                        if(count($get_registro)>0){
                            $d_registro= T_Registro::find($get_registro[0]->id);
                        }else{
                            $d_registro= new T_Registro;
                        }

                        $usuario= new User;

                        if($id_tipo_persona==1){
                            $d_personal= new \App\Http\Models\Backend\D_Personal;                     
                        }

                        if($id_tipo_persona==1){
                            $d_personal->fill($p_personal)->save();
                            $p_registro['id_d_personal']= $d_personal->id;
                        }
                        $d_registro->fill($p_registro)->save();

                        $p_usuario['id_registro']= $d_registro->id;
                        $usuario->fill($p_usuario)->save();
                        $usuario->roles()->sync([8]);
                    DB::commit();  
                                                
                        //Enviar Correo
                        $vdatos=array();
                        $vdatos['name']= $p_registro['razon_social_o_nombre'];
                        $vdatos['nickname']= trim($p_usuario['nickname']);
                        $vdatos['password']= $claro;
                    
                        $datos_correo=array();
                        $datos_correo['asunto']= 'Portal del contratista SHYFP: Registro de cuenta de usuario';
                        $datos_correo['cuerpo']= CorreoPlantillas::creacion_cuenta($vdatos);
                        $datos_correo['correo_destinatario']=[$p_registro['email']];
                        $datos_correo['nombre_destinatario']= $p_registro['razon_social_o_nombre'];        
                        $vstatusCorreo= Correo::sendEmail($datos_correo, 1);

                        $msg= "La cuenta ha sido creada satisfactoriamente, se ha enviado un mensaje de bienvenida con sus datos al correo registrado"; 
                        $route_redirect= route('login');
                        $data= [];
            }
            catch (\Exception $e) {
                $status= 3; $code= 409; $msg= $e->getMessage(); $route_redirect= ""; $data= [];
                DB::rollback();                       
            }
        }
        else
        {
            $status= 3; $code= $validation->getStatusCode(); $msg= $validation->getStatusMsg(); $route_redirect= ""; $data= [];
        }
            
        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$data], $code);        
    }

    public function recuperar_password(\App\Http\Requests\Frontend\RecuperarPass $request){ 
       //busco el correo y el rfc en la tabla registro
        $array=[];
        $array['correo']=$request->input('txtCorreo');
        $array['rfc']=$request->input('txtRfc');
        $datos=T_Registro::buscar_datos_registro($array);

        $status= 1; $code= 201;

        if(!isset($datos->rfc) && !isset($datos->email))
        {
            $msg= "El RFC o el Correo proporcionado no se encuentra registrado.";
            $status= 3; $code= 409;  $route_redirect= ""; $data= [];
        }
        else
        {
            //busco el id de usuario
            $array2=[];
            $array2['id_registro']=$datos->id;
            $usuario=User::general($array2)->first();

            $new_codigo=clsFunciones::generaCodigo();
            //genero el nuevo pass
            $new_pass= Hash::make(trim($new_codigo));
            $post['password']=$new_pass;

            try{
                DB::beginTransaction(); 
                $usuario->fill($post)->save();

               //Enviar correo electrónico
                $vdatos=array();
                $vdatos['name']= $datos->razon_social_o_nombre;
                $vdatos['rfc']= $datos->rfc;
                $vdatos['email']= $datos->email;
                $vdatos['nickname']= $usuario->nickname;
                $vdatos['password']= $new_codigo;
               

                $datos_correo=array();
                $datos_correo['asunto']= 'Contratista/Supervisor SHYFP: Restablecer contraseña';
                $datos_correo['cuerpo']= CorreoPlantillas::recuperar_contrasenia($vdatos);
                $datos_correo['correo_destinatario']=[$datos->email];
                $datos_correo['nombre_destinatario']= $vdatos['name'];       
                $vstatusCorreo= Correo::sendEmail($datos_correo, 1);

                DB::commit();              
                $msg= "Se ha generado una nueva contraseña y enviada a su correo."; 
                $route_redirect= route('login');
                $data= $usuario;   
            }
            catch (\Exception $e) {
                $status= 3; $code= 409; $msg= $e->getMessage(); $route_redirect= ""; $data= [];
                DB::rollback();                       
            }
         
           
        }

        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$data], $code);

    }

}
