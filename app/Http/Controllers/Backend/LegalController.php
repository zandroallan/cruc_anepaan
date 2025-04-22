<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\T_Tramite_Legal_Generales;
use App\Http\Classes\Validations;
use App\Http\Classes\FormatDate;
use App\Http\Models\Backend\T_Tramite_Dato_Legal;
use App\Http\Models\Backend\T_Tramite;
use App\Http\Models\Backend\T_Registro;
use App\Http\Requests\Backend\T_Tramite_Legal_Acta_Constitutiva;
use App\Http\Models\Backend\T_Tramite_Acta_Instrumento;
use App\Http\Models\Backend\T_Tramite_Acta_Instrumento_Modificacion;
use App\Http\Requests\Backend\T_Tramite_Legal_Representante_Legal;
use App\Http\Models\Backend\T_Tramite_Rep_Legal;
use App\Http\Models\Backend\D_Domicilio;
use App\Http\Models\Backend\D_Personal;
use App\Http\Models\Catalogos\C_Estado;
use App\Http\Models\Catalogos\C_Nacionalidad;
use App\Http\Models\Catalogos\C_Tipo_Identificacion;
use App\Http\Models\Catalogos\C_Tipo_Rep_Legal;
use App\Http\Models\Backend\T_Tramite_Socio_Legal;
use App\Http\Requests\Backend\T_Tramite_Legal_Socio_Legal;
use App\Http\Models\Backend\T_Tramite_Certificado;
use App\Http\Requests\Backend\Pago;
use Carbon\Carbon;
use Auth;
use DB;
use Hash;
use Str;

class LegalController extends Controller
{
    private $route_coordinador='tramites-area-legal';
    private $title_dinamic= 'Trámites';
    public function __construct() {
        $this->middleware('auth');
        view()->share('title', $this->title_dinamic);
        view()->share('current_route', $this->route_coordinador);       
    }   

