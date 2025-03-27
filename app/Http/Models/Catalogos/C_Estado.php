<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class C_Estado extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_estados';
    protected $fillable = [
        'id', 'id_pais', 'clave', 'nombre', 'abrev'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function lists(){
         $result= C_Estado::orderBy('nombre','ASC')->pluck('nombre','id','deleted_at')->prepend('Seleccionar', 0)->all();
        return $result;
    }

}