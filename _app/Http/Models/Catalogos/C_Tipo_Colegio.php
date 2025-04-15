<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class C_Tipo_Colegio extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_tipos_colegio';
    protected $fillable = [
        'id', 
        'nombre',
        'especialidades'
    ];

    protected $hidden = [
        //'id',
    ];
    
    public static function edit($id){
        $result = C_Tipo_Colegio::select('c_tipos_colegio.*');       
        $result= $result->where('c_tipos_colegio.id', $id);
        $result= $result->orderBy('c_tipos_colegio.id', 'desc')->first();
        return $result;
    }   
    

}
