<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;


class CombosController extends Controller
{
    private $route='combos';
    public function __construct()
    {
        //  $this->middleware('auth');
    } 

    public function municipios($id_estado){
        $resultados = \App\Http\Models\Catalogos\C_Municipio::lists(["id_estado"=>$id_estado]);
        return $resultados;
    }     

    public function documentacion_t_tramite($id_tipo_tramite, $id_sujeto){
        $resultados = \App\Http\Models\Catalogos\C_Tipo_Tramite::documentacion($id_tipo_tramite, $id_sujeto);
        return $resultados;        
    }

    public function documentacion_t_tramite_requerida($id_tramite){
        $tramite= \App\Http\Models\Backend\T_Tramite::find($id_tramite);
        $registro= \App\Http\Models\Backend\T_Registro::find($tramite->id_cs);
        $id_tipo_tramite= $tramite->id_tipo_tramite;
        $id_sujeto= $registro->id_sujeto;
        $resultados = \App\Http\Models\Catalogos\C_Tipo_Tramite::documentacion_requerida_combo($id_tipo_tramite, $id_sujeto);
        return $resultados;        
    }    

    public function documentacion_tramite_recibida($id_tramite){
        $resultados = \App\Http\Models\Catalogos\C_Tipo_Tramite::documentacion_requerida_t_combo($id_tramite);
        return $resultados;        
    } 

    public function documentacion_tramite_adjunta($id_tramite){
        $resultados = \App\Http\Models\Backend\T_Tramite_Documentacion::documentacion_adjunta($id_tramite);
        return $resultados;        
    }  
    
    public function documentacion_tramite_adjunta_tmp($id_registro){
        $resultados = \App\Http\Models\Backend\T_Tramite_Documentacion::documentacion_adjunta_tmp($id_registro);
        return $resultados;        
    }  
    
    /* Listas Documentación requerida */
    public function lista_documentacion_requerida_legal($id_tipo_tramite, $id_sujeto, $id_registro){
        $id_area_especifica=2;
        $resultados = \App\Http\Models\Catalogos\C_Documentacion::lista_documentacion_requerida($id_tipo_tramite, $id_sujeto, $id_registro, $id_area_especifica);
        return $resultados;        
    }   
    
    public function lista_documentacion_requerida_financiera($id_tipo_tramite, $id_sujeto, $id_registro){
        $id_area_especifica=3;
        $resultados = \App\Http\Models\Catalogos\C_Documentacion::lista_documentacion_requerida($id_tipo_tramite, $id_sujeto, $id_registro, $id_area_especifica);
        return $resultados;        
    } 
    
    /* Listas Documentación requerida */
    public function lista_documentacion_requerida($id_tipo_tramite, $id_registro, $id_area){
        $registro= \App\Http\Models\Backend\T_Registro::find($id_registro);
        $resultados = \App\Http\Models\Catalogos\C_Documentacion::lista_documentacion_requerida($id_tipo_tramite, $registro->id_sujeto, $registro->id, $id_area, $registro->id_tipo_persona);
        return $resultados;        
    }

  public function lista_documentacion_requerida_tecnica($id_tipo_tramite, $id_registro, $tec_acredita_tmp){
        $registro= \App\Http\Models\Backend\T_Registro::find($id_registro);
        if($id_tipo_tramite!=1){ $tec_acredita_tmp=0; }
        
        $resultados = \App\Http\Models\Catalogos\C_Documentacion::lista_documentacion_requerida($id_tipo_tramite, $registro->id_sujeto, $registro->id, 4, $registro->id_tipo_persona, $tec_acredita_tmp);
        return $resultados;        
    }    

    public function get_opcionales_documentos($id_padre){
        $resultados = \App\Http\Models\Catalogos\C_Documentacion::lists_opcionales(["id_padre"=>$id_padre]);
        return $resultados;
    }  
    
    //combo
    public function lista_documentacion_obligatoria($id_tipo_tramite, $id_registro, $id_area, $tec_acredita_tmp){
        $registro= \App\Http\Models\Backend\T_Registro::find($id_registro);
        $id_sujeto= $registro->id_sujeto;
        $id_tipo_persona= $registro->id_tipo_persona;

        if($id_area==4){
            if($id_tipo_tramite!=1){ $tec_acredita_tmp=0; }
        }else{
            $tec_acredita_tmp=0;
        }

        $resultados = \App\Http\Models\Catalogos\C_Documentacion::documentos_obligatorios($id_tipo_tramite, $id_sujeto, $id_tipo_persona, $id_area, $tec_acredita_tmp);
        return $resultados;
    }



    //Nuevo
      /* Listas Documentación descarga */
    public function lista_documentacion_descarga($id_tipo_tramite, $id_tramite, $id_area){
        $tramite= \App\Http\Models\Backend\T_Tramite::find($id_tramite);
        $registro= \App\Http\Models\Backend\T_Registro::find($tramite->id_cs);
        $resultados = \App\Http\Models\Catalogos\C_Documentacion::lista_documentacion_descarga($id_tipo_tramite, $registro->id_sujeto, $id_tramite, $id_area, $registro->id_tipo_persona);
        return $resultados;        
    }

      public function lista_documentacion_descarga_tecnica($id_tipo_tramite, $id_tramite, $tec_acredita_tmp){
        $tramite= \App\Http\Models\Backend\T_Tramite::find($id_tramite);
        $registro= \App\Http\Models\Backend\T_Registro::find($tramite->id_cs);
        if($id_tipo_tramite!=1){ $tec_acredita_tmp=0; }
        
        $resultados = \App\Http\Models\Catalogos\C_Documentacion::lista_documentacion_descarga($id_tipo_tramite, $registro->id_sujeto, $id_tramite, 4, $registro->id_tipo_persona, $tec_acredita_tmp);
        return $resultados;        
    }  

    
       //lista la documetnacion del area financiera
       public function lista_documentacion_requerida_financiera_obligado($id_tipo_tramite, $id_registro, $obligado_dec_isr){
        $registro= \App\Http\Models\Backend\T_Registro::find($id_registro);
        
        $resultados = \App\Http\Models\Catalogos\C_Documentacion::lista_documentacion_requerida($id_tipo_tramite, $registro->id_sujeto, $registro->id, 3, $registro->id_tipo_persona, $obligado_dec_isr);
        return $resultados;        
        }  
        
        
        public function lista_documentacion_requerida_financiera_descarga($id_tipo_tramite, $id_tramite, $obligado_dec_isr){
            $tramite= \App\Http\Models\Backend\T_Tramite::find($id_tramite);
            $registro= \App\Http\Models\Backend\T_Registro::find($tramite->id_cs);
            $resultados = \App\Http\Models\Catalogos\C_Documentacion::lista_documentacion_descarga($id_tipo_tramite, $registro->id_sujeto, $id_tramite, 3, $registro->id_tipo_persona, $obligado_dec_isr);
          
            return $resultados;        
            } 
}