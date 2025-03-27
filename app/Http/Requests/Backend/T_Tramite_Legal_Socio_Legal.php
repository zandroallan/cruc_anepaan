<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class T_Tramite_Legal_Socio_Legal extends FormRequest
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
            'dlscs_nombre' =>'required', 
            'dlscs_ap_paterno' =>'required', 
            'dlscs_ap_materno' =>'required', 
            'dlscs_curp' =>'required', 
            'dlscs_rfc' =>'required', 
            'dlscs_id_nacionalidad' =>'not_zero', 
            'dlscs_telefono' =>'required', 
            'dlscs_correo_electronico' =>'required|email', 
            'dlscs_id_tipo_identificacion' =>'not_zero',
            'dlscs_numero_identificacion' =>'required',

            'dlscs_id_estado_particular' =>'not_zero',
            'dlscs_id_municipio_particular' =>'not_zero',
            'dlscs_ciudad_particular' =>'required',
            'dlscs_ext_particular' =>'required',
            //'dlscs_int_particular' =>'required',
            'dlscs_colonia_particular' =>'required',
            'dlscs_cp_particular' =>'required',
        ];
        return $rules;
    }
}
