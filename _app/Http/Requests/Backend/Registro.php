<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class Registro extends FormRequest
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
        $id_tipo_persona= $this->request->get('id_tipo_persona');
        $rules=[
            //'nombre' =>'required', 
            //'ap_paterno' =>'required', 
            //'ap_materno' =>'required', 
            //'curp' =>'required', 
            //'rfc' =>'required', 
            'id_nacionalidad' =>'not_zero', 
            'telefono' =>'required', 
            'correo' =>'required|email', 
            'id_tipo_identificacion' =>'not_zero',
            'numero_identificacion' =>'required',

            'id_estado_particular' =>'not_zero',
            'id_municipio_particular' =>'not_zero',
            /*'ciudad_particular' =>'required',*/
            'ext_particular' =>'required',
            /*'int_particular' =>'required',*/
            'colonia_particular' =>'required',
            'cp_particular' =>'required',

            'id_estado_fiscal' =>'not_zero',
            'id_municipio_fiscal' =>'not_zero',
            /*'ciudad_fiscal' =>'required',*/
            'ext_fiscal' =>'required',
            /*'int_fiscal' =>'required',*/
            'colonia_fiscal' =>'required',
            'cp_fiscal' =>'required',            
			'folio_pago_temp'=>'required',
            'fecha_pago_temp'=>'required',
        ];

        if($id_tipo_persona==2){
            $rules=[
                //'razon_social_o_nombre' =>'required',
                //'rfc' =>'required',                 
                'telefono' =>'required', 
                'correo' =>'required',
    
                'id_estado_fiscal' =>'not_zero',
                'id_municipio_fiscal' =>'not_zero',
                /*'ciudad_fiscal' =>'required',*/
                'ext_fiscal' =>'required',
                /*'int_fiscal' =>'required',*/
                'colonia_fiscal' =>'required',
                'cp_fiscal' =>'required',
				'folio_pago_temp'=>'required',
                'fecha_pago_temp'=>'required',
    
            ];
        }

        return $rules;
    }
}
