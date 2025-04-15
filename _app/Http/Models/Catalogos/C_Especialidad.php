<?php
namespace App\Http\Models\Catalogos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class C_Especialidad extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_especialidades';
    protected $fillable = [
        'id',
        'id_sujeto',
        'clave',
        'nombre'
    ];

    protected $hidden = [];

    public static function lists($data=[])
    {
        $result= C_Especialidad::select('id','nombre', DB::raw('concat_ws(" - ", LPAD( clave, 4,"0") ,nombre) as especialidad'));
        if(array_key_exists('id_sujeto', $data)) {
            $filtro=$data["id_sujeto"];
            $result=$result->where( function($sql) use ($filtro) {
                $sql->where('id_sujeto','=',$filtro);
            });
        }
        $result=$result->orderBy('especialidad','ASC')->pluck('especialidad','id','deleted_at')->prepend('Seleccionar', 0)->all();
        return $result;
    }    

    public static function general($data=[])
    {
        $result = C_Especialidad::select('*');        
        if(array_key_exists('id_sujeto', $data)) {
            $filtro=$data["id_sujeto"];
            $result=$result->where( function($sql) use ($filtro){
                $sql->where('id_sujeto','=',$filtro);
            });
        } 
        if(array_key_exists('id', $data)) {
            $filtro=$data["id"];
            $result=$result->where( function($sql) use ($filtro){
                $sql->where('id','!=',$filtro);
            });
        }
        $result= $result->orderBy('id','DESC');
        return $result;
    }     
}