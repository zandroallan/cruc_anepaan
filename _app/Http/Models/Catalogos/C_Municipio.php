<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class C_Municipio extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_municipios';
    protected $fillable = [
        'id', 'id_estado', 'clave', 'nombre', 'sigla'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function lists($data=[]){

        $result= C_Municipio::select('nombre','id','deleted_at');
        if(array_key_exists('id_estado', $data)){
            $filtro= $data["id_estado"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('id_estado', $filtro);
                });
        }        
        $result= $result->orderBy('nombre','ASC')->pluck('nombre','id','deleted_at')->prepend('Seleccionar', 0)->all();
        return $result;
    }

}