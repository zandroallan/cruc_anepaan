<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class C_Nacionalidad extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_pais';
    protected $fillable = [
        'id', 'nombre', 'nacionalidad', 'activo', 'sigla'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function lists(){
         $result= C_Nacionalidad::whereNotNull('nacionalidad')->orderBy('nacionalidad','ASC')->pluck('nacionalidad','id','deleted_at')->prepend('Seleccionar', 0)->all();
        return $result;
    }

}