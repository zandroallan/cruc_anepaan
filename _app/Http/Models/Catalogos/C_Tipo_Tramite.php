<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class C_Tipo_Tramite extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_tipos_tramite';
    protected $fillable = [
        'id', 
        'activo', 
        'nombre',  	
        'documentos_contratistas', 
        'documentos_supervisores '
    ];

    protected $hidden = [
        //'id',
    ];

    public static function lists(){
        $result= C_Tipo_Tramite::orderBy('nombre','ASC')->pluck('nombre','id','deleted_at')->prepend('Seleccionar', 0)->all();
        return $result;
    }

    public static function documentacion($id_tipo_tramite, $id_sujeto){
        $result = C_Tipo_Tramite::find($id_tipo_tramite);
        $ar_doctos= []; $array= []; $array_legal= []; $array_tecnica= []; $array_financiera= [];

        ($id_sujeto==1) ? $array= json_decode($result->documentos_contratistas) : $array= json_decode($result->documentos_supervisores);

        foreach($array as $ar){
            // $documentacion = \App\Http\Models\Catalogos\C_Documentacion::find($ar);
            $documentacion = \App\Http\Models\Catalogos\C_Documentacion::where('id', $ar)->whereNull('deleted_at')->first();




            $arr= ['id'=>$documentacion->id, 'id_area'=> $documentacion->id_area, 'nombre'=>$documentacion->nombre];
            if($documentacion->id_area==2){ array_push($array_legal, $arr); }
            if($documentacion->id_area==3){ array_push($array_financiera, $arr); }   
            if($documentacion->id_area==4){ array_push($array_tecnica, $arr); }

        }
        $ar_doctos["2"]= $array_legal;
        $ar_doctos["3"]= $array_financiera;
        $ar_doctos["4"]= $array_tecnica;
        //array_push($ar_doctos, $array_legal,$array_financiera, $array_tecnica);
        return $ar_doctos;
    }

    public static function documentacion_requerida($id_tipo_tramite, $id_sujeto)
    {
        $result = C_Tipo_Tramite::find($id_tipo_tramite);
        $ar_doctos= []; $array= []; $array_legal= []; $array_tecnica= []; $array_financiera= [];

        ($id_sujeto==1) ? $array= json_decode($result->documentos_contratistas) : $array= json_decode($result->documentos_supervisores);

        return $array;
    } 
    
    public static function documentacion_requerida_combo($id_tipo_tramite, $id_sujeto)
    {
        $result = C_Tipo_Tramite::find($id_tipo_tramite);        
        $ar_doctos= []; $array= []; $array_legal= []; $array_tecnica= []; $array_financiera= [];

        ($id_sujeto==1) ? $array= json_decode($result->documentos_contratistas) : $array= json_decode($result->documentos_supervisores);

        foreach($array as $value){
            // $documento= \App\Http\Models\Catalogos\C_Documentacion::find($value);            
            $documento= \App\Http\Models\Catalogos\C_Documentacion::where('id', $value)->whereNull('deleted_at')->first();               
            switch($documento->id_area){
                case 2:
                    $array_legal[$documento->id]= strip_tags($documento->nombre);
                    break;
                case 3:
                    $array_financiera[$documento->id]= strip_tags($documento->nombre);
                    break;
                case 4:
                    $array_tecnica[$documento->id]= strip_tags($documento->nombre);
                    break;                                         
            }  
        }

        $ar_doctos["Área legal"]= $array_legal;
        $ar_doctos["Área financiera"]= $array_financiera;
        $ar_doctos["Área técnica"]= $array_tecnica;
        
        return $ar_doctos;
    }
    
    public static function documentacion_requerida_t_combo($id_tramite)
    {
        $result = \App\Http\Models\Backend\T_Tramite::find($id_tramite);        
        $ar_doctos= []; $array= []; $array_legal= []; $array_tecnica= []; $array_financiera= [];
        $array= json_decode($result->documentacion_recibida);       

        foreach($array as $value){
            // $documento= \App\Http\Models\Catalogos\C_Documentacion::find($value);            
            $documento= \App\Http\Models\Catalogos\C_Documentacion::where('id', $value)->whereNull('deleted_at')->first();       
            switch($documento->id_area){
                case 2:
                    $array_legal[$documento->id]= strip_tags($documento->nombre);
                    break;
                case 3:
                    $array_financiera[$documento->id]= strip_tags($documento->nombre);
                    break;
                case 4:
                    $array_tecnica[$documento->id]= strip_tags($documento->nombre);
                    break;                                         
            }  
        }

        $ar_doctos["Área legal"]= $array_legal;
        $ar_doctos["Área financiera"]= $array_financiera;
        $ar_doctos["Área técnica"]= $array_tecnica;
        
        return $ar_doctos;
    }          
    
    public static function documentacion_recibida_docs($id_tramite)
    {        
        $result = \App\Http\Models\Backend\T_Tramite_Documentacion::select('*')->where('id_tramite', $id_tramite)->groupBy('id_documentacion')->orderBy('id_documentacion', 'asc')->get();       
        $ar_doctos= []; $array= []; $array_legal= []; $array_tecnica= []; $array_financiera= [];
       
        foreach($result as $value){
            if($value->id_documentacion != 163 && $value->id_documentacion != 162 && $value->id_documentacion != 275)   
            {
                // $documento= \App\Http\Models\Catalogos\C_Documentacion::find($value->id_documentacion); 
                $documento= \App\Http\Models\Catalogos\C_Documentacion::where('id', $value->id_documentacion)->whereNull('deleted_at')->first();    
            
                switch($documento->id_area){
                    case 2:
                        $array_legal[$value->id]= strip_tags($documento->nombre);
                        break;
                    case 3:
                        if($documento->id==266){$array_financiera[$value->id]= strip_tags('(Cuenta) ' . $value->alias);}
                        else{$array_financiera[$value->id]= strip_tags($documento->nombre);}
                        break;
                    case 4:
                        $array_tecnica[$value->id]= strip_tags($documento->nombre);
                        break;                                         
                }
            }  
       
        }
        $ar_doctos["Área legal"]= $array_legal;
        $ar_doctos["Área financiera"]= $array_financiera;
        $ar_doctos["Área técnica"]= $array_tecnica;
       
        return $ar_doctos;
    } 
}