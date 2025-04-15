<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Models\Backend\T_Tramite;
use App\Http\Models\Backend\T_Tramite_Documentacion;

class C_Documentacion extends Model
{
    use SoftDeletes;
    protected $dates    = ['deleted_at'];
    protected $table    = 'c_documentacion';
    protected $fillable = [
        'id', 
        'id_sujeto', 
        'id_area', 
        'nombre',
        'id_padre',
        'tiene_hijos',
        'tiene_opcionales',
        'subir_n',
        'obligatorio',
        'id_tipo_persona',
        'tec_acredita',
        'subir_documento',
        'inscripcion',
        'actualizacion',
        'modificacion',
        'nombre_largo',
        'nota',
        'orden',
        'obligado_dec_isr',
        'articulo',
    ];

    protected $hidden = [
        //'id',
    ];


    public static function documentacion_tramite_area($id_tipo_tramite, $id_sujeto, $id_tramite, $id_area_especifica=0, $id_tipo_persona=0, $tec_acredita_tmp=0)
     { 
        $documentos = self::documentos_requeridos($id_tipo_tramite, $id_sujeto, $id_tipo_persona, $id_area_especifica, 0, $tec_acredita_tmp);
        $documentos_requeridos= [];
        foreach ( $documentos as $documento ) {
            $array= [];
            $tramite_documento=T_Tramite_Documentacion::documentacion_tramite_requerida_tmp($id_tramite, $documento->id);
            $array=[
                "id"=> $documento->id,
                "tiene_opcionales"=>$documento->tiene_opcionales,
                "obligatorio"=> $documento->obligatorio,
                "subir_n"=>$documento->subir_n,
                "documento"=> $documento->nombre,
                "id_padre"=> $documento->id_padre,
                "id_tramite_documento"=>null,
                "id_tramite_documentacion"=>null,
                "descarga"=>null,
                "subir"=>$documento->subir_documento,
                "tiene_hijos"=>$documento->tiene_hijos,
                "hijos"=>null,
                "id_status_area_legal"=>null,
                "id_status_area_tecnica"=>null,
                "id_status_area_financiera"=>null,
                "id_tramite"=>$id_tramite,
                'desglose'=>null,
                'alias'=>null
            ];
         
            $tramitex=T_Tramite::find($id_tramite);
            $array["id_status_area_legal"]= $tramitex->id_status_area_legal;
            $array["id_status_area_tecnica"]= $tramitex->id_status_area_tecnica;
            $array["id_status_area_financiera"]= $tramitex->id_status_area_financiera;
            
            if ( $documento->subir_n == 1 ) {
                $tramites_documento_hijo1=T_Tramite_Documentacion::documentacion_tramite_requerida_opcional_tmp($id_tramite, $documento->id);
                $array_n=[];
                foreach ($tramites_documento_hijo1 as $tramite_documento_hijo_1) {
                    $array_hijos1n= [];
                    $idd1=$tramite_documento_hijo_1->id;
                    $idd2=$tramite_documento_hijo_1->id_documentacion;
                    $idd3=$tramite_documento_hijo_1->path."/".$tramite_documento_hijo_1->nombre.".".$tramite_documento_hijo_1->extension;
                    $idd4=json_decode($tramite_documento_hijo_1->desglose);
                    $idd5=$tramite_documento_hijo_1->alias;
                    
                    $array_hijos1n=[
                        "id"=> $documento->id,
                        "id_tramite"=>$id_tramite,
                        "tiene_opcionales"=>$documento->tiene_opcionales,
                        "obligatorio"=> $documento->obligatorio,
                        "subir_n"=>$documento->subir_n,
                        "documento"=> $documento->nombre,
                        "id_padre"=> $documento->id_padre,
                        "id_tramite_documento"=>$idd1,
                        "id_tramite_documentacion"=>$idd2,
                        "descarga"=>$idd3,
                        "subir"=>$documento->subir_documento,
                        "tiene_hijos"=>$documento->tiene_hijos,
                        "hijos"=>null,
                        'desglose'=>$idd4,
                        'alias'=>$idd5
                    ];

                    array_push($array_n, $array_hijos1n);                 
                }  
                $array["hijos"]= $array_n;
            }
            else {
                if ( $tramite_documento != null ) {
                    $array["id_tramite_documento"]= $tramite_documento->id;
                    $array["id_tramite_documentacion"]= $tramite_documento->id_documentacion;
                    $array["descarga"]= $tramite_documento->path."/".$tramite_documento->nombre.".".$tramite_documento->extension;
                    $array["desglose"]= json_decode($tramite_documento->desglose);
                    $array["alias"]= $tramite_documento->alias;                    
                }
            }
            //Hijos 1
            if ( $documento->tiene_hijos == 1 ) {
                $array["hijos"]= self::get_hijos($id_tramite, $id_tipo_tramite, $id_sujeto, $id_tipo_persona, $id_area_especifica, $documento->id, $tec_acredita_tmp);
            }
            array_push($documentos_requeridos, $array);
        }
        return $documentos_requeridos; 
    } 

