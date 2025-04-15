<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class T_Tramite_Legal_Representante_Legal extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {        
        $rules=[  
            'dlrepl_nombre' =>'required', 
            'dlrepl_ap_paterno' =>'required', 
            'dlrepl_ap_materno' =>'required', 
            'dlrepl_curp' =>'required', 
            'dlrepl_rfc' =>'required', 
            'dlrepl_id_nacionalidad' =>'not_zero', 
            'dlrepl_telefono' =>'required', 
            'dlrepl_correo_electronico' =>'required|email', 
            'dlrepl_id_tipo_identificacion' =>'not_zero',
            'dlrepl_numero_identificacion' =>'required',

            'dlrepl_id_estado_particular' =>'not_zero',
            'dlrepl_id_municipio_particular' =>'not_zero', 
            //'dlrepl_ciudad_particular' =>'required',
            'dlrepl_ext_particular' =>'required',
            //'dlrepl_int_particular' =>'required',
            'dlrepl_colonia_particular' =>'required',
            'dlrepl_cp_particular' =>'required',            

            'dlrepl_num_escritura' =>'required',
            'dlrepl_fecha_escritura' =>'required|date_format:d/m/Y',
            'dlrepl_notario_nombre' =>'required',
            'dlrepl_notario_numero' =>'required',
            'dlrepl_id_estado' =>'required|not_zero',
            'dlrepl_num_registro_publico' =>'required',
            'dlrepl_seccion' =>'required',
            'dlrepl_ciudad' =>'required',
            'dlrepl_fecha_registro_publico' =>'required|date_format:d/m/Y',
            'dlrepl_id_estado_registro' =>'required|not_zero'
        ];
        return $rules;
    }
}
