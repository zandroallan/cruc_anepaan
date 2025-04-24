<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class T_Tramite extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_tramites';
    protected $fillable = [
        'id', 
        'folio', 
        'id_cs', 
        'id_tipo_tramite', 
        'id_status', 
        'id_status_area_tecnica', 
        'id_status_area_legal', 
        'id_status_area_financiera',
        'certificado',
        'fecha_inicio',
        'fecha_fin',
        'especialidades_tecnicas',
        'documentacion_recibida',
        'documentacion_pendiente',
        'documentacion_revisada',
        'documentacion_no_revisada',
        'documentacion_observaciones',
        'folio_virtual',
        'id_d_domicilio_fiscal',
        'telefono',
        'email',
        'id_r_area_legal',
        'id_r_area_tecnica',
        'id_r_area_financiera',
        'fecha_solventacion',
		'id_c_tramites_seguimiento',
        'id_sujeto_tramite',
        'terminos',
        'cita_agendada'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function datos_buscador($data=[])
      {
        $result=T_Tramite::select(           
            't_tramites.id', 
            't_tramites.folio', 
            't_tramites.folio_pago', 
            't_tramites.forma_valorada', 
            't_tramites.fecha_certificado', 
            't_tramites.coordinador', 
            't_tramites.fecha_inicio', 
            't_tramites.fecha_fin', 
            'r.razon_social_o_nombre as razon_social', 
            'r.id_tipo_persona', 
            'r.rfc',
            'tt.nombre as tipo_tramite',
            'r.email'
        );

        $result= $result->join('t_registro as r', 'r.id', '=', 't_tramites.id_cs');
        $result= $result->leftJoin('c_tipos_tramite as tt', 'tt.id', '=', 't_tramites.id_tipo_tramite');

        if(array_key_exists('folio', $data)){
            $filtro= $data["folio"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites.folio', $filtro);
            });
        }

        if(array_key_exists('id_tramite', $data)){
            $filtro= $data["id_tramite"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites.id', $filtro);
            });
        }
        

        return $result;
     }


     public static function buscador_tramites_terminados($data=[])
      {
        $result=T_Tramite::select(           
            't_tramites.id', 
            't_tramites.folio', 
            't_tramites.folio_pago', 
            't_tramites.forma_valorada', 
            't_tramites.fecha_certificado', 
            't_tramites.coordinador', 
            't_tramites.fecha_inicio', 
            't_tramites.fecha_fin', 
            'r.razon_social_o_nombre as razon_social', 
            'r.id_tipo_persona', 
            'r.rfc',
            'tt.nombre as tipo_tramite',
            'r.email'
        );

        $result= $result->join('t_registro as r', 'r.id', '=', 't_tramites.id_cs');
        $result= $result->leftJoin('c_tipos_tramite as tt', 'tt.id', '=', 't_tramites.id_tipo_tramite');

        if(array_key_exists('folio', $data)){
            $filtro= $data["folio"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites.folio', $filtro);
            });
        }

        if(array_key_exists('id_tramite', $data)){
            $filtro= $data["id_tramite"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites.id', $filtro);
            });
        }
        
        $result= $result->where('t_tramites.id_status', 1)->whereNull('t_tramites.deleted_at');

        return $result;
     }

     public static function datos_validacion($folio){
        $result=T_Tramite::select(           
            't_tramites.folio', 
            't_tramites.folio_pago', 
            't_tramites.forma_valorada', 
            't_tramites.fecha_certificado', 
            't_tramites.coordinador', 
            't_tramites.fecha_inicio', 
            't_tramites.fecha_fin', 
            'r.razon_social_o_nombre as razon_social', 
            'r.id_tipo_persona', 
            'r.rfc',
            'tt.nombre as tipo_tramite',
            't_tramites.id'
        );

        $result= $result->join('t_registro as r', 'r.id', '=', 't_tramites.id_cs');
        $result= $result->leftJoin('c_tipos_tramite as tt', 'tt.id', '=', 't_tramites.id_tipo_tramite');

        $result=$result->where('t_tramites.folio', '=', $folio);
        return $result;
    }
    
    public static function datos_certificado_v($data=[]){
        $result=T_Tramite::select(           
            't_tramites.folio', 
            't_tramites.folio_pago', 
            't_tramites.forma_valorada', 
            't_tramites.fecha_certificado', 
            't_tramites.coordinador', 
            't_tramites.fecha_inicio', 
            't_tramites.fecha_fin', 
            'r.razon_social_o_nombre as razon_social', 
            'r.id_tipo_persona', 
            'r.rfc',
            'tt.nombre as tipo_tramite',
            't_tramites.id'
        );

        $result= $result->join('t_registro as r', 'r.id', '=', 't_tramites.id_cs');
        $result= $result->leftJoin('c_tipos_tramite as tt', 'tt.id', '=', 't_tramites.id_tipo_tramite');

        if(array_key_exists('folio', $data)){
            $filtro= $data["folio"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_tramites.folio',$filtro);
                });
        }

        if(array_key_exists('rfc', $data)){
            $filtro= $data["rfc"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('r.rfc',$filtro);
                });
        }

        $result=$result->whereNull('t_tramites.deleted_at');
        return $result;
    }
    

    public static function consulta_portal($data=[])
     {
        $result=T_Tramite::select(
            't_tramites.id as id_tramite',
            'r.id_tipo_persona',
            't_tramites.folio', 
            DB::raw("CASE r.id_tipo_persona 
             WHEN 1 THEN 'Física' 
             WHEN 2 THEN 'Moral' 
             ELSE 'Desconocido' 
            END as tipo_persona"),

            'r.razon_social_o_nombre',
            DB::raw('concat_ws(" ", persona.nombre, persona.ap_paterno, persona.ap_materno) as nombre_representante_legal'),
            'r.rfc',
            'tt.nombre as tipo_tramite',
            't_tramites.especialidades_tecnicas as esp_contratista', 
            'rt.especialidades as esp_rtec',
            DB::raw('concat_ws(" ", dom_fiscal.calle, " Ext. ", dom_fiscal.num_exterior, " Int. ", dom_fiscal.num_interior, " Col. ", dom_fiscal.colonia,", ", mun_fiscal.nombre) as domicilio_fiscal')
        );

        $result=$result->leftJoin('t_registro as r', 't_tramites.id_cs', '=', 'r.id');
        $result=$result->leftJoin('t_tramites_rep_legales as rl', 'rl.id_tramite', '=', 't_tramites.id');
        $result=$result->leftJoin('t_tramites_rep_tecnicos as rt', 'rt.id_tramite', '=', 't_tramites.id');
        $result=$result->leftJoin('d_personales as persona', 'rl.id_d_personal', '=', 'persona.id');
        $result=$result->leftJoin('c_tipos_tramite as tt', 't_tramites.id_tipo_tramite', '=', 'tt.id');
        $result=$result->leftJoin('d_domicilios as dom_fiscal', 'r.id_d_domicilio_fiscal', '=', 'dom_fiscal.id');
        $result=$result->leftJoin('c_municipios as mun_fiscal', 'dom_fiscal.id_municipio', '=', 'mun_fiscal.id');
        $result=$result->where('t_tramites.id_status', '=', 1);
        $result=$result->whereNull('rt.deleted_at');

        if(array_key_exists('anio', $data)){
            $filtro= $data["anio"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->whereRaw('YEAR(t_tramites.fecha_inicio)='.$filtro);
                });
        }

        if(array_key_exists('id_tramite', $data)){
            $filtro= $data["id_tramite"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_tramites.id',$filtro);
                });
        }

        $result=$result->whereNull('t_tramites.deleted_at');
        $result=$result->whereNotNull('t_tramites.fecha_certificado');
        $result=$result->groupBy('t_tramites.folio');
        //$result=$result->get();

        return $result;
     }

    public static function rep_tecnicos_consulta_portal($id_tramite)
     {
         $result=T_Tramite::select(            
            DB::raw('concat_ws(" ", persona.nombre, persona.ap_paterno, persona.ap_materno) as rep_tecnico'),
            'rtec.especialidades as especialidades_rtec'
        );
        
        $result=$result->leftJoin('t_tramites_rep_tecnicos as rtec', 'rtec.id_tramite', '=', 't_tramites.id');
        $result=$result->leftJoin('d_personales as persona', 'rtec.id_d_personal', '=', 'persona.id');      

       
        $result=$result->where('t_tramites.id', $id_tramite);
        //$result=$result->get();

        return $result;
     }
    
    public static function tramitesCitas()
     {
        $result=T_Tramite::select(
            't_tramites.id as id_tramite', 
            't_registro.id as id_registro',
            't_tramites.folio',         
            't_tramites.id_tipo_tramite',
            't_registro.razon_social_o_nombre',
            't_registro.rfc',
            't_registro.email',            
            't_citas.fecha_cita',
            't_citas.horario_texto'
        );
        
        $result=$result->join('t_registro', 't_tramites.id_cs', '=', 't_registro.id');
        $result=$result->join('t_citas', 't_citas.id_tramite', '=', 't_tramites.id');        

        $result=$result->where('t_citas.id', '>=', 1302);
        $result=$result->where('t_citas.id', '<=', 1303);
        $result=$result->whereNull('t_citas.deleted_at');  
        return $result;
     }
    
    public static function totalTramitesDia()
     {
        // Sandro Alan
        // Retorna el total de tramites por día
        
        return T_Tramite::select('id', 'folio', 'created_at')->whereDate('created_at', date('Y-m-d'))->get();
     }

    public static function total_anio($anio, $id_sujeto)
     {
        $result = T_Tramite::select('t_tramites.*')
						->leftJoin('t_registro as r', 'r.id', '=', 't_tramites.id_cs')
						->where('r.id_sujeto', $id_sujeto )
						->whereRaw('YEAR(t_tramites.created_at)='.$anio)
						->withTrashed();
        $result= $result->count();
        return $result;
     }

    public static function tramites($data=[])
     {
        $result = T_Tramite::select(
            't_tramites.id',
            't_tramites.folio', 
            't_tramites.id_tipo_tramite', 
            't_tramites.id_c_tramites_seguimiento',
            't_tramites.fecha_inicio', 
            't_tramites.fecha_fin',
            'r.id_sujeto', 
            'r.razon_social_o_nombre as razon_social',
            'r.id_tipo_persona', 
            'r.rfc',
            'tt.nombre as tipo_tramite',
            's.id as id_status',
            's.nombre as status',
            's.color as status_color',
            'sl.nombre as status_l',
            'sl.color as status_color_l',
            'sf.nombre as status_f',
            'sf.color as status_color_f',
            'st.nombre as status_t',
            'st.color as status_color_t',
            't_tramites.id_sujeto_tramite',
            'tc.motivo as motivo_cancelado',
            'tc.path',
            'tc.acuse'
        );
        $result= $result->leftJoin('t_tramites_cancelados as tc', 'tc.id_tramite', '=', 't_tramites.id');
        $result= $result->leftJoin('t_registro as r', 'r.id', '=', 't_tramites.id_cs');
        $result= $result->leftJoin('c_tipos_tramite as tt', 'tt.id', '=', 't_tramites.id_tipo_tramite');
        $result= $result->leftJoin('c_status as s', 's.id', '=', 't_tramites.id_status');
        $result= $result->leftJoin('c_status as sl', 'sl.id', '=', 't_tramites.id_status_area_legal');
        $result= $result->leftJoin('c_status as sf', 'sf.id', '=', 't_tramites.id_status_area_financiera');
        $result= $result->leftJoin('c_status as st', 'st.id', '=', 't_tramites.id_status_area_tecnica');

        if(array_key_exists('id_cs', $data)){
            $filtro= $data["id_cs"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('id_cs', $filtro);
            });
        }  
        if(array_key_exists('anio', $data)){
            $filtro= $data["anio"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->whereRaw('YEAR(t_tramites.created_at)='.$filtro);
            });
        }
        if(array_key_exists('i_search', $data)){
            $filtro= $data["i_search"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('r.razon_social_o_nombre','like', '%'.$filtro.'%')->orWhere('r.rfc','like', '%'.$filtro.'%');
            });
        }
        if(array_key_exists('rfc', $data)){
            $filtro= $data["rfc"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('r.rfc','=',$filtro);
            });
        }
        if(array_key_exists('razon_social_o_nombre', $data)){
            $filtro= $data["razon_social_o_nombre"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('r.razon_social_o_nombre','=',$filtro);
            });
        }

        $result= $result->groupBy('t_tramites.id');
        $result= $result->orderBy('t_tramites.id','DESC');
        return $result;
     }   
    
    public static function general($data=[])
     {
        $result = T_Tramite::select('r.id', 'r.id_sujeto', 'r.razon_social_o_nombre as razon_social', 'r.id_tipo_persona', 'r.rfc', 't_tramites.created_at as fecha_registro', DB::raw('YEAR(t_tramites.created_at) as anio'), 't_tramites.fecha_inicio', 't_tramites.fecha_fin', 'tt.nombre as tipo_tramite', 's.nombre as status', 's.color as status_color', 't_tramites.folio');

        $result= $result->leftJoin('t_registro as r', 'r.id', '=', 't_tramites.id_cs');
        $result= $result->leftJoin('c_tipos_tramite as tt', 'tt.id', '=', 't_tramites.id_tipo_tramite');
        $result= $result->leftJoin('c_status as s', 's.id', '=', 't_tramites.id_status');
        $result= $result->leftJoin('c_status as sl', 'sl.id', '=', 't_tramites.id_status_area_legal');
        $result= $result->leftJoin('c_status as sf', 'sf.id', '=', 't_tramites.id_status_area_financiera');
        $result= $result->leftJoin('c_status as st', 'st.id', '=', 't_tramites.id_status_area_tecnica');


        if(array_key_exists('id_cs', $data)){
            $filtro= $data["id_cs"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('id_cs', $filtro);
                });
        }  
        
        if(array_key_exists('anio', $data)){
            $filtro= $data["anio"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->whereRaw('YEAR(t_tramites.created_at)='.$filtro);
                });
        }
        
        if(array_key_exists('i_search', $data)){
            $filtro= $data["i_search"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('r.razon_social_o_nombre','like', '%'.$filtro.'%')->orWhere('r.rfc','like', '%'.$filtro.'%');
                });
        }

        if(array_key_exists('rfc', $data)){
            $filtro= $data["rfc"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('r.rfc','=',$filtro);
                });
        }

        if(array_key_exists('razon_social_o_nombre', $data)){
            $filtro= $data["razon_social_o_nombre"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('r.razon_social_o_nombre','=',$filtro);
                });
        }

        $result= $result->orderBy('t_tramites.id','DESC');
        return $result;
     }      

    public static function detalle($id)
     {
        $result = T_Tramite::select('t_tramites.*','r.id_sujeto', 'r.id_tipo_persona', 'r.rfc', 'p.curp', 'r.razon_social_o_nombre', 'p.nombre', 'p.ap_paterno', 'ap_materno', 'p.id_nacionalidad', 'p.sexo', 'p.id_tipo_identificacion', 'p.numero_identificacion', 'df.id as id_domicilio_fiscal', 'mf.id_estado as id_estado_fiscal', 'mf.nombre as municipio_fiscal', 'ef.nombre as estado_fiscal', 'df.id_municipio as id_municipio_fiscal', 'df.ciudad as ciudad_fiscal', 'df.calle as calle_fiscal', 'df.num_exterior as ext_fiscal', 'df.num_interior as int_fiscal', 'df.colonia as colonia_fiscal', 'df.codigo_postal as cp_fiscal', 'df.referencias as referencias_fiscal', 'dp.id as id_domicilio_particular', 'mp.id_estado as id_estado_particular', 'dp.id_municipio as id_municipio_particular', 'dp.ciudad as ciudad_particular', 'dp.calle as calle_particular', 'dp.num_exterior  as ext_particular', 'dp.num_interior  as int_particular', 'dp.colonia as colonia_particular', 'dp.codigo_postal as cp_particular', 'dp.referencias as referencias_particular', 'tt.nombre as tipo_tramite',
            'c_status.nombre as status_general',
            'c_status.color as status_general_color',
            'c_status_legal.nombre as status_legal',
            'c_status_legal.color as status_legal_color',
            'c_status_financiera.nombre as status_financiera',
            'c_status_financiera.color as status_financiera_color',
            'c_status_tecnica.nombre as status_tecnica',            
            'c_status_tecnica.color as status_tecnica_color',            
        );

        $result= $result->leftJoin('t_registro as r', 'r.id', '=', 't_tramites.id_cs');
        $result= $result->leftJoin('c_tipos_tramite as tt', 'tt.id', '=', 't_tramites.id_tipo_tramite');
        $result= $result->leftJoin('d_personales as p', 'p.id', '=', 'r.id_d_personal');
        $result= $result->leftJoin('d_domicilios as df', 'df.id', '=', 't_tramites.id_d_domicilio_fiscal');
        $result= $result->leftJoin('c_municipios as mf', 'mf.id', '=', 'df.id_municipio');
        $result= $result->leftJoin('c_estados as ef', 'ef.id', '=', 'mf.id_estado');
        $result= $result->leftJoin('d_domicilios as dp', 'dp.id', '=', 'p.id_d_domicilio');
        $result= $result->leftJoin('c_municipios as mp', 'mp.id', '=', 'dp.id_municipio');
        $result= $result->leftJoin('c_status', 't_tramites.id_status', '=', 'c_status.id');        
        $result= $result->leftJoin('c_status as c_status_legal', 't_tramites.id_status_area_legal', '=', 'c_status_legal.id');
        $result= $result->leftJoin('c_status as c_status_financiera', 't_tramites.id_status_area_financiera', '=', 'c_status_financiera.id');
        $result= $result->leftJoin('c_status as c_status_tecnica', 't_tramites.id_status_area_tecnica', '=', 'c_status_tecnica.id');
        
        $result= $result->where('t_tramites.id', $id);
        return $result->first();        
     }

    public static function edit($id)
     {
        $result = T_Tramite::select(
            '*', 
            DB::raw('YEAR(fecha_inicio) as anio_inicio')
        );
        $result= $result->where('id', $id);
        return $result->first();    
     }

    public static function datos_validacion_movil($id)
    {
        $result = T_Tramite::select('t_tramites.*','r.id_sujeto', 'r.id_tipo_persona', 'r.rfc', 'p.curp', 'r.razon_social_o_nombre', 'p.nombre', 'p.ap_paterno', 'ap_materno', 'p.id_nacionalidad', 'p.sexo', 'p.id_tipo_identificacion', 'p.numero_identificacion', 'df.id as id_domicilio_fiscal', 'mf.id_estado as id_estado_fiscal', 'mf.nombre as municipio_fiscal', 'ef.nombre as estado_fiscal', 'df.id_municipio as id_municipio_fiscal', 'df.ciudad as ciudad_fiscal', 'df.calle as calle_fiscal', 'df.num_exterior as ext_fiscal', 'df.num_interior as int_fiscal', 'df.colonia as colonia_fiscal', 'df.codigo_postal as cp_fiscal', 'df.referencias as referencias_fiscal', 'dp.id as id_domicilio_particular', 'mp.id_estado as id_estado_particular', 'dp.id_municipio as id_municipio_particular', 'dp.ciudad as ciudad_particular', 'dp.calle as calle_particular', 'dp.num_exterior  as ext_particular', 'dp.num_interior  as int_particular', 'dp.colonia as colonia_particular', 'dp.codigo_postal as cp_particular', 'dp.referencias as referencias_particular', 'tt.nombre as tipo_tramite', 'tdl.boleta_pago as boleta_pago_alegal', 'tc.motivo', 'tc.created_at as fecha_cancelacion');
        
        $result= $result->leftJoin('t_tramites_datos_legales as tdl', 't_tramites.id', '=', 'tdl.id_tramite');
        $result= $result->leftJoin('t_tramites_cancelados as tc', 'tc.id_tramite', '=', 't_tramites.id');
        $result= $result->leftJoin('t_registro as r', 'r.id', '=', 't_tramites.id_cs');
        $result= $result->leftJoin('c_tipos_tramite as tt', 'tt.id', '=', 't_tramites.id_tipo_tramite');
        $result= $result->leftJoin('d_personales as p', 'p.id', '=', 'r.id_d_personal');
        $result= $result->leftJoin('d_domicilios as df', 'df.id', '=', 't_tramites.id_d_domicilio_fiscal');
        $result= $result->leftJoin('c_municipios as mf', 'mf.id', '=', 'df.id_municipio');
        $result= $result->leftJoin('c_estados as ef', 'ef.id', '=', 'mf.id_estado');
        $result= $result->leftJoin('d_domicilios as dp', 'dp.id', '=', 'p.id_d_domicilio');
        $result= $result->leftJoin('c_municipios as mp', 'mp.id', '=', 'dp.id_municipio');               

        
        $result= $result->where('t_tramites.id', $id);
        return $result->first();        
    }

}