    public static function lists()
    {
        $result = C_Documentacion::orderBy('nombre', 'ASC')->pluck('nombre', 'id', 'deleted_at')->prepend('Seleccionar', 0)->all();
        return $result;
    }

    public static function lists_opcionales($data = [])
    {
        $result = C_Documentacion::select('*');
        if (array_key_exists('id_padre', $data)) {
            $filtro = $data["id_padre"];
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('id_padre', $filtro)->where("subir_n", 1);
            });
        }
        $result = $result->orderBy('nombre', 'ASC')->pluck('nombre', 'id', 'deleted_at')->prepend('Seleccionar', 0)->all();
        return $result;
    }

    public static function documentos_obligatorios($id_tipo_tramite, $id_sujeto, $id_tipo_persona = 0, $id_area_especifica = 0, $obligado_dec_isr = 0)
    {
        $result = C_Documentacion::select('id')->where("obligatorio", 1)->whereNull('deleted_at');

        if ($id_sujeto != 0) {
            if ($id_area_especifica == 4) {
                $filtro = $id_sujeto;
                $result = $result->where(function ($sql) use ($filtro) {
                    $sql->where('id_sujeto', 3)->orWhere('id_sujeto', $filtro);
                });
            } else {
                $result = $result->where("id_sujeto", $id_sujeto);
            }
        }

        if ($obligado_dec_isr != 0) {
            $filtro = $obligado_dec_isr;
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('obligado_dec_isr', null)->orWhere('obligado_dec_isr', $filtro);
            });

        }

        if ($id_area_especifica != 0) {
            $result = $result->where("id_area", $id_area_especifica);
        }

        if ($id_tipo_persona != 0) {
            $filtro = $id_tipo_persona;
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('id_tipo_persona', 3)->orWhere('id_tipo_persona', $filtro);
            });

        }

        if ($id_tipo_tramite == 1) {
            $result = $result->where("inscripcion", 1);
        }
        if ($id_tipo_tramite == 2) {
            $result = $result->where("actualizacion", 1);
        }
        if ($id_tipo_tramite == 3) {
            $result = $result->where("modificacion", 1);
        }

        // $result = $result->orderBy('id_area', 'asc');
        // $result = $result->orderBy('nombre', 'asc')->get();
        $result = $result->get();

        $array = [];
        foreach ($result as $value) {

            array_push($array, $value->id);
        }
        return $array;

    }

    public static function documentos_requeridos($id_tipo_tramite, $id_sujeto, $id_tipo_persona = 0, $id_area_especifica = 0, $id_padre = 0, $obligado_dec_isr = 0)
    {

        $result = C_Documentacion::select('*')->whereNull('deleted_at');

        if ($id_sujeto != 0) {
            if ($id_area_especifica == 4) {
                $filtro = $id_sujeto;
                $result = $result->where(function ($sql) use ($filtro) {
                    $sql->where('id_sujeto', 3)->orWhere('id_sujeto', $filtro);
                });
            } else {
                $result = $result->where("id_sujeto", $id_sujeto);
            }
        }

        if ($obligado_dec_isr != 0) {
            $filtro = $obligado_dec_isr;
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('obligado_dec_isr', null)->orWhere('obligado_dec_isr', $filtro);
            });

        }

        if ($id_area_especifica != 0) {
            $result = $result->where("id_area", $id_area_especifica);
        }

        if ($id_padre != 0) {
            $result = $result->where("id_padre", $id_padre);
        } else {
            $result = $result->where("id_padre", 0);
        }

        if ($id_tipo_persona != 0) {
            $filtro = $id_tipo_persona;
            $result = $result->where(function ($sql) use ($filtro) {
                $sql->where('id_tipo_persona', 3)->orWhere('id_tipo_persona', $filtro);
            });

        }

        if ($id_tipo_tramite == 1) {
            $result = $result->where("inscripcion", 1);
        }
        if ($id_tipo_tramite == 2) {
            $result = $result->where("actualizacion", 1);
        }
        if ($id_tipo_tramite == 3) {
            $result = $result->where("modificacion", 1);
        }

        // $result = $result->orderBy('obligatorio', 'desc');

        if ($id_area_especifica == 3) {

        }
        return $result->get();
    }

    public static function get_hijos($id_registro, $id_tipo_tramite, $id_sujeto, $id_tipo_persona, $id_area_especifica, $id_padre, $tec_acredita_tmp)
    {
        $hijos_1                       = self::documentos_requeridos($id_tipo_tramite, $id_sujeto, $id_tipo_persona, $id_area_especifica, $id_padre, $tec_acredita_tmp);
        $documentos_requeridos_hijos_1 = [];

        foreach ($hijos_1 as $hijo_1) {

            $array_hijos1            = [];
            $tramite_documento_hijo1 = \App\Http\Models\Backend\T_Tramite_Documentacion::documentacion_requerida_tmp($id_registro, $hijo_1->id);
            $array_hijos1            = ["id" => $hijo_1->id, "tiene_opcionales" => $hijo_1->tiene_opcionales, "obligatorio" => $hijo_1->obligatorio, "subir_n" => $hijo_1->subir_n, "documento" => $hijo_1->nombre, "id_padre" => $hijo_1->id_padre, "id_tramite_documento" => null, "id_tramite_documentacion" => null, "descarga" => null, "subir" => $hijo_1->subir_documento, "tiene_hijos" => $hijo_1->tiene_hijos, "hijos" => null, 'desglose' => null, 'alias' => null, 'nota' => $hijo_1->nota];

            if ($hijo_1->subir_n == 1) {
                $tramites_documento_hijo1 = \App\Http\Models\Backend\T_Tramite_Documentacion::documentacion_requerida_opcional_tmp($id_registro, $hijo_1->id);
                $array_n                  = [];
                foreach ($tramites_documento_hijo1 as $tramite_documento_hijo_1) {
                    $array_hijos1n = [];
                    // if($tramite_documento_hijo_1.id==1150){print_r( 'sdsw');exit();}
                    $idd1          = $tramite_documento_hijo_1->id;
                    $idd2          = $tramite_documento_hijo_1->id_documentacion;
                    $idd3          = $tramite_documento_hijo_1->path . "/" . $tramite_documento_hijo_1->nombre . "." . $tramite_documento_hijo_1->extension;
                    $idd4          = json_decode($tramite_documento_hijo_1->desglose);
                    $idd5          = $tramite_documento_hijo_1->alias;
                    $array_hijos1n = ["id" => $hijo_1->id, "tiene_opcionales" => $hijo_1->tiene_opcionales, "obligatorio" => $hijo_1->obligatorio, "subir_n" => $hijo_1->subir_n, "documento" => $hijo_1->nombre, "id_padre" => $hijo_1->id_padre, "id_tramite_documento" => $idd1, "id_tramite_documentacion" => $idd2, "descarga" => $idd3, "subir" => $hijo_1->subir_documento, "tiene_hijos" => $hijo_1->tiene_hijos, "hijos" => null, 'desglose' => $idd4, 'alias' => $idd5, 'nota' => $hijo_1->nota];
                    array_push($array_n, $array_hijos1n);
                }
                $array_hijos1["hijos"] = $array_n;
            } else {
                if ($tramite_documento_hijo1 != null) {
                    $array_hijos1["id_tramite_documento"]     = $tramite_documento_hijo1->id;
                    $array_hijos1["id_tramite_documentacion"] = $tramite_documento_hijo1->id_documentacion;
                    $array_hijos1["descarga"]                 = $tramite_documento_hijo1->path . "/" . $tramite_documento_hijo1->nombre . "." . $tramite_documento_hijo1->extension;
                    $array_hijos1["desglose"]                 = json_decode($tramite_documento_hijo1->desglose);
                    $array_hijos1["alias"]                    = $tramite_documento_hijo1->alias;

                }
            }

            if ($hijo_1->tiene_hijos == 1) {
                $array_hijos1["hijos"] = self::get_hijos($id_registro, $id_tipo_tramite, $id_sujeto, $id_tipo_persona, $id_area_especifica, $hijo_1->id, $tec_acredita_tmp);
                array_push($documentos_requeridos_hijos_1, $array_hijos1);
            }

            array_push($documentos_requeridos_hijos_1, $array_hijos1);

        }
        return $documentos_requeridos_hijos_1;
    }

    public static function lista_documentacion_requerida($id_tipo_tramite, $id_sujeto, $id_registro, $id_area_especifica = 0, $id_tipo_persona = 0, $tec_acredita_tmp = 0)
    {

        $documentos = self::documentos_requeridos($id_tipo_tramite, $id_sujeto, $id_tipo_persona, $id_area_especifica, 0, $tec_acredita_tmp);

        $documentos_requeridos = [];
        foreach ($documentos as $documento) {
            $array             = [];
            $tramite_documento = \App\Http\Models\Backend\T_Tramite_Documentacion::documentacion_requerida_tmp($id_registro, $documento->id);
            $array             = ["id" => $documento->id, "tiene_opcionales" => $documento->tiene_opcionales, "obligatorio" => $documento->obligatorio, "subir_n" => $documento->subir_n, "documento" => $documento->nombre, "id_padre" => $documento->id_padre, "id_tramite_documento" => null, "id_tramite_documentacion" => null, "descarga" => null, "subir" => $documento->subir_documento, "tiene_hijos" => $documento->tiene_hijos, "hijos" => null, 'desglose' => null, 'alias' => null, 'nota' => $documento->nota];

            if ($documento->subir_n == 1) {
                $tramites_documento_hijo1 = \App\Http\Models\Backend\T_Tramite_Documentacion::documentacion_requerida_opcional_tmp($id_registro, $documento->id);
                $array_n                  = [];
                foreach ($tramites_documento_hijo1 as $tramite_documento_hijo_1) {
                    $array_hijos1n = [];
                    $idd1          = $tramite_documento_hijo_1->id;
                    $idd2          = $tramite_documento_hijo_1->id_documentacion;
                    $idd3          = $tramite_documento_hijo_1->path . "/" . $tramite_documento_hijo_1->nombre . "." . $tramite_documento_hijo_1->extension;
                    $idd4          = json_decode($tramite_documento_hijo_1->desglose);
                    $idd5          = $tramite_documento_hijo_1->alias;
                    $array_hijos1n = ["id" => $documento->id, "tiene_opcionales" => $documento->tiene_opcionales, "obligatorio" => $documento->obligatorio, "subir_n" => $documento->subir_n, "documento" => $documento->nombre, "id_padre" => $documento->id_padre, "id_tramite_documento" => $idd1, "id_tramite_documentacion" => $idd2, "descarga" => $idd3, "subir" => $documento->subir_documento, "tiene_hijos" => $documento->tiene_hijos, "hijos" => null, 'desglose' => $idd4, 'alias' => $idd5, 'nota' => $documento->nota];
                    array_push($array_n, $array_hijos1n);
                }
                $array["hijos"] = $array_n;

            } else {
                if ($tramite_documento != null) {
                    $array["id_tramite_documento"]     = $tramite_documento->id;
                    $array["id_tramite_documentacion"] = $tramite_documento->id_documentacion;
                    $array["descarga"]                 = $tramite_documento->path . "/" . $tramite_documento->nombre . "." . $tramite_documento->extension;
                    $array["desglose"]                 = json_decode($tramite_documento->desglose);
                    $array["alias"]                    = $tramite_documento->alias;
                }
            }
            //Hijos 1
            if ($documento->tiene_hijos == 1) {
                $array["hijos"] = self::get_hijos($id_registro, $id_tipo_tramite, $id_sujeto, $id_tipo_persona, $id_area_especifica, $documento->id, $tec_acredita_tmp);
            }

            array_push($documentos_requeridos, $array);
        }

        return $documentos_requeridos;
    }

    //Nuevo

    public static function lista_documentacion_descarga($id_tipo_tramite, $id_sujeto, $id_registro, $id_area_especifica = 0, $id_tipo_persona = 0, $tec_acredita_tmp = 0)
    {

        $documentos = self::documentos_requeridos($id_tipo_tramite, $id_sujeto, $id_tipo_persona, $id_area_especifica, 0, $tec_acredita_tmp);

        $documentos_requeridos = [];
        foreach ($documentos as $documento) {
            $array             = [];
            $tramite_documento = \App\Http\Models\Backend\T_Tramite_Documentacion::documentacion_descarga_tmp($id_registro, $documento->id);
            $array             = ["id" => $documento->id, "tiene_opcionales" => $documento->tiene_opcionales, "obligatorio" => $documento->obligatorio, "subir_n" => $documento->subir_n, "documento" => $documento->nombre, "id_padre" => $documento->id_padre, "id_tramite_documento" => null, "id_tramite_documentacion" => null, "descarga" => null, "subir" => $documento->subir_documento, "tiene_hijos" => $documento->tiene_hijos, "hijos" => null, 'desglose' => null, 'alias' => null];

            if ($documento->subir_n == 1) {
                $tramites_documento_hijo1 = \App\Http\Models\Backend\T_Tramite_Documentacion::documentacion_descarga_opcional_tmp($id_registro, $documento->id);
                $array_n                  = [];
                foreach ($tramites_documento_hijo1 as $tramite_documento_hijo_1) {
                    $array_hijos1n = [];
                    $idd1          = $tramite_documento_hijo_1->id;
                    $idd2          = $tramite_documento_hijo_1->id_documentacion;
                    $idd3          = $tramite_documento_hijo_1->path . "/" . $tramite_documento_hijo_1->nombre . "." . $tramite_documento_hijo_1->extension;
                    $idd4          = json_decode($tramite_documento_hijo_1->desglose);
                    $idd5          = $tramite_documento_hijo_1->alias;
                    $array_hijos1n = ["id" => $documento->id, "tiene_opcionales" => $documento->tiene_opcionales, "obligatorio" => $documento->obligatorio, "subir_n" => $documento->subir_n, "documento" => $documento->nombre, "id_padre" => $documento->id_padre, "id_tramite_documento" => $idd1, "id_tramite_documentacion" => $idd2, "descarga" => $idd3, "subir" => $documento->subir_documento, "tiene_hijos" => $documento->tiene_hijos, "hijos" => null, 'desglose' => $idd4, 'alias' => $idd5];
                    array_push($array_n, $array_hijos1n);
                }
                $array["hijos"] = $array_n;

            } else {
                if ($tramite_documento != null) {
                    $array["id_tramite_documento"]     = $tramite_documento->id;
                    $array["id_tramite_documentacion"] = $tramite_documento->id_documentacion;
                    $array["descarga"]                 = $tramite_documento->path . "/" . $tramite_documento->nombre . "." . $tramite_documento->extension;
                    $array["desglose"]                 = json_decode($tramite_documento->desglose);
                    $array["alias"]                    = $tramite_documento->alias;
                }
            }
            //Hijos 1
            if ($documento->tiene_hijos == 1) {
                $array["hijos"] = self::get_hijos_descarga($id_registro, $id_tipo_tramite, $id_sujeto, $id_tipo_persona, $id_area_especifica, $documento->id, $tec_acredita_tmp);
            }

            array_push($documentos_requeridos, $array);
        }

        return $documentos_requeridos;
    }

    public static function get_hijos_descarga($id_registro, $id_tipo_tramite, $id_sujeto, $id_tipo_persona, $id_area_especifica, $id_padre, $tec_acredita_tmp)
    {
        $hijos_1                       = self::documentos_requeridos($id_tipo_tramite, $id_sujeto, $id_tipo_persona, $id_area_especifica, $id_padre, $tec_acredita_tmp);
        $documentos_requeridos_hijos_1 = [];

        foreach ($hijos_1 as $hijo_1) {

            $array_hijos1            = [];
            $tramite_documento_hijo1 = \App\Http\Models\Backend\T_Tramite_Documentacion::documentacion_descarga_tmp($id_registro, $hijo_1->id);
            $array_hijos1            = ["id" => $hijo_1->id, "tiene_opcionales" => $hijo_1->tiene_opcionales, "obligatorio" => $hijo_1->obligatorio, "subir_n" => $hijo_1->subir_n, "documento" => $hijo_1->nombre, "id_padre" => $hijo_1->id_padre, "id_tramite_documento" => null, "id_tramite_documentacion" => null, "descarga" => null, "subir" => $hijo_1->subir_documento, "tiene_hijos" => $hijo_1->tiene_hijos, "hijos" => null, 'desglose' => null, 'alias' => null];

            if ($hijo_1->subir_n == 1) {
                $tramites_documento_hijo1 = \App\Http\Models\Backend\T_Tramite_Documentacion::documentacion_descarga_opcional_tmp($id_registro, $hijo_1->id);
                $array_n                  = [];
                foreach ($tramites_documento_hijo1 as $tramite_documento_hijo_1) {
                    $array_hijos1n = [];
                    $idd1          = $tramite_documento_hijo_1->id;
                    $idd2          = $tramite_documento_hijo_1->id_documentacion;
                    $idd3          = $tramite_documento_hijo_1->path . "/" . $tramite_documento_hijo_1->nombre . "." . $tramite_documento_hijo_1->extension;
                    $idd4          = json_decode($tramite_documento_hijo_1->desglose);
                    $idd5          = $tramite_documento_hijo_1->alias;
                    $array_hijos1n = ["id" => $hijo_1->id, "tiene_opcionales" => $hijo_1->tiene_opcionales, "obligatorio" => $hijo_1->obligatorio, "subir_n" => $hijo_1->subir_n, "documento" => $hijo_1->nombre, "id_padre" => $hijo_1->id_padre, "id_tramite_documento" => $idd1, "id_tramite_documentacion" => $idd2, "descarga" => $idd3, "subir" => $hijo_1->subir_documento, "tiene_hijos" => $hijo_1->tiene_hijos, "hijos" => null, 'desglose' => $idd4, 'alias' => $idd5];
                    array_push($array_n, $array_hijos1n);
                }
                $array_hijos1["hijos"] = $array_n;
            } else {
                if ($tramite_documento_hijo1 != null) {
                    $array_hijos1["id_tramite_documento"]     = $tramite_documento_hijo1->id;
                    $array_hijos1["id_tramite_documentacion"] = $tramite_documento_hijo1->id_documentacion;
                    $array_hijos1["descarga"]                 = $tramite_documento_hijo1->path . "/" . $tramite_documento_hijo1->nombre . "." . $tramite_documento_hijo1->extension;
                    $array_hijos1["desglose"]                 = json_decode($tramite_documento_hijo1->desglose);
                    $array_hijos1["alias"]                    = $tramite_documento_hijo1->alias;

                }
            }

            if ($hijo_1->tiene_hijos == 1) {
                $array_hijos1["hijos"] = self::get_hijos_descarga($id_registro, $id_tipo_tramite, $id_sujeto, $id_tipo_persona, $id_area_especifica, $hijo_1->id, $tec_acredita_tmp);
                array_push($documentos_requeridos_hijos_1, $array_hijos1);
            }

            array_push($documentos_requeridos_hijos_1, $array_hijos1);

        }
        return $documentos_requeridos_hijos_1;
    }

}
