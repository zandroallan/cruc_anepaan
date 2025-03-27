<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class T_Tramite_Rep_Legal extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_tramites_rep_legales';
    protected $fillable = [
        'id', 
        'id_tramite',
        'id_registro_tmp',
        'id_d_personal',
        'id_tipo_rep_legal', 
        'id_acta_instrumento', 
    ];

    protected $hidden = [
        //'id',
    ];

    public static function general($data=[])
     {
        $result = T_Tramite_Rep_Legal::select('t_tramites_rep_legales.*', 'p.nombre', 'p.ap_paterno', 'ap_materno', 'p.curp', 'p.rfc', 'p.id_nacionalidad', 'pais.nacionalidad', 'p.sexo', 'p.telefono', 'p.correo_electronico', 'p.id_tipo_identificacion', 'ti.nombre as tipo_identificacion','p.numero_identificacion', 'dp.id as id_domicilio_particular', 'mp.id_estado as id_estado_particular', 'dp.id_municipio as id_municipio_particular', 'dp.ciudad as ciudad_particular', 'dp.calle as calle_particular', 'dp.num_exterior  as ext_particular', 'dp.num_interior  as int_particular', 'dp.colonia as colonia_particular', 'dp.codigo_postal as cp_particular', 'dp.referencias as referencias_particular', 'ai.id_tipo_acta_instrumento', 'ai.num_escritura', 'ai.fecha_escritura', 'ai.notario_nombre', 'ai.notario_numero', 'ai.id_estado', 'ai.num_registro_publico', 'ai.seccion', 'ai.ciudad', 'ai.fecha_registro_publico', 'ai.id_estado_registro', 'e1.nombre as estado1', 'e1.nombre as estado2', 'rl.nombre as tipo_rep_legal', 'p.id_d_domicilio');
        $result= $result->leftJoin('c_tipos_rep_legal as rl', 'rl.id', '=', 't_tramites_rep_legales.id_tipo_rep_legal');
        $result= $result->leftJoin('d_personales as p', 'p.id', '=', 't_tramites_rep_legales.id_d_personal');
        $result= $result->leftJoin('c_pais as pais', 'pais.id', '=', 'p.id_nacionalidad');
        $result= $result->leftJoin('c_tipos_identificacion as ti', 'ti.id', '=', 'p.id_tipo_identificacion');
        $result= $result->leftJoin('d_domicilios as dp', 'dp.id', '=', 'p.id_d_domicilio');    
        $result= $result->leftJoin('c_municipios as mp', 'mp.id', '=', 'dp.id_municipio');     
        $result= $result->leftJoin('t_tramites_actas_instrumentos as ai', 'ai.id', '=', 't_tramites_rep_legales.id_acta_instrumento');  
        $result= $result->leftJoin('c_estados as e1', 'e1.id', '=', 'ai.id_estado');
        $result= $result->leftJoin('c_estados as e2', 'e2.id', '=', 'ai.id_estado_registro');
        
        if(array_key_exists('id_tipo_rep_legal', $data)) {
            $filtro= $data["id_tipo_rep_legal"];
            $result= $result->where( function($sql) use ($filtro) {
                $sql->where('t_tramites_actas_instrumentos.id_tipo_rep_legal','=',$filtro);
            });
        }
        if(array_key_exists('id_tramite', $data)) {
            $filtro= $data["id_tramite"];
            $result= $result->where( function($sql) use ($filtro) {
                $sql->where('t_tramites_rep_legales.id_tramite','=',$filtro);
            });
        }
        if(array_key_exists('id_registro_tmp', $data)) {
            $filtro= $data["id_registro_tmp"];
            $result= $result->where( function($sql) use ($filtro) {
                $sql->where('t_tramites_rep_legales.id_registro_tmp','=',$filtro);
            });
        }
        if(array_key_exists('id', $data)) {
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro) {
                $sql->where('t_tramites_rep_legales.id','!=',$filtro);
            });
        }
        $result= $result->orderBy('t_tramites_rep_legales.id','DESC');
        return $result;
     }

    public static function edit($id_registro_tmp)
     {
        $result = T_Tramite_Rep_Legal::select('t_tramites_rep_legales.*', 'p.nombre', 'p.ap_paterno', 'ap_materno', 'p.curp', 'p.rfc', 'p.id_nacionalidad', 'pais.nacionalidad', 'p.sexo', 'p.telefono', 'p.correo_electronico', 'p.id_tipo_identificacion', 'ti.nombre as tipo_identificacion','p.numero_identificacion', 'dp.id as id_domicilio_particular',  'mp.id_estado as id_estado_particular', 'dp.id_municipio as id_municipio_particular', 'dp.ciudad as ciudad_particular', 'dp.calle as calle_particular', 'dp.num_exterior  as ext_particular', 'dp.num_interior  as int_particular', 'dp.colonia as colonia_particular', 'dp.codigo_postal as cp_particular', 'dp.referencias as referencias_particular', 'ai.id_tipo_acta_instrumento', 'ai.num_escritura', 'ai.fecha_escritura', 'ai.notario_nombre', 'ai.notario_numero', 'ai.id_estado', 'ai.num_registro_publico', 'ai.seccion', 'ai.ciudad', 'ai.fecha_registro_publico', 'ai.id_estado_registro', 'e1.nombre as estado1', 'e2.nombre as estado2', 'rl.nombre as tipo_rep_legal', 'p.id_d_domicilio', 'mp.nombre as municipio', 'e3.nombre as estado3');
        $result= $result->leftJoin('c_tipos_rep_legal as rl', 'rl.id', '=', 't_tramites_rep_legales.id_tipo_rep_legal');
        $result= $result->leftJoin('d_personales as p', 'p.id', '=', 't_tramites_rep_legales.id_d_personal');
        $result= $result->leftJoin('c_pais as pais', 'pais.id', '=', 'p.id_nacionalidad');
        $result= $result->leftJoin('c_tipos_identificacion as ti', 'ti.id', '=', 'p.id_tipo_identificacion');
        $result= $result->leftJoin('d_domicilios as dp', 'dp.id', '=', 'p.id_d_domicilio');   
        $result= $result->leftJoin('c_municipios as mp', 'mp.id', '=', 'dp.id_municipio'); 
        $result= $result->leftJoin('t_tramites_actas_instrumentos as ai', 'ai.id', '=', 't_tramites_rep_legales.id_acta_instrumento');  
        $result= $result->leftJoin('c_estados as e1', 'e1.id', '=', 'ai.id_estado');
        $result= $result->leftJoin('c_estados as e2', 'e2.id', '=', 'ai.id_estado_registro');
        $result= $result->leftJoin('c_estados as e3', 'e3.id', '=', 'mp.id_estado');

        $result= $result->where('t_tramites_rep_legales.id_registro_tmp', $id_registro_tmp);
        $result= $result->orderBy('t_tramites_rep_legales.id', 'desc')->first();
        return $result;
     }  
    
    # OEM
    public static function top_rlegal($data=[])
     {
        $result = T_Tramite_Rep_Legal::select('t_tramites_rep_legales.id', DB::raw('concat_ws(" ", p.nombre, p.ap_paterno, p.ap_materno) as nombre_completo'),'p.curp',DB::raw('count(DISTINCT id_tramite) as total'));        
        $result= $result->join('d_personales as p', 'p.id', '=', 't_tramites_rep_legales.id_d_personal');
        $result= $result->join('t_tramites as t', 't.id', '=', 't_tramites_rep_legales.id_tramite');
        $result= $result->join('c_tipos_tramite as c_tipo', 'c_tipo.id', '=', 't.id_tipo_tramite');
        $result= $result->join('c_status as s', 's.id', '=', 't.id_status');
        $result= $result->join('t_registro as reg', 'reg.id', '=', 't.id_cs');
        
        if(array_key_exists('anio', $data)){
            $filtro= $data["anio"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->whereRaw('YEAR(t_tramites_rep_legales.created_at)='.$filtro);
                });
        }
        $result= $result->where('curp','!=','');
        $result= $result->groupBy('curp');    
        $result= $result->orderBy('total','DESC')->limit(10);
        return $result;
     }

    # segunda pantralla de detalles de todos los tramites de esa persona
    public static function detalle_top_rlegal($data=[]){
        $result = T_Tramite_Rep_Legal::select('t_tramites_rep_legales.id', DB::raw('concat_ws(" ", p.nombre, p.ap_paterno, p.ap_materno) as nombre_completo'),'p.curp','t.folio','c_tipo.nombre as tipo','s.nombre as status','reg.razon_social_o_nombre as empresa');        
        $result= $result->join('d_personales as p', 'p.id', '=', 't_tramites_rep_legales.id_d_personal');
        $result= $result->join('t_tramites as t', 't.id', '=', 't_tramites_rep_legales.id_tramite');
        $result= $result->join('c_tipos_tramite as c_tipo', 'c_tipo.id', '=', 't.id_tipo_tramite');
        $result= $result->join('c_status as s', 's.id', '=', 't.id_status');
        $result= $result->join('t_registro as reg', 'reg.id', '=', 't.id_cs');

        if(array_key_exists('curp', $data)){
            $filtro= $data["curp"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('p.curp','=',$filtro);
                });
        } 
        
        if(array_key_exists('anio', $data)){
            $filtro= $data["anio"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->whereRaw('YEAR(t_tramites_rep_legales.created_at)='.$filtro);
                });
        }
        
        $result= $result->groupBy('t_tramites_rep_legales.id_tramite');  
        $result= $result->orderBy('t_tramites_rep_legales.id','DESC');
        return $result;
    }    
}