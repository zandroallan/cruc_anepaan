<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class T_Tramite_Tecnica_Representante_Tecnico extends FormRequest
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
            'dtrtec_nombre' =>'required', 
            'dtrtec_ap_paterno' =>'required', 
            'dtrtec_ap_materno' =>'required', 
            'dtrtec_curp' =>'required', 
            //'dtrtec_rfc' =>'required', 
            //'dtrtec_id_nacionalidad' =>'not_zero', 
            //'dtrtec_telefono' =>'required', 
            //'dtrtec_correo_electronico' =>'required|email', 
            //'dtrtec_id_tipo_identificacion' =>'not_zero',
            //'dtrtec_numero_identificacion' =>'required',

            //'dtrtec_id_estado_particular' =>'not_zero',
            //'dtrtec_id_municipio_particular' =>'not_zero',
            //'dtrtec_ciudad_particular' =>'required',
            //'dtrtec_ext_particular' =>'required',
            //'dtrtec_int_particular' =>'required',
            //'dtrtec_colonia_particular' =>'required',
            //'dtrtec_cp_particular' =>'required',            

            'dtrtec_id_profesion' =>'required|not_zero',
            'dtrtec_id_colegio' =>'required|not_zero',
            'dtrtec_num_constancia' =>'required',
            'dtrtec_cedula' =>'required',
            'dtrtec_fecha_cedula' =>'required|date_format:Y-m-d'
        ];
        return $rules;
    }
}
