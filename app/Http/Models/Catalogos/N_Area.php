<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class N_Area extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'n_areas';
    protected $fillable = [
        'id', 'id_usuario', 'id_tramite', 'descripcion', 'visto'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function general($data=[]){
        $result = N_Area::select('n_areas.id', 'n_areas.id_usuario','n_areas.id_tramite', 'n_areas.descripcion', 'u.name as nombre', 'n_areas.visto', 'n_areas.created_at as fecha');
        $result= $result->leftJoin('users as u', 'u.id', '=', 'n_areas.id_usuario');
        $result= $result->leftJoin('t_tramites as t', 't.id', '=', 'n_areas.id_tramite');

        if(array_key_exists('id_usuario', $data)){
            $filtro= $data["id_usuario"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('n_areas.id_usuario','=',$filtro);
                });
        }

        if(array_key_exists('id_tramite', $data)){
            $filtro= $data["id_tramite"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('n_areas.id_tramite','=',$filtro);
                });
        }  

        if(array_key_exists('id', $data)){
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('n_areas.id','!=',$filtro);
                });
        }        

        $result= $result->orderBy('n_areas.id','DESC');
        return $result;
    }        

}