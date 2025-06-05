<?php
namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class T_Registro_Bloqueado extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_registro_bloqueado';
    protected $fillable = [
        'id', 
        'id_registro',
        'descripcion',
        'fecha',
        'hora'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function queryToDB($data)
    {
        // $result = T_Registro::select(
        //     't_registro.id',
        //     DB::raw("CASE
        //         WHEN t_registro.id_tipo_persona = 1 THEN 'Fisica'
        //         WHEN t_registro.id_tipo_persona = 2 THEN 'Moral'
        //         END as tipo_persona"
        //     ),
        //     DB::raw("CASE 
        //         WHEN t_registro.id_sujeto = 1 THEN 'Contratista'
        //         WHEN t_registro.id_sujeto = 2 THEN 'Supervisor'
        //         END as sujeto"
        //     ),
        //     't_registro.razon_social_o_nombre',
        //     't_registro.rfc',
        //     't_registro.telefono',
        //     't_registro.email',
        //     'd_domicilios.calle',
        //     'd_domicilios.num_exterior',
        //     'd_domicilios.num_interior',
        //     'd_domicilios.colonia',
        //     'd_domicilios.entre_calle',
        //     'd_domicilios.codigo_postal',
        //     'd_domicilios.referencias',
        //     'd_domicilios.ciudad',
        //     'c_municipios.nombre as municipio'
        // );
        // $result= $result->leftJoin('d_domicilios', 't_registro.id_d_domicilio_fiscal', '=', 'd_domicilios.id');
        // $result= $result->leftJoin('c_municipios', 'd_domicilios.id_municipio', '=', 'c_municipios.id');

        // if ( array_key_exists('rfc', $data) ) {
        //     $filtro= $data["rfc"];
        //     $result= $result->where( function($sql) use ($filtro){
        //         $sql->where('t_registro.rfc','=',$filtro);
        //     });
        // }

        // return $result;              
    } 
    

}
