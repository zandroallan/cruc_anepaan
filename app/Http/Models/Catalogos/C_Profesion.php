<?php
namespace App\Http\Models\Catalogos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class C_Profesion extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_profesiones';
    protected $fillable = [
        'id', 
        'nombre'
    ];

    protected $hidden=[];

    public static function lists(){
        $result= C_Profesion::orderBy('nombre','ASC')->pluck('nombre','id','deleted_at')->prepend('Seleccionar', 0)->all();
        return $result;
    }
}