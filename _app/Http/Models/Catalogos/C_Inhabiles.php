<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use DB;

class C_Inhabiles extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_inhabiles';
    protected $fillable = [
        'id', 'fecha', 'motivo'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function lists()
    {
        $result= C_Inhabiles::select("fecha")->pluck("fecha")->all();
        return $result;
    }

    public static function diasInhabiles()
     {
        $f_actual = Carbon::now();
        $f_actual = $f_actual->format('Y-m-d');
    
        return DB::select(DB::raw("SELECT `id`, `fecha`, `motivo` FROM `c_inhabiles` WHERE  `fecha` = :fecha AND `deleted_at` IS NULL"), array('fecha' => $f_actual)); 

     }

    public static function diaInhabil(){
        $result = DB::select( DB::raw( "SELECT `fecha` FROM `c_inhabiles`"));
        return $result;
    }
}