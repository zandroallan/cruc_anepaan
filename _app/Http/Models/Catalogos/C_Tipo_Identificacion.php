<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class C_Tipo_Identificacion extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_tipos_identificacion';
    protected $fillable = [
        'id', 'nombre'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function lists(){
         $result= C_Tipo_Identificacion::orderBy('nombre','ASC')->pluck('nombre','id','deleted_at')->prepend('Seleccionar', 0)->all();
        return $result;
    }

}