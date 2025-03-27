<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CrearCuenta extends FormRequest
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
            'nombre' =>'required', 
            'ap_paterno' =>'required', 
            'ap_materno' =>'required', 
            'curp' =>'required', 
            'rfc' =>'required', 
            'id_nacionalidad' =>'not_zero', 
            'telefono' =>'required', 
            'correo' =>'required|email', 
            'id_tipo_identificacion' =>'not_zero',
            'numero_identificacion' =>'required',
            'password_confirmation'=>'required',
            'password'=>[
                'required',
                'string',
                'confirmed',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&.]/', // must contain a special character
            ],             
        ];

        if($id_tipo_persona==2){
            $rules=[
                'razon_social_o_nombre' =>'required',
                'rfc' =>'required',                 
                'telefono' =>'required', 
                'correo' =>'required|email',   
                'nickname'=>'required',
                'password_confirmation'=>'required',
                'password'=>[
                    'required',
                    'string',
                    'confirmed',
                    'min:10',             // must be at least 10 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&.]/', // must contain a special character
                ],                         
    
            ];
        }

        return $rules;
    }

    public function messages()
    {
        $id_tipo_persona= $this->request->get('id_tipo_persona');
        $msg= [
                /*'codigo_activacion.required' => 'Este campo es obligatorio',*/
                'nombre.required' => 'Este campo es obligatorio',
                'ap_paterno.required' => 'Este campo es obligatorio',
                'ap_materno.required' => 'Este campo es obligatorio',
                'curp.required' => 'Este campo es obligatorio',
                'rfc.required' => 'Este campo es obligatorio',
                'id_nacionalidad.not_zero' => 'Este campo es obligatorio',
                'telefono.required' => 'Este campo es obligatorio',
                'correo.required' => 'Este campo es obligatorio',
                'correo.email' => 'Este campo no tiene el formato de un correo electrónico',
                'id_tipo_identificacion.not_zero' => 'Este campo es obligatorio',
                'numero_identificacion.required' => 'Este campo es obligatorio',
                'nickname.required' => 'Este campo es obligatorio',
                'password.required' => 'Este campo es obligatorio',
                'password_confirmation.required' => 'Este campo es obligatorio',
                'password.min' => 'El campo debe contener al menos 10 caracteres',
                'password.regex' => 'El campo no cumple con el formato establecido',
                'password.confirmed' => 'El password de confirmación no es el mismo',
               ];

        if($id_tipo_persona==2){
            $msg= [
                    /*'codigo_activacion.required' => 'Este campo es obligatorio',*/
                    'razon_social_o_nombre.required' => 'Este campo es obligatorio',                   
                    'rfc.required' => 'Este campo es obligatorio',                    
                    'telefono.required' => 'Este campo es obligatorio',
                    'correo.required' => 'Este campo es obligatorio',
                    'correo.email' => 'Este campo no tiene el formato de un correo electrónico',
                    'nickname.required' => 'Este campo es obligatorio',
                    'password.required' => 'Este campo es obligatorio',
                    'password.min' => 'El campo debe contener al menos 10 caracteres',
                    'password.regex' => 'El campo no cumple con el formato establecido',
                    'password.confirmed' => 'El password de confirmación no es el mismo',
                   ];            
        }

        return $msg;
    }    
}
