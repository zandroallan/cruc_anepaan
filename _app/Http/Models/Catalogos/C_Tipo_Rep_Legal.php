<?php
namespace App\Http\Models\Catalogos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class C_Tipo_Rep_Legal extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_tipos_rep_legal';
    protected $fillable = [
        'id',
        'nombre'
    ];

    protected $hidden = [];

    public static function lists()
    {
        $result= C_Tipo_Rep_Legal::orderBy('nombre','ASC')
                    ->pluck('nombre','id','deleted_at')
                    ->prepend('Seleccionar', 0)
                    ->all();

        return $result;
    }

}