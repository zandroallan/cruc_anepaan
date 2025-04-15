<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class T_Registro extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_registro';
    protected $fillable = [
        'id', 
        'id_sujeto', 
        'id_tipo_persona', 
        'id_d_personal', 
        'id_ultimo_tramite', 
        'rfc', 
        'razon_social_o_nombre', 
        'id_d_domicilio_fiscal',
        'telefono',
        'email',
        'tec_acredita_tmp',
        'obligado_dec_isr',
		'folio_pago_temp',
        'fecha_pago_temp',
        'rfc',
        'terminos_temp'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function padronShowApi($data)
    {
        $result = T_Registro::select(
            't_registro.id',
            DB::raw("CASE
                WHEN t_registro.id_tipo_persona = 1 THEN 'Fisica'
                WHEN t_registro.id_tipo_persona = 2 THEN 'Moral'
                END as tipo_persona"
            ),
            DB::raw("CASE 
                WHEN t_registro.id_sujeto = 1 THEN 'Contratista'
                WHEN t_registro.id_sujeto = 2 THEN 'Supervisor'
                END as sujeto"
            ),
            't_registro.razon_social_o_nombre',
            't_registro.rfc',
            't_registro.telefono',
            't_registro.email',
            'd_domicilios.calle',
            'd_domicilios.num_exterior',
            'd_domicilios.num_interior',
            'd_domicilios.colonia',
            'd_domicilios.entre_calle',
            'd_domicilios.codigo_postal',
            'd_domicilios.referencias',
            'd_domicilios.ciudad',
            'c_municipios.nombre as municipio'
        );
        $result= $result->leftJoin('d_domicilios', 't_registro.id_d_domicilio_fiscal', '=', 'd_domicilios.id');
        $result= $result->leftJoin('c_municipios', 'd_domicilios.id_municipio', '=', 'c_municipios.id');

        if ( array_key_exists('rfc', $data) ) {
            $filtro= $data["rfc"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_registro.rfc','=',$filtro);
            });
        }

        return $result;              
    } 
    
    public static function buscar_datos_registro($data){
        $result = T_Registro::select('id', 'rfc', 'email', 'razon_social_o_nombre');

        if(array_key_exists('correo', $data)){
            $filtro= $data["correo"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_registro.email','=',$filtro);
                });
        } 
        if(array_key_exists('rfc', $data)){
            $filtro= $data["rfc"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_registro.rfc','=',$filtro);
                });
        }
        $result= $result->first();
        return $result;               
    }

    public static function get_rfc($data=[]){
        $result = T_Registro::select('*');
        if(array_key_exists('rfc', $data)){
            $filtro= $data["rfc"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->whereRaw('UPPER(rfc) = ?', [$filtro]);
                });
        } 
        if(array_key_exists('id', $data)){
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_registro.id','!=',$filtro);
                });
        }
        $result= $result->orderBy('id','DESC');
        return $result;               
    }

    public static function general($data=[]){
        $result = T_Registro::select('t_registro.id', 't_registro.id_sujeto', 't_registro.razon_social_o_nombre as razon_social', 't_registro.id_tipo_persona', 't_registro.rfc', 't_registro.created_at as fecha_registro', DB::raw('YEAR(t_registro.created_at) as anio'), 't.fecha_inicio', 't.fecha_fin', 'tt.nombre as tipo_tramite', 's.nombre as status', 's.color as status_color', 't.folio' 
        );
        $result= $result->leftJoin('t_tramites as t', 't.id', '=', 't_registro.id_ultimo_tramite');
        $result= $result->leftJoin('c_tipos_tramite as tt', 'tt.id', '=', 't.id_tipo_tramite');
        $result= $result->leftJoin('c_status as s', 's.id', '=', 't.id_status');


        if(array_key_exists('anio', $data)){
            $filtro= $data["anio"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->whereRaw('YEAR(t.created_at)='.$filtro);
                });
        }
        
        if(array_key_exists('i_search', $data)){
            $filtro= $data["i_search"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_registro.razon_social_o_nombre','like', '%'.$filtro.'%')->orWhere('t_registro.rfc','like', '%'.$filtro.'%');
                });
        }

        if(array_key_exists('rfc', $data)){
            $filtro= $data["rfc"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_registro.rfc','=',$filtro);
                });
        }

        if(array_key_exists('razon_social_o_nombre', $data)){
            $filtro= $data["razon_social_o_nombre"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_registro.razon_social_o_nombre','=',$filtro);
                });
        }        
     
        if(array_key_exists('id', $data)){
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_registro.id','!=',$filtro);
                });
        }
        $result= $result->orderBy('t_registro.id','DESC');
        return $result;
    }

    public static function edit($id){
        $result = T_Registro::select('t_registro.*','t_registro.id_sujeto', 't_registro.id_tipo_persona', 't_registro.id_d_personal', 't_registro.rfc', 'p.curp', 't_registro.id_d_domicilio_fiscal', 't_registro.razon_social_o_nombre', 't_registro.telefono', 't_registro.email as correo', 'p.nombre', 'p.ap_paterno', 'ap_materno', 'p.id_nacionalidad', 'p.sexo', 'p.id_tipo_identificacion', 'p.numero_identificacion', 'df.id as id_domicilio_fiscal', 'mf.id_estado as id_estado_fiscal', 'mf.nombre as municipio_fiscal', 'ef.nombre as estado_fiscal', 'df.id_municipio as id_municipio_fiscal', 'df.ciudad as ciudad_fiscal', 'df.calle as calle_fiscal', 'df.num_exterior as ext_fiscal', 'df.num_interior as int_fiscal', 'df.colonia as colonia_fiscal', 'df.codigo_postal as cp_fiscal', 'df.referencias as referencias_fiscal', 'dp.id as id_domicilio_particular', 'mp.id_estado as id_estado_particular', 'dp.id_municipio as id_municipio_particular', 'dp.ciudad as ciudad_particular', 'dp.calle as calle_particular', 'dp.num_exterior  as ext_particular', 'dp.num_interior  as int_particular', 'dp.colonia as colonia_particular', 'dp.codigo_postal as cp_particular', 'dp.referencias as referencias_particular');

        $result= $result->leftJoin('d_personales as p', 'p.id', '=', 't_registro.id_d_personal');
        $result= $result->leftJoin('d_domicilios as df', 'df.id', '=', 't_registro.id_d_domicilio_fiscal');
        $result= $result->leftJoin('c_municipios as mf', 'mf.id', '=', 'df.id_municipio');
        $result= $result->leftJoin('c_estados as ef', 'ef.id', '=', 'mf.id_estado');
        $result= $result->leftJoin('d_domicilios as dp', 'dp.id', '=', 'p.id_d_domicilio');
        $result= $result->leftJoin('c_municipios as mp', 'mp.id', '=', 'dp.id_municipio');       

        
        $result= $result->where('t_registro.id', $id);
        return $result->first();        
    }

    public static function get_ultimo_tramite($rfc){
        $result = T_Registro::select('t_registro.id_ultimo_tramite', 't.id_tipo_tramite', 't.id_status', 't.id_status_area_tecnica', 't.id_status_area_legal', 't.id_status_area_financiera', DB::raw('YEAR(t.created_at) as anio'), 'tt.nombre as tipo_de_tramite');
        $result= $result->join('t_tramites as t', 't.id', '=', 't_registro.id_ultimo_tramite');
        $result= $result->join('c_tipos_tramite as tt', 'tt.id', '=', 't.id_tipo_tramite');
        $result= $result->where('t_registro.rfc', $rfc)->orderBy('t.id', 'DESC');
        return $result->first();  

    }
	
	public static function get_ultimo_tramite_($data=[]){
        $result = T_Registro::select('t_registro.id_ultimo_tramite', 't.id_tipo_tramite', 't.id_status', 't.id_status_area_tecnica', 't.id_status_area_legal', 't.id_status_area_financiera', DB::raw('YEAR(t.created_at) as anio'), 'tt.nombre as tipo_de_tramite');
        $result= $result->join('t_tramites as t', 't.id', '=', 't_registro.id_ultimo_tramite');
        $result= $result->join('c_tipos_tramite as tt', 'tt.id', '=', 't.id_tipo_tramite');
        
        if(array_key_exists('id', $data)){
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_registro.id', $filtro);
                });
        }

        if(array_key_exists('id_sujeto_tramite', $data)){
            $filtro= $data["id_sujeto_tramite"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t.id_sujeto_tramite', $filtro);
                });
        }
      
        $result= $result->orderBy('t.id', 'DESC');  
        return $result->first();  
    }

    public static function certificado($id, $tipo){
         if($tipo==1)
         {

        $query= T_Registro::select('t_registro.id', 't_tramites.id as wert', 't_registro.id_sujeto','t_registro.id_tipo_persona', 't_registro.id_ultimo_tramite','t_registro.rfc', 'd_personales.id_d_domicilio', 'd_personales.nombre'
                , 't_registro.rfc', 't_registro.razon_social_o_nombre','t_tramites.especialidades_tecnicas','t_tramites_capital_contable.capital','t_tramites_capital_contable.fecha_declaracion', 't_tramites_capital_contable.fecha_elaboracion'
                , 'd_personales.ap_paterno', 'd_personales.ap_materno', 'd_personales.curp', 'd_personales.id_nacionalidad'
                , 'd_personales.sexo'
                , 'd_personales.telefono', 'd_personales.correo_electronico', 'd_personales.id_tipo_identificacion', 'd_personales.numero_identificacion', 'domiciliop.ciudad'
                , 'domiciliop.codigo_postal', 'domiciliop.calle', 'domiciliop.num_exterior', 'domiciliop.num_interior'
                , 'domiciliop.colonia', 'domiciliop.referencias', 'municipiop.id as id_municipio', 'municipiop.id_estado as id_estado', 'domiciliof.ciudad as ciudad_fiscal'
                , 'domiciliof.codigo_postal as codigo_postal_fiscal', 'domiciliof.calle as calle_fiscal', 'domiciliof.num_exterior as num_exterior_fiscal', 'domiciliof.num_interior as num_interior_fiscal'
                , 'domiciliof.colonia as colonia_fiscal', 'domiciliof.referencias as referencias_fiscal', 'domiciliof.id_municipio as id_municipio_fiscal', 'municipiof.id_estado as id_estado_fiscal', 'municipiof.nombre as municipionf'
                , 't_tramites_datos_legales.imss', 't_tramites_datos_legales.rec', DB::raw('CASE WHEN t_registro.id_tipo_persona=1 THEN "Fisica" WHEN t_registro.id_tipo_persona=2 THEN "Moral" END as tipo_persona'), 't_tramites.folio as folio_tramite','t_tramites_datos_legales.boleta_pago','t_tramites_datos_legales.num_constancia'
                ,'estadosf.nombre as estadof', 't_tramites.fecha_inicio','t_tramites.id as idCsTramite', 't_tramites_datos_legales.num_control', 't_tramites_datos_legales.vigencia_de','t_tramites_datos_legales.vigencia_al');

             // CASE WHEN id_tipo_persona=1 THEN 'Fisica' WHEN id_tipo_persona=2 THEN 'Moral' END as tipo_persona
         }
         if($tipo==2)
         {
              $query= T_Registro::select('t_registro.id', 't_tramites.id as wert',  't_registro.id_sujeto','t_registro.id_tipo_persona', 't_registro.id_ultimo_tramite','t_registro.rfc', 'd_personales.id_d_domicilio', 'd_personales.nombre'
                , 't_registro.rfc', 't_registro.razon_social_o_nombre','t_tramites.especialidades_tecnicas','t_tramites_capital_contable.capital','t_tramites_capital_contable.fecha_declaracion', 't_tramites_capital_contable.fecha_elaboracion'
                , 'd_personales.ap_paterno', 'd_personales.ap_materno', 'd_personales.curp', 'd_personales.id_nacionalidad'
                , 'd_personales.sexo'
                , 'd_personales.telefono', 'd_personales.correo_electronico', 'd_personales.id_tipo_identificacion', 'd_personales.numero_identificacion', 'domiciliop.ciudad'
                , 'domiciliop.codigo_postal', 'domiciliop.calle', 'domiciliop.num_exterior', 'domiciliop.num_interior'
                , 'domiciliop.colonia', 'domiciliop.referencias', 'municipiop.id as id_municipio', 'municipiop.id_estado as id_estado', 'domiciliof.ciudad as ciudad_fiscal'
                , 'domiciliof.codigo_postal as codigo_postal_fiscal', 'domiciliof.calle as calle_fiscal', 'domiciliof.num_exterior as num_exterior_fiscal', 'domiciliof.num_interior as num_interior_fiscal'
                , 'domiciliof.colonia as colonia_fiscal', 'domiciliof.referencias as referencias_fiscal', 'domiciliof.id_municipio as id_municipio_fiscal', 'municipiof.id_estado as id_estado_fiscal', 'municipiof.nombre as municipionf'
                , 't_tramites_datos_legales.imss', 't_tramites_datos_legales.rec', DB::raw('CASE WHEN t_registro.id_tipo_persona=1 THEN "Fisica" WHEN t_registro.id_tipo_persona=2 THEN "Moral" END as tipo_persona'), 't_tramites.folio as folio_tramite','t_tramites_datos_legales.boleta_pago','t_tramites_datos_legales.num_constancia'
                ,'estadosf.nombre as estadof', 't_tramites.fecha_inicio','t_tramites.id as idCsTramite', 't_tramites_datos_legales.num_control', 't_tramites_datos_legales.vigencia_de','t_tramites_datos_legales.vigencia_al');
              
         }

        $query= $query->leftJoin('t_tramites', 't_tramites.id_cs','=','t_registro.id');
        $query= $query->leftJoin('d_personales', 'd_personales.id','=','t_registro.id_d_personal');
        $query= $query->leftJoin('d_domicilios as domiciliop', 'domiciliop.id','=','d_personales.id_d_domicilio');
        $query= $query->leftJoin('c_municipios as municipiop', 'municipiop.id','=','domiciliop.id_municipio');
        $query= $query->leftJoin('d_domicilios as domiciliof', 'domiciliof.id','=','t_registro.id_d_domicilio_fiscal');
        $query= $query->leftJoin('c_municipios as municipiof', 'municipiof.id','=','domiciliof.id_municipio');

         $query= $query->leftJoin('c_estados as estadosf', 'estadosf.id','=','municipiof.id_estado');

        $query= $query->leftJoin('t_tramites_datos_legales', 't_tramites_datos_legales.id_tramite','=','t_tramites.id');
     
        $query= $query->leftJoin('t_tramites_capital_contable', 't_tramites_capital_contable.id_tramite','=','t_tramites.id');

        $query= $query->where('t_tramites.id',$id)->orderby('t_tramites_datos_legales.id', 'desc');
        return $query;
    }
}
