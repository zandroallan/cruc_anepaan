<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class T_Tramite_Contador extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_tramites_contadores';
    protected $fillable = [
        'id', 
        'id_registro_tmp',
        'id_tramite', 
        'id_d_personal',
        'id_colegio', 
        'id_domicilio', 
        'registro_aggaf',
        'cedula',
        'fecha_cedula',
        'rfc',
        'imss',
    ];

    protected $hidden = [
        //'id',
    ];

    public static function queryToDB($data=[])
     {
        $result = T_Tramite_Contador::select(
            't_tramites_contadores.id', 
            'd_personales.curp', 
            'd_personales.rfc', 
            'd_personales.fecha_nacimiento',
            'd_personales.sexo',
            'd_personales.telefono',
            'd_personales.correo_electronico',
            DB::raw('concat_ws(" ", d_personales.nombre, d_personales.ap_paterno, d_personales.ap_materno) as nombre_completo'),
            'c_tipos_identificacion.nombre as identificacion',
            'd_personales.numero_identificacion',
            'd_personales.numero_cedula',
            'd_personales.fecha_cedula',
            'd_personales.registro_agaff',
            DB::raw("CONCAT_WS(', ',
                d_domicilios.calle,
                CONCAT('No. ', d_domicilios.num_exterior),
                CONCAT('Int. ', d_domicilios.num_interior),
                d_domicilios.colonia,
                d_domicilios.codigo_postal,
                d_domicilios.ciudad
            ) AS direccion_completa")
        );  
        $result= $result->join('d_personales', 't_tramites_contadores.id_d_personal', '=', 'd_personales.id');
        $result= $result->join('c_tipos_identificacion', 'd_personales.id_tipo_identificacion', '=', 'c_tipos_identificacion.id');
        $result= $result->leftJoin('d_domicilios', 'd_personales.id_d_domicilio', '=', 'd_domicilios.id');

        if (!empty($data['id_registro_tmp'])) {
            $result= $result->where('t_tramites_contadores.id_registro_tmp', $data['id_registro_tmp']);
        }

        $result= $result->orderBy('t_tramites_contadores.id','DESC');
        return $result;
     }

    // public static function general($data=[]){
    //     $result = T_Tramite_Contador_Publico::select('t_tramites_contadores.id', 't_tramites_contadores.id_tramite', 't_tramites_contadores.id_d_personal', 't_tramites_contadores.id_colegio', 't_tramites_contadores.id_domicilio', 't_tramites_contadores.registro_aggaf', 't_tramites_contadores.cedula', 't_tramites_contadores.fecha_cedula', 't_tramites_contadores.rfc as rfclaboral', 't_tramites_contadores.imss', 'p.nombre', 'p.ap_paterno', 'ap_materno', 'p.curp', 'p.rfc', 'p.id_nacionalidad', 'pais.nacionalidad', 'p.sexo', 'p.telefono', 'p.correo_electronico', 'p.id_tipo_identificacion', 'ti.nombre as tipo_identificacion','p.numero_identificacion', 'df.id as id_domicilio_fiscal', 'mf.id_estado as id_estado_fiscal', 'df.id_municipio as id_municipio_fiscal', 'df.ciudad as ciudad_fiscal', 'df.calle as calle_fiscal', 'df.num_exterior  as ext_fiscal', 'df.num_interior  as int_fiscal', 'df.colonia as colonia_fiscal', 'df.codigo_postal as cp_fiscal', 'df.referencias as referencias_fiscal', 'p.id_d_domicilio', 'clg.nombre as colegio');        
    //     $result= $result->leftJoin('d_personales as p', 'p.id', '=', 't_tramites_contadores.id_d_personal');
    //     $result= $result->leftJoin('c_pais as pais', 'pais.id', '=', 'p.id_nacionalidad');
    //     $result= $result->leftJoin('c_tipos_identificacion as ti', 'ti.id', '=', 'p.id_tipo_identificacion');
    //     $result= $result->leftJoin('d_domicilios as df', 'df.id', '=', 't_tramites_contadores.id_domicilio');    
    //     $result= $result->leftJoin('c_municipios as mf', 'mf.id', '=', 'df.id_municipio');
    //     $result= $result->leftJoin('c_colegios as clg', 'clg.id', '=', 't_tramites_contadores.id_colegio');
        
    //     if(array_key_exists('id_colegio', $data)){
    //         $filtro= $data["id_colegio"];
    //         $result= $result->where( function($sql) use ($filtro){
    //                 $sql->where('t_tramites_contadores.id_colegio','=',$filtro);
    //             });
    //     }         

    //     if(array_key_exists('id_tramite', $data)){
    //         $filtro= $data["id_tramite"];
    //         $result= $result->where( function($sql) use ($filtro){
    //                 $sql->where('t_tramites_contadores.id_tramite','=',$filtro);
    //             });
    //     } 
    
    //     if(array_key_exists('id', $data)){
    //         $filtro= $data["id"];
    //         $result= $result->where( function($sql) use ($filtro){
    //                 $sql->where('t_tramites_contadores.id','!=',$filtro);
    //             });
    //     }
    //     $result= $result->orderBy('t_tramites_contadores.id','DESC');
    //     return $result;
    // }

    // public static function edit($id_tramite){
    //     $result = T_Tramite_Contador_Publico::select('t_tramites_contadores.id', 't_tramites_contadores.id_tramite', 't_tramites_contadores.id_d_personal', 't_tramites_contadores.id_colegio', 't_tramites_contadores.id_domicilio', 't_tramites_contadores.registro_aggaf', 't_tramites_contadores.cedula', 't_tramites_contadores.fecha_cedula', 't_tramites_contadores.rfc as rfclaboral', 't_tramites_contadores.imss', 'p.nombre', 'p.ap_paterno', 'ap_materno', 'p.curp', 'p.rfc', 'p.id_nacionalidad', 'pais.nacionalidad', 'p.sexo', 'p.telefono', 'p.correo_electronico', 'p.id_tipo_identificacion', 'ti.nombre as tipo_identificacion','p.numero_identificacion', 'df.id as id_domicilio_fiscal', 'mf.id_estado as id_estado_fiscal', 'df.id_municipio as id_municipio_fiscal', 'df.ciudad as ciudad_fiscal', 'df.calle as calle_fiscal', 'df.num_exterior  as ext_fiscal', 'df.num_interior  as int_fiscal', 'df.colonia as colonia_fiscal', 'df.codigo_postal as cp_fiscal', 'df.referencias as referencias_fiscal', 'p.id_d_domicilio', 'clg.nombre as colegio', 'estado.nombre as estado', 'mf.nombre as municipio');        
    //     $result= $result->leftJoin('d_personales as p', 'p.id', '=', 't_tramites_contadores.id_d_personal');
    //     $result= $result->leftJoin('c_pais as pais', 'pais.id', '=', 'p.id_nacionalidad');
    //     $result= $result->leftJoin('c_tipos_identificacion as ti', 'ti.id', '=', 'p.id_tipo_identificacion');
    //     $result= $result->leftJoin('d_domicilios as df', 'df.id', '=', 't_tramites_contadores.id_domicilio');    
    //     $result= $result->leftJoin('c_municipios as mf', 'mf.id', '=', 'df.id_municipio');
    //     $result= $result->leftJoin('c_colegios as clg', 'clg.id', '=', 't_tramites_contadores.id_colegio');
    //     $result= $result->leftJoin('c_estados as estado', 'estado.id', '=', 'mf.id_estado');

    //     $result= $result->where('t_tramites_contadores.id_tramite', $id_tramite);
    //     $result= $result->orderBy('t_tramites_contadores.id', 'desc')->first();
    //     return $result;
    // } 
    
    // public static function edit_contador($id){
    //     $result = T_Tramite_Contador_Publico::select('t_tramites_contadores.id_d_personal', 't_tramites_contadores.id_colegio', 't_tramites_contadores.id_domicilio', 't_tramites_contadores.registro_aggaf', 't_tramites_contadores.cedula', 't_tramites_contadores.fecha_cedula', 't_tramites_contadores.rfc as rfclaboral', 't_tramites_contadores.imss', 'p.nombre', 'p.ap_paterno', 'ap_materno', 'p.curp', 'p.rfc', 'p.id_nacionalidad', 'pais.nacionalidad', 'p.sexo', 'p.telefono', 'p.correo_electronico', 'p.id_tipo_identificacion', 'ti.nombre as tipo_identificacion','p.numero_identificacion', 'df.id as id_domicilio_fiscal', 'mf.id_estado as id_estado_fiscal', 'df.id_municipio as id_municipio_fiscal', 'df.ciudad as ciudad_fiscal', 'df.calle as calle_fiscal', 'df.num_exterior  as ext_fiscal', 'df.num_interior  as int_fiscal', 'df.colonia as colonia_fiscal', 'df.codigo_postal as cp_fiscal', 'df.referencias as referencias_fiscal', 'p.id_d_domicilio', 'clg.nombre as colegio');        
    //     $result= $result->leftJoin('d_personales as p', 'p.id', '=', 't_tramites_contadores.id_d_personal');
    //     $result= $result->leftJoin('c_pais as pais', 'pais.id', '=', 'p.id_nacionalidad');
    //     $result= $result->leftJoin('c_tipos_identificacion as ti', 'ti.id', '=', 'p.id_tipo_identificacion');
    //     $result= $result->leftJoin('d_domicilios as df', 'df.id', '=', 't_tramites_contadores.id_domicilio');    
    //     $result= $result->leftJoin('c_municipios as mf', 'mf.id', '=', 'df.id_municipio');
    //     $result= $result->leftJoin('c_colegios as clg', 'clg.id', '=', 't_tramites_contadores.id_colegio');

    //     $result= $result->where('t_tramites_contadores.id', $id);
    //     $result= $result->orderBy('t_tramites_contadores.id', 'desc')->first();
    //     return $result;
    // }    
}