    public function store_datos_legales(T_Tramite_Legal_Generales $request)
    {        
        $arr_validacion= [];
        $validation = new Validations;
        $status= 1; $code= 201;
        $post= $request->all();

        isset($post['dlg_id']) ? $id= $post['dlg_id'] : $id= 0;        
        $p_dlg['id_tramite']=0; 
        $p_dlg['id_registro_tmp']=Auth::user()->id_registro; 

        $p_dlg['imss']= $post['dlg_imss'];
        $p_dlg['boleta_pago']= $post['dlg_boleta_pago'];
        $p_dlg['fecha_pago']= $post['dlg_fecha_pago'];
        $p_dlg['fecha_inicio']= $post['dlg_fecha_inicio'];
        $p_dlg['fecha_inscripcion']= $post['dlg_fecha_inscripcion'];
        $p_dlg['actividad']= $post['dlg_actividad'];
        $p_dlg['rec']= $post['dlg_rec'];
        $p_dlg['num_constancia']= $post['dlg_num_constancia'];     
        $p_dlg['num_control']= $post['dlg_num_control']; 
        $p_dlg['vigencia_de']= $post['dlg_vigencia_de']; 
        $p_dlg['vigencia_al']= $post['dlg_vigencia_al'];  

        $validation->datosLegalesNuevo(['id'=> $id, 'id_registro_tmp'=>$p_dlg['id_registro_tmp']], $id);
        if(!$validation->getStatusB()) { 
            try{
                DB::beginTransaction();
                if($id==0) 
                    $t_datos_legales= new T_Tramite_Dato_Legal;
                else 
                    $t_datos_legales= T_Tramite_Dato_Legal::find($id);
                
                $t_datos_legales->fill($p_dlg)->save();
                DB::commit();                
                
                if( $id == 0 ) {
                    $msg= "Los datos legales han sido registrados"; 
                    $route_redirect= "";
                }
                else {
                    $msg= "Los datos legales han sido actualizados"; 
                    $route_redirect= "";
                }    
                $data=$t_datos_legales;
            }
            catch (\Exception $e) {
                $status= 3; $code= 409; $msg= $e->getMessage(); $route_redirect= ""; $data= [];
                DB::rollback();                       
            }
        }
        else {
            $status= 3; $code= $validation->getStatusCode(); $msg= $validation->getStatusMsg(); $route_redirect= ""; $data= [];
        }
        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$data], $code);
    }

    public function store_acta_constitutiva(T_Tramite_Legal_Acta_Constitutiva $request)
    {     
        $arr_validacion= [];
        $validation = new Validations;
        $status= 1; $code= 201;
        $post= $request->all();
        $route_redirect= "";

        isset($post['dlac_id']) ? $id= $post['dlac_id'] : $id= 0;        
        $p_dlg['id_tramite']=0;
        $p_dlg['id_registro_tmp']=Auth::user()->id_registro;
        $p_dlg['id_tipo_acta_instrumento']= 1;
        $p_dlg['num_escritura']= $post['dlac_num_escritura'];
        $p_dlg['fecha_escritura']= $post['dlac_fecha_escritura'];
        $p_dlg['notario_nombre']= $post['dlac_notario_nombre'];
        $p_dlg['notario_numero']= $post['dlac_notario_numero'];
        $p_dlg['id_estado']= $post['dlac_id_estado'];
        $p_dlg['num_registro_publico']= $post['dlac_num_registro_publico'];
        $p_dlg['seccion']= $post['dlac_seccion'];
        $p_dlg['ciudad']= $post['dlac_ciudad'];
        $p_dlg['fecha_registro_publico']= $post['dlac_fecha_registro_publico']; 
        $p_dlg['id_estado_registro']= $post['dlac_id_estado_registro'];

        //modificacion al acta
        isset($post['dlac_id_m']) ? $id_m= $post['dlac_id_m'] : $id_m= 0;     
        $p_modif_acta['id_tramite']=0;
        $p_modif_acta['id_registro_tmp']= Auth::user()->id_registro;
        $p_modif_acta['id_tipo_acta_instrumento']= 1;
        $p_modif_acta['num_escritura']= $post['dlac_num_escritura_m'];
        $p_modif_acta['fecha_escritura']= $post['dlac_fecha_escritura_m'];
        $p_modif_acta['notario_nombre']= $post['dlac_notario_nombre_m'];
        $p_modif_acta['notario_numero']= $post['dlac_notario_numero_m'];
        $p_modif_acta['id_estado']= $post['dlac_id_estado_m'];
        $p_modif_acta['num_registro_publico']= $post['dlac_num_registro_publico_m'];
        $p_modif_acta['seccion']= $post['dlac_seccion_m'];
        $p_modif_acta['ciudad']= $post['dlac_ciudad_m'];
        $p_modif_acta['fecha_registro_publico']= $post['dlac_fecha_registro_publico_m']; 
        $p_modif_acta['id_estado_registro']= $post['dlac_id_estado_registro_m'];  

        $validation->actaConstitutivaNuevo(['id'=> $id, 'id_registro_tmp'=>$p_dlg['id_registro_tmp'], 'id_tipo_acta_instrumento'=>$p_dlg['id_tipo_acta_instrumento']]);
        if(!$validation->getStatusB()){ 
            try {
                DB::beginTransaction();
                ($id==0) ? $t_datos_legales= new T_Tramite_Acta_Instrumento : $t_datos_legales= T_Tramite_Acta_Instrumento::find($id);
                $t_datos_legales->fill($p_dlg)->save();

                if(isset($post['dlac_num_escritura_m'])) {
                   ($id_m==0) ? $t_datos_legales_modifica = new T_Tramite_Acta_Instrumento_Modificacion : $t_datos_legales_modifica= T_Tramite_Acta_Instrumento_Modificacion::find($id_m);
                    $t_datos_legales_modifica->fill($p_modif_acta)->save(); 
                }                

                DB::commit();
                if($id==0)
                    $msg= "El acta constitutiva ha sido registrada";
                else 
                    $msg= "El acta constitutiva ha sido actualizada"; 
                $data= $t_datos_legales;
            }
            catch (\Exception $e) {
                $status= 3; $code= 409; $msg= $e->getMessage(); $route_redirect=""; $data= [];
                DB::rollback();                       
            }
        }
        else {
            $status= 3; $code= $validation->getStatusCode(); $msg= $validation->getStatusMsg(); $route_redirect= ""; $data= [];
        }
        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$data], $code);
    }

    public function store_representante_legal(T_Tramite_Legal_Representante_Legal $request)
    {        
        $arr_validacion= [];
        $validation = new Validations;
        $status= 1; $code= 201;
        $post= $request->all();

        isset($post['dlrepl_id']) ? $id= $post['dlrepl_id'] : $id= 0; 
        
        //Datos personales
        $p_personal['nombre']= $post['dlrepl_nombre'];
        $p_personal['ap_paterno']= $post['dlrepl_ap_paterno'];
        $p_personal['ap_materno']= $post['dlrepl_ap_materno'];
        $p_personal['curp']= $post['dlrepl_curp'];
        $p_personal['rfc']= $post['dlrepl_rfc'];
        $p_personal['id_nacionalidad']= $post['dlrepl_id_nacionalidad'];
        $p_personal['sexo']= $post['dlrepl_sexo'];
        $p_personal['telefono']= $post['dlrepl_telefono'];
        $p_personal['correo_electronico']= $post['dlrepl_correo_electronico'];
        $p_personal['id_tipo_identificacion']= $post['dlrepl_id_tipo_identificacion'];
        $p_personal['numero_identificacion']= $post['dlrepl_numero_identificacion'];

        //Datos para D_Domicilio particular
        $p_domicilio_particular['id_tipo_domicilio']= 1;
        $p_domicilio_particular['id_municipio']= $post['dlrepl_id_municipio_particular'];
        $p_domicilio_particular['ciudad']= $post['dlrepl_ciudad_particular'];
        $p_domicilio_particular['codigo_postal']= $post['dlrepl_cp_particular'];
        $p_domicilio_particular['calle']= $post['dlrepl_calle_particular'];
        $p_domicilio_particular['num_exterior']= $post['dlrepl_ext_particular'];
        $p_domicilio_particular['num_interior']= $post['dlrepl_int_particular'];
        $p_domicilio_particular['colonia']= $post['dlrepl_colonia_particular'];
        $p_domicilio_particular['referencias']= $post['dlrepl_referencias_particular'];        
        
        //Datos instrumento legal        
        $p_instrumento['id_tramite']=0; 
        $p_instrumento['id_tipo_acta_instrumento']= 2;
        $p_instrumento['num_escritura']= $post['dlrepl_num_escritura'];
        $p_instrumento['fecha_escritura']= $post['dlrepl_fecha_escritura'];
        $p_instrumento['notario_nombre']= $post['dlrepl_notario_nombre'];
        $p_instrumento['notario_numero']= $post['dlrepl_notario_numero'];
        $p_instrumento['id_estado']= $post['dlrepl_id_estado'];
        $p_instrumento['num_registro_publico']= $post['dlrepl_num_registro_publico'];
        $p_instrumento['seccion']= $post['dlrepl_seccion'];
        $p_instrumento['ciudad']= $post['dlrepl_ciudad'];
        $p_instrumento['fecha_registro_publico']= $post['dlrepl_fecha_registro_publico']; 
        $p_instrumento['id_estado_registro']= $post['dlrepl_id_estado_registro'];  

        //Datos representante legal
        $p_rep_legal['id_tramite']=0; 
        $p_rep_legal['id_registro_tmp']=Auth::User()->id_registro;
        $p_rep_legal['id_tipo_rep_legal']= $post['dlrepl_id_tipo_rep_legal'];

        if($id==0) {
           $validation->repLegalNuevo(['id'=> $id, 'id_registro_tmp'=>$p_rep_legal['id_registro_tmp']]);
        }
        else {
            $validation->repLegalUpdate();
        }
        
        if(!$validation->getStatusB()) { 
            try {
                DB::beginTransaction();
                if($id==0) {
                    $t_rep_legal= new T_Tramite_Rep_Legal;
                    $t_acta_instrumento= new T_Tramite_Acta_Instrumento;
                    $d_personal= new D_Personal;
                    $d_domicilio_particular= new D_Domicilio;                     
                }
                else {
                    $t_rep_legal= T_Tramite_Rep_Legal::find($id);
                    $t_acta_instrumento= T_Tramite_Acta_Instrumento::find($t_rep_legal->id_acta_instrumento);
                    $d_personal= D_Personal::find($t_rep_legal->id_d_personal);
                    $d_domicilio_particular= D_Domicilio::find($d_personal->id_d_domicilio); 
                }
                $d_domicilio_particular->fill($p_domicilio_particular)->save();
                
                $p_personal['id_d_domicilio']= $d_domicilio_particular->id;
                $d_personal->fill($p_personal)->save();

                $p_rep_legal['id_d_personal']= $d_personal->id;
                $t_acta_instrumento->fill($p_instrumento)->save();
                $p_rep_legal['id_acta_instrumento']= $t_acta_instrumento->id;
                $t_rep_legal->fill($p_rep_legal)->save();
                DB::commit();
                
                if( $id == 0 ) {
                    $msg= "El representante legal ha sido registrado"; 
                    $route_redirect= "";
                }
                else {
                    $msg= "El  representante legal ha sido actualizado"; 
                    $route_redirect= "";
                } 
                $data= $t_rep_legal;
            }
            catch (\Exception $e) {
                $status= 3; $code= 409; $msg= $e->getMessage(); $route_redirect= ""; $data= [];
                DB::rollback();                       
            }
        }
        else {
            $status= 3; $code= $validation->getStatusCode(); $msg= $validation->getStatusMsg(); $route_redirect= ""; $data= [];
        }
        return response()->json(['status'=>$status, 'code'=>$code, 'msg'=>$msg, 'route_redirect'=>$route_redirect, 'data'=>$data], $code);
    }

    # DATOS Generales
    public function get_datos_legales($id_registro_tmp)
    {
        $t_tramites_datos_legales= T_Tramite_Dato_Legal::edit($id_registro_tmp);
        if(!$t_tramites_datos_legales) {
            $t_tramites_datos_legales["id"]= 0;            
            $t_tramites_datos_legales["id_registro_tmp"]= $id_registro_tmp;
            $t_tramites_datos_legales["imss"]= "";
            $t_tramites_datos_legales["boleta_pago"]= "";
            $t_tramites_datos_legales["fecha_pago"]= "";
            $t_tramites_datos_legales["fecha_inicio"]= "";
            $t_tramites_datos_legales["fecha_inscripcion"]= "";
            $t_tramites_datos_legales["actividad"]= "";
            $t_tramites_datos_legales["rec"]= "";
            $t_tramites_datos_legales["num_constancia"]= "";
            $t_tramites_datos_legales["num_control"]= "";
            $t_tramites_datos_legales["vigencia_de"]= "";
            $t_tramites_datos_legales["vigencia_al"]= "";
            $t_tramites_datos_legales= (object)$t_tramites_datos_legales;
        }
        else {
            //$t_tramites_datos_legales["fecha_pago"]= FormatDate::formatDates($t_tramites_datos_legales["fecha_pago"], 1);
            //$t_tramites_datos_legales["fecha_inicio"]= FormatDate::formatDates($t_tramites_datos_legales["fecha_inicio"], 1);
            //$t_tramites_datos_legales["fecha_inscripcion"]= FormatDate::formatDates($t_tramites_datos_legales["fecha_inscripcion"], 1);   
            //$t_tramites_datos_legales["rec"]= FormatDate::formatDates($t_tramites_datos_legales["rec"], 1);              
            //$t_tramites_datos_legales["vigencia_de"]= FormatDate::formatDates($t_tramites_datos_legales["vigencia_de"], 1);
            //$t_tramites_datos_legales["vigencia_al"]= FormatDate::formatDates($t_tramites_datos_legales["vigencia_al"], 1);              
            $t_tramites_datos_legales["fecha_pago"]= $t_tramites_datos_legales["fecha_pago"];
            $t_tramites_datos_legales["fecha_inicio"]= $t_tramites_datos_legales["fecha_inicio"];
            $t_tramites_datos_legales["fecha_inscripcion"]= $t_tramites_datos_legales["fecha_inscripcion"];            
            $t_tramites_datos_legales["rec"]= $t_tramites_datos_legales["rec"]; 
            $t_tramites_datos_legales["vigencia_de"]= $t_tramites_datos_legales["vigencia_de"];
            $t_tramites_datos_legales["vigencia_al"]= $t_tramites_datos_legales["vigencia_al"];
        }

        $t_tramites_datos_legales= $t_tramites_datos_legales;
        return response()->json($t_tramites_datos_legales);
    }

    # DATOS Acta Constitutiva
    public function get_acta_constitutiva($id_registro_tmp)
    {
        $t_tramites_actas_instrumentos= T_Tramite_Acta_Instrumento::edit(Auth::User()->id_registro, 1);
        if(!$t_tramites_actas_instrumentos) {
            $t_tramites_actas_instrumentos["id"]= 0;            
            $t_tramites_actas_instrumentos["id_registro_tmp"]=Auth::User()->id_registro;
            $t_tramites_actas_instrumentos["id_tipo_acta_instrumento"]= 0;
            $t_tramites_actas_instrumentos["num_escritura"]= "";
            $t_tramites_actas_instrumentos["fecha_escritura"]= "";
            $t_tramites_actas_instrumentos["notario_nombre"]= "";
            $t_tramites_actas_instrumentos["notario_numero"]= "";
            $t_tramites_actas_instrumentos["id_estado"]= 0;
            $t_tramites_actas_instrumentos["num_registro_publico"]= "";
            $t_tramites_actas_instrumentos["seccion"]= "";
            $t_tramites_actas_instrumentos["ciudad"]= "";
            $t_tramites_actas_instrumentos["fecha_registro_publico"]= "";
            $t_tramites_actas_instrumentos["id_estado_registro"]= 0;
            $t_tramites_actas_instrumentos=(object)$t_tramites_actas_instrumentos;
        } 
        else {
            $t_tramites_actas_instrumentos["fecha_escritura"]= $t_tramites_actas_instrumentos["fecha_escritura"];
            $t_tramites_actas_instrumentos["fecha_registro_publico"]= $t_tramites_actas_instrumentos["fecha_registro_publico"];
        }
        $t_tramites_actas_instrumentos= $t_tramites_actas_instrumentos;
        return response()->json($t_tramites_actas_instrumentos);
    }

    # DATOS Acta Constitutiva Modificacion
    public function get_acta_constitutiva_modificacion($id_registro_tmp){
        $t_tramites_actas_instrumentos= T_Tramite_Acta_Instrumento_Modificacion::edit($id_registro_tmp, 1);
        if(!$t_tramites_actas_instrumentos) {
            $t_tramites_actas_instrumentos["id"]= 0;
            $t_tramites_actas_instrumentos["id_registro_tmp"]= Auth::User()->id_registro;            
            $t_tramites_actas_instrumentos["id_tipo_acta_instrumento"]= 0;
            $t_tramites_actas_instrumentos["num_escritura"]= "";
            $t_tramites_actas_instrumentos["fecha_escritura"]= "";
            $t_tramites_actas_instrumentos["notario_nombre"]= "";
            $t_tramites_actas_instrumentos["notario_numero"]= "";
            $t_tramites_actas_instrumentos["id_estado"]= 0;
            $t_tramites_actas_instrumentos["num_registro_publico"]= "";
            $t_tramites_actas_instrumentos["seccion"]= "";
            $t_tramites_actas_instrumentos["ciudad"]= "";
            $t_tramites_actas_instrumentos["fecha_registro_publico"]= "";
            $t_tramites_actas_instrumentos["id_estado_registro"]= 0;
            $t_tramites_actas_instrumentos= (object)$t_tramites_actas_instrumentos;
        } 
        else {
            $t_tramites_actas_instrumentos["fecha_escritura"]= $t_tramites_actas_instrumentos["fecha_escritura"];
            $t_tramites_actas_instrumentos["fecha_registro_publico"]= $t_tramites_actas_instrumentos["fecha_registro_publico"];
        }
        $t_tramites_actas_instrumentos= $t_tramites_actas_instrumentos;
        return response()->json($t_tramites_actas_instrumentos);
    }

    public function get_representante_legal($id_registro_tmp)
    {
        $t_tramites_rep_legales= T_Tramite_Rep_Legal::edit($id_registro_tmp);
        
        if(!$t_tramites_rep_legales) {
            $t_tramites_rep_legales["id"]=0;
            $t_tramites_rep_legales["id_tramite"]=0;
            $t_tramites_rep_legales["id_registro_tmp"]=$id_registro_tmp;
            $t_tramites_rep_legales["id_d_personal"]=0;
            $t_tramites_rep_legales["id_tipo_rep_legal"]=0;
            $t_tramites_rep_legales["id_acta_instrumento"]=0;
            $t_tramites_rep_legales["num_escritura"]="";
            $t_tramites_rep_legales["fecha_escritura"]="";
            $t_tramites_rep_legales["notario_nombre"]="";
            $t_tramites_rep_legales["notario_numero"]="";
            $t_tramites_rep_legales["id_estado"]=0;
            $t_tramites_rep_legales["num_registro_publico"]="";
            $t_tramites_rep_legales["seccion"]="";
            $t_tramites_rep_legales["ciudad"]="";
            $t_tramites_rep_legales["fecha_registro_publico"]="";
            $t_tramites_rep_legales["id_estado_registro"]=0;
            $t_tramites_rep_legales= (object)$t_tramites_rep_legales;
        } 
        else {
            $t_tramites_rep_legales["fecha_escritura"]= $t_tramites_rep_legales["fecha_escritura"];
            $t_tramites_rep_legales["fecha_registro_publico"]= $t_tramites_rep_legales["fecha_registro_publico"];             
        }
        $t_tramites_rep_legales= $t_tramites_rep_legales;
        return response()->json($t_tramites_rep_legales);
    }

    public function destroy_socios_legales($id)
    {        
        $d_registro = T_Tramite_Socio_Legal::find($id);
        $id_tramite= $d_registro->id_tramite;
        try {  
            DB::beginTransaction();
            $d_registro->delete();                        
            DB::commit();
        }
        catch (\Exception $e) {            
            $error = $e->getMessage();
            DB::rollback();
            $message= ['errors'=>$error, 'id_tramite'=>$id_tramite];
            return response()->json($message, 409);
        }
        $message= ['success'=>'Los datos han sido <b>eliminados</b>.','id_tramite'=>$id_tramite];
        return response()->json($message, 201);
    }

    public function resultados_socios_legales($id_registro_tmp)
    {
        $resultados = T_Tramite_Socio_Legal::general(['id_registro_tmp'=>$id_registro_tmp])->get();
        return $resultados;
    }

    public function get_socio_legal($id)
    {
        $t_tramites_socios_legales= T_Tramite_Socio_Legal::edit($id);
        
        if(!$t_tramites_socios_legales) {           
            $t_tramites_socios_legales["id"]= 0;
            $t_tramites_socios_legales["id_d_personal"]= 0;
            $t_tramites_socios_legales["nombre"]= "";
            $t_tramites_socios_legales["ap_paterno"]= "";
            $t_tramites_socios_legales["ap_materno"]= "";
            $t_tramites_socios_legales["curp"]= "";
            $t_tramites_socios_legales["rfc"]= "";
            $t_tramites_socios_legales["id_nacionalidad"]= 0;
            $t_tramites_socios_legales["telefono"]= "";
            $t_tramites_socios_legales["correo_electronico"]= "";
            $t_tramites_socios_legales["id_tipo_identificacion"]= 0;
            $t_tramites_socios_legales["numero_identificacion"]= "";

            $t_tramites_socios_legales["id_estado_particular"]= 0;
            $t_tramites_socios_legales["id_municipio_particular"]= 0;
            $t_tramites_socios_legales["ciudad_particular"]= "";
            $t_tramites_socios_legales["cp_particular"]= "";
            $t_tramites_socios_legales["calle_particular"]= "";
            $t_tramites_socios_legales["ext_particular"]= "";
            $t_tramites_socios_legales["int_particular"]= "";
            $t_tramites_socios_legales["colonia_particular"]= "";
            $t_tramites_socios_legales["referencias_particular"]= "";
            $t_tramites_socios_legales= (object)$t_tramites_socios_legales;
        }
        $t_tramites_socios_legales= $t_tramites_socios_legales;        
        return response()->json($t_tramites_socios_legales);
    }
}
