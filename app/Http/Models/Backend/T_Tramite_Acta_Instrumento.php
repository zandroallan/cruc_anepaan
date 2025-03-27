<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class T_Tramite_Acta_Instrumento extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_tramites_actas_instrumentos';
    protected $fillable = [
        'id', 
        'id_tramite', 
        'id_registro_tmp',
        'id_tipo_acta_instrumento',
        'num_escritura', 
        'fecha_escritura', 
        'notario_nombre', 
        'notario_numero', 
        'id_estado',
        'num_registro_publico',
        'seccion',
        'ciudad',
        'fecha_registro_publico',
        'id_estado_registro',
    ];

    protected $hidden = [
        //'id',
    ];

    public static function general($data=[])
    {
        $result=T_Tramite_Acta_Instrumento::select('t_tramites_actas_instrumentos.*', 'e1.nombre as estado_escritura', 'e2.nombre as estado_regpub');
        $result=$result->leftJoin('c_estados as e1', 'e1.id', '=', 't_tramites_actas_instrumentos.id_estado');
        $result=$result->leftJoin('c_estados as e2', 'e2.id', '=', 't_tramites_actas_instrumentos.id_estado_registro');

        if(array_key_exists('id_tipo_acta_instrumento', $data)){
            $filtro= $data["id_tipo_acta_instrumento"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_actas_instrumentos.id_tipo_acta_instrumento', $filtro);
            });
        }         

        if(array_key_exists('id_tramite', $data)){
            $filtro= $data["id_tramite"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_actas_instrumentos.id_tramite', $filtro);
            });
        }

        if(array_key_exists('id_registro_tmp', $data)){
            $filtro= $data["id_registro_tmp"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_actas_instrumentos.id_registro_tmp', $filtro);
            });
        } 
    
        if(array_key_exists('id', $data)){
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_actas_instrumentos.id', '!=', $filtro);
            });
        }

        $result=$result->orderBy('t_tramites_actas_instrumentos.id', 'DESC');
        return $result;
    }

    public static function edit($id_registro_tmp, $id_tipo_acta_instrumento=0)
    {
        $result = T_Tramite_Acta_Instrumento::select('t_tramites_actas_instrumentos.*', 'e1.nombre as estado1', 'e1.nombre as estado2', 'e1.nombre as estado1', 'e2.nombre as estado2');
        $result= $result->leftJoin('c_estados as e1', 'e1.id', '=', 't_tramites_actas_instrumentos.id_estado');
        $result= $result->leftJoin('c_estados as e2', 'e2.id', '=', 't_tramites_actas_instrumentos.id_estado_registro');

        if($id_tipo_acta_instrumento!=0) {
            $result= $result->where('t_tramites_actas_instrumentos.id_tipo_acta_instrumento', $id_tipo_acta_instrumento);
        }

        $result= $result->where('t_tramites_actas_instrumentos.id_registro_tmp', $id_registro_tmp);
        $result= $result->orderBy('t_tramites_actas_instrumentos.id', 'desc')->first();
        return $result;
    }    
}