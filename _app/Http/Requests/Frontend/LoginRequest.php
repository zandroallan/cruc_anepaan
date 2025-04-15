<?php

namespace App\Http\Requests\Frontend;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize() {
        return true;
    }

    public function rules()
    {        
        $t1= [ 
                'nickname' =>'required', 
                'password'=>'required'                
            ];    

        return $t1;
    }
}
