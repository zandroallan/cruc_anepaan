<?php
namespace App\Http\Models\Backend;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class T_Tramite_Rep_Tecnico extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_tramites_rep_tecnicos';
    protected $fillable = [
        'id', 
        'id_tramite',
        'id_registro_tmp',
        'id_d_personal',
        'id_profesion', 
        'id_colegio', 
        'id_tipo_constancia',
        'num_constancia',
        'cedula',
        'fecha_cedula',
        'reposicion',
        'especialidades'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function general($data = [])
    {
        $result = T_Tramite_Rep_Tecnico::select('*');

        if (array_key_exists('id_tramite', $data)) {
            $filtro = $data["id_tramite"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('id_tramite', $filtro);
            });
        }
        if (array_key_exists('id', $data)) {
            $filtro = $data["id"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('id', $filtro);
            });
        }
        $result = $result->orderBy('id', 'DESC');
        return $result;
    }

    public static function rtecs($data=[])
    {
        $result=T_Tramite_Rep_Tecnico::select('t_tramites_rep_tecnicos.id', DB::raw('concat_ws(" ", p.nombre, p.ap_paterno, p.ap_materno) as nombre_completo'));        
        $result=$result->join('d_personales as p', 'p.id', '=', 't_tramites_rep_tecnicos.id_d_personal');
        // $result=$result->groupBy('p.curp');
        $result=$result->orderBy('t_tramites_rep_tecnicos.id', 'DESC')->pluck('nombre_completo','id','deleted_at')->prepend('Seleccionar', 0)->all();
        return $result;
    }

    public static function datos_generales($data=[]){
        $result = T_Tramite_Rep_Tecnico::select('t_tramites_rep_tecnicos.*', 'p.nombre', 'p.ap_paterno', 'ap_materno', 'p.curp', 'p.rfc', 'p.id_nacionalidad', 'pais.nacionalidad', 'p.sexo', 'p.telefono', 'p.correo_electronico', 'p.id_tipo_identificacion', 'ti.nombre as tipo_identificacion','p.numero_identificacion', 'dp.id as id_domicilio_particular', 'mp.id_estado as id_estado_particular', 'dp.id_municipio as id_municipio_particular', 'dp.ciudad as ciudad_particular', 'dp.calle as calle_particular', 'dp.num_exterior  as ext_particular', 'dp.num_interior  as int_particular', 'dp.colonia as colonia_particular', 'dp.codigo_postal as cp_particular', 'dp.referencias as referencias_particular', 'p.id_d_domicilio', 'prof.nombre as profesion', 'col.nombre as colegio');

        $result= $result->Join('t_tramites', 't_tramites_rep_tecnicos.id_tramite', '=', 't_tramites.id');
        $result= $result->leftJoin('d_personales as p', 'p.id', '=', 't_tramites_rep_tecnicos.id_d_personal');
        $result= $result->leftJoin('c_pais as pais', 'pais.id', '=', 'p.id_nacionalidad');
        $result= $result->leftJoin('c_tipos_identificacion as ti', 'ti.id', '=', 'p.id_tipo_identificacion');
        $result= $result->leftJoin('d_domicilios as dp', 'dp.id', '=', 'p.id_d_domicilio');    
        $result= $result->leftJoin('c_municipios as mp', 'mp.id', '=', 'dp.id_municipio');     
        $result= $result->leftJoin('c_profesiones as prof', 'prof.id', '=', 't_tramites_rep_tecnicos.id_profesion');
        $result= $result->leftJoin('c_colegios as col', 'col.id', '=', 't_tramites_rep_tecnicos.id_colegio');
        
        if(array_key_exists('id_tipo_constancia', $data)){
            $filtro= $data["id_tipo_constancia"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_tramites_rep_tecnicos.id_tipo_constancia','=',$filtro);
                });
        }         

        if(array_key_exists('anio', $data)){
            $filtro= $data["anio"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->whereRaw('YEAR(t_tramites_rep_tecnicos.created_at)='.$filtro);
                });
        }     
        
        if(array_key_exists('curp', $data)){
            $filtro= $data["curp"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('p.curp','=',$filtro);
                });
        }         

        if(array_key_exists('id_tramite', $data)){
            $filtro= $data["id_tramite"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_tramites_rep_tecnicos.id_tramite','=',$filtro);
                });
        } 
    
        if(array_key_exists('id', $data)){
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_tramites_rep_tecnicos.id','!=',$filtro);
                });
        }
        $result= $result->where('t_tramites.id_status','!=', 3);
        $result= $result->where('t_tramites.deleted_at', NULL);
        $result= $result->orderBy('t_tramites_rep_tecnicos.id','DESC');
        return $result;
    } 
    public static function getRepTecnicoTMP_Contratista($data=[])
    {
        $result = T_Tramite_Rep_Tecnico::select(
            't_tramites_rep_tecnicos.id',
            't_tramites_rep_tecnicos.id_registro_tmp',
            'd_personales.nombre',
            'd_personales.ap_paterno',
            'd_personales.ap_materno',
            'd_personales.curp'
        );
        $result=$result->Join('d_personales', 't_tramites_rep_tecnicos.id_d_personal', '=', 'd_personales.id');
        //$result=$result->leftJoin('t_tramites', 't_tramites_rep_tecnicos.id_tramite', '=', 't_tramites.id');
        $result=$result->whereNotNull('t_tramites_rep_tecnicos.id_tramite');
               
        if(array_key_exists('id_tipo_constancia', $data)) {
            $filtro= $data["id_tipo_constancia"];
            $result= $result->where( function($sql) use ($filtro) {
                $sql->where('t_tramites_rep_tecnicos.id_tipo_constancia','=',$filtro);
            });
        }
        if(array_key_exists('anio', $data)) {
            $filtro= $data["anio"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->whereRaw('YEAR(t_tramites_rep_tecnicos.created_at)='.$filtro);       
            });
        }        
        if(array_key_exists('curp', $data)) {
            $filtro= $data["curp"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('d_personales.curp','=',$filtro);
            });
        }
        if(array_key_exists('id_registro_tmp', $data)) {
            $filtro= $data["id_registro_tmp"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_rep_tecnicos.id_registro_tmp','=',$filtro);
            });
        }    
        if(array_key_exists('id', $data)) {
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_rep_tecnicos.id','!=',$filtro);
            });
        }
        
        $result=$result->orderBy('t_tramites_rep_tecnicos.id','DESC');
        return $result;
    }

    public static function getRepTecnicoTMP($data=[])
    {
        $result = T_Tramite_Rep_Tecnico::select(
            't_tramites_rep_tecnicos.id',
            't_tramites_rep_tecnicos.id_registro_tmp',
            'd_personales.nombre',
            'd_personales.ap_paterno',
            'd_personales.ap_materno',
            'd_personales.curp'
        );
        $result=$result->leftJoin('d_personales', 't_tramites_rep_tecnicos.id_d_personal', '=', 'd_personales.id');
        
        $result=$result->leftJoin('t_tramites as tr', 'tr.id', '=', 't_tramites_rep_tecnicos.id_tramite');

	    //$result=$result->where('tr.id_status', "!=", 3);

        if(array_key_exists('id_tipo_constancia', $data)) {
            $filtro= $data["id_tipo_constancia"];
            $result= $result->where( function($sql) use ($filtro) {
                $sql->where('t_tramites_rep_tecnicos.id_tipo_constancia','=',$filtro);
            });
        }
        if(array_key_exists('anio', $data)) {
            $filtro= $data["anio"];
            $result= $result->where( function($sql) use ($filtro){
                
		$sql->whereRaw('YEAR(tr.fecha_inicio)='.$filtro);
            });
        }        
        if(array_key_exists('curp', $data)) {
            $filtro= $data["curp"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('d_personales.curp','=',$filtro);
            });
        }
        if(array_key_exists('id_registro_tmp', $data)) {
            $filtro= $data["id_registro_tmp"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_rep_tecnicos.id_registro_tmp','=',$filtro);
            });
        }   
        
        //Se agregó 'id_cs'=>$post['id_registro_tmp'] para que permita usar la misma constancia en la misma empresa si es modificaion  en el año. Feha de actualizacion 24 SEP 2021
        if(array_key_exists('id_cs', $data)) {
            $filtro= $data["id_cs"];
            $result=$result->where('tr.id_cs', "!=", $filtro);
        }  

        if(array_key_exists('id', $data)) {
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_rep_tecnicos.id','!=',$filtro);
            });
        }
        
        $result=$result->orderBy('t_tramites_rep_tecnicos.id','DESC');
        return $result;
    }

    public static function getRepresentantesTecnico($data=[])
    {
        $result = T_Tramite_Rep_Tecnico::select(
            't_tramites_rep_tecnicos.id',
            't_tramites_rep_tecnicos.id_registro_tmp',
            't_tramites_rep_tecnicos.num_constancia',
            't_tramites_rep_tecnicos.id_tipo_constancia',
            't_tramites_rep_tecnicos.cedula',
            't_tramites_rep_tecnicos.especialidades',
            'd_personales.nombre',
            'd_personales.ap_paterno',
            'd_personales.ap_materno',
            'd_personales.curp',
            //'d_personales.rfc',
            'c_colegios.nombre as colegio',            
            'c_profesiones.nombre as profesion'
        );
        $result=$result->Join('d_personales', 't_tramites_rep_tecnicos.id_d_personal', '=', 'd_personales.id');        
        //$result=$result->Join('d_domicilios', 'd_personales.id_d_domicilio', '=', 'd_domicilios.id');
        $result=$result->Join('c_colegios', 't_tramites_rep_tecnicos.id_colegio', '=', 'c_colegios.id');
        $result=$result->Join('c_profesiones', 'c_profesiones.id', '=', 't_tramites_rep_tecnicos.id_profesion');

        if(array_key_exists('id_tramite', $data)){
            $filtro= $data["id_tramite"];
            $result= $result->where( function($sql) use ($filtro) {
                $sql->where('t_tramites_rep_tecnicos.id_tramite', $filtro);
            });
        }
        if(array_key_exists('id_tipo_constancia', $data)) {
            $filtro= $data["id_tipo_constancia"];
            $result= $result->where( function($sql) use ($filtro) {
                $sql->where('t_tramites_rep_tecnicos.id_tipo_constancia','=',$filtro);
            });
        }
        if(array_key_exists('anio', $data)){
            $filtro= $data["anio"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->whereRaw('YEAR(t_tramites_rep_tecnicos.created_at)='.$filtro);
            });
        }        
        if(array_key_exists('curp', $data)){
            $filtro= $data["curp"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('d_personales.curp','=',$filtro);
            });
        }
        if(array_key_exists('id_registro_tmp', $data)){
            $filtro= $data["id_registro_tmp"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_rep_tecnicos.id_registro_tmp','=',$filtro);
            });
        }    
        if(array_key_exists('id', $data)){
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_tramites_rep_tecnicos.id','!=',$filtro);
            });
        }
        $result=$result->orderBy('t_tramites_rep_tecnicos.id','DESC');
        return $result;
    }

    public static function edit($id)
    {
        $result = T_Tramite_Rep_Tecnico::select('t_tramites_rep_tecnicos.*', 'p.nombre', 'p.ap_paterno', 'ap_materno', 'p.curp', 'p.rfc', 'p.id_nacionalidad', 'pais.nacionalidad', 'p.sexo', 'p.telefono', 'p.correo_electronico', 'p.id_tipo_identificacion', 'ti.nombre as tipo_identificacion','p.numero_identificacion', 'dp.id as id_domicilio_particular', 'mp.id_estado as id_estado_particular', 'dp.id_municipio as id_municipio_particular', 'dp.ciudad as ciudad_particular', 'dp.calle as calle_particular', 'dp.num_exterior  as ext_particular', 'dp.num_interior  as int_particular', 'dp.colonia as colonia_particular', 'dp.codigo_postal as cp_particular', 'dp.referencias as referencias_particular', 'p.id_d_domicilio', 'prof.nombre as profesion', 'col.nombre as colegio');
        $result=$result->leftJoin('d_personales as p', 'p.id', '=', 't_tramites_rep_tecnicos.id_d_personal');
        $result=$result->leftJoin('c_pais as pais', 'pais.id', '=', 'p.id_nacionalidad');
        $result=$result->leftJoin('c_tipos_identificacion as ti', 'ti.id', '=', 'p.id_tipo_identificacion');
        $result=$result->leftJoin('d_domicilios as dp', 'dp.id', '=', 'p.id_d_domicilio');    
        $result=$result->leftJoin('c_municipios as mp', 'mp.id', '=', 'dp.id_municipio');     
        $result=$result->leftJoin('c_profesiones as prof', 'prof.id', '=', 't_tramites_rep_tecnicos.id_profesion');
        $result=$result->leftJoin('c_colegios as col', 'col.id', '=', 't_tramites_rep_tecnicos.id_colegio');
        $result=$result->where('t_tramites_rep_tecnicos.id', $id);
        $result=$result->orderBy('t_tramites_rep_tecnicos.id', 'desc')->first();
        return $result;
    }   
    
    public static function edit_rtec($id)
    {
        $result = T_Tramite_Rep_Tecnico::select('t_tramites_rep_tecnicos.*', 'p.nombre', 'p.ap_paterno', 'ap_materno', 'p.curp', 'p.rfc', 'p.id_nacionalidad', 'pais.nacionalidad', 'p.sexo', 'p.telefono', 'p.correo_electronico', 'p.id_tipo_identificacion', 'ti.nombre as tipo_identificacion','p.numero_identificacion', 'dp.id as id_domicilio_particular', 'mp.id_estado as id_estado_particular', 'dp.id_municipio as id_municipio_particular', 'dp.ciudad as ciudad_particular', 'dp.calle as calle_particular', 'dp.num_exterior  as ext_particular', 'dp.num_interior  as int_particular', 'dp.colonia as colonia_particular', 'dp.codigo_postal as cp_particular', 'dp.referencias as referencias_particular', 'p.id_d_domicilio', 'prof.nombre as profesion', 'col.nombre as colegio');
        $result=$result->leftJoin('d_personales as p', 'p.id', '=', 't_tramites_rep_tecnicos.id_d_personal');
        $result=$result->leftJoin('c_pais as pais', 'pais.id', '=', 'p.id_nacionalidad');
        $result=$result->leftJoin('c_tipos_identificacion as ti', 'ti.id', '=', 'p.id_tipo_identificacion');
        $result=$result->leftJoin('d_domicilios as dp', 'dp.id', '=', 'p.id_d_domicilio');    
        $result=$result->leftJoin('c_municipios as mp', 'mp.id', '=', 'dp.id_municipio');     
        $result=$result->leftJoin('c_profesiones as prof', 'prof.id', '=', 't_tramites_rep_tecnicos.id_profesion');
        $result=$result->leftJoin('c_colegios as col', 'col.id', '=', 't_tramites_rep_tecnicos.id_colegio');
        $result=$result->where('t_tramites_rep_tecnicos.id', $id);
        $result=$result->orderBy('t_tramites_rep_tecnicos.id', 'desc')->first();
        return $result;
    }   
    
    //OEM
    public static function top_rtecs($data=[])
    {
        $result=T_Tramite_Rep_Tecnico::select('t_tramites_rep_tecnicos.id', DB::raw('concat_ws(" ", p.nombre, p.ap_paterno, p.ap_materno) as nombre_completo'),'p.curp',DB::raw('count(DISTINCT id_tramite) as total'));        
        $result=$result->join('d_personales as p', 'p.id', '=', 't_tramites_rep_tecnicos.id_d_personal');
        $result=$result->join('t_tramites as t', 't.id', '=', 't_tramites_rep_tecnicos.id_tramite');
        $result=$result->join('c_tipos_tramite as c_tipo', 'c_tipo.id', '=', 't.id_tipo_tramite');
        $result=$result->join('c_status as s', 's.id', '=', 't.id_status');
        $result=$result->join('t_registro as reg', 'reg.id', '=', 't.id_cs');
        
        if(array_key_exists('anio', $data)){
            $filtro= $data["anio"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->whereRaw('YEAR(t_tramites_rep_tecnicos.created_at)='.$filtro);
            });
        }
        $result=$result->where('curp','!=','');
        $result=$result->groupBy('curp');    
        $result=$result->orderBy('total','DESC')->limit(10);
        return $result;
    }
    
    //segunda pantralla de detalles de todos los tramites de esa persona
    public static function detalle_top_rtecs($data=[])
    {
        $result=T_Tramite_Rep_Tecnico::select('t_tramites_rep_tecnicos.id', DB::raw('concat_ws(" ", p.nombre, p.ap_paterno, p.ap_materno) as nombre_completo'),'p.curp','t.folio','c_tipo.nombre as tipo','s.nombre as status','reg.razon_social_o_nombre as empresa');        
        $result=$result->join('d_personales as p', 'p.id', '=', 't_tramites_rep_tecnicos.id_d_personal');
        $result=$result->join('t_tramites as t', 't.id', '=', 't_tramites_rep_tecnicos.id_tramite');
        $result=$result->join('c_tipos_tramite as c_tipo', 'c_tipo.id', '=', 't.id_tipo_tramite');
        $result=$result->join('c_status as s', 's.id', '=', 't.id_status');
        $result=$result->join('t_registro as reg', 'reg.id', '=', 't.id_cs');

        if(array_key_exists('curp', $data)){
            $filtro= $data["curp"];
            $result= $result->where( function($sql) use ($filtro) {
                $sql->where('p.curp','=',$filtro);
            });
        } 
        
        if(array_key_exists('anio', $data)){
            $filtro= $data["anio"];
            $result= $result->where( function($sql) use ($filtro) {
                $sql->whereRaw('YEAR(t_tramites_rep_tecnicos.created_at)='.$filtro);
            });
        }
        
        $result=$result->groupBy('t_tramites_rep_tecnicos.id_tramite');
        $result=$result->orderBy('t_tramites_rep_tecnicos.id','DESC');
        return $result;
    }
    //FIN OEM
}
