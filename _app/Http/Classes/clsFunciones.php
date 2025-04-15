<?php
namespace App\Http\Classes;

class clsFunciones {
    public static function generaCodigo(){
        //Se define una cadena de caractares. Te recomiendo que uses esta.
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        //Obtenemos la longitud de la cadena de caracteres
        $longitudCadena=strlen($cadena);

        //Se define la variable que va a contener el codigo
        $codigo = "";
        //Se define la longitud de la contraseña, en mi caso 8, pero puedes poner la longitud que quieras
        $longitudCodigo=8;

        //Creamos la contraseña
        for($i=1 ; $i<=$longitudCodigo ; $i++){
            //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
            $pos=rand(0,$longitudCadena-1);

            //Vamos formando el codigo en cada iteraccion del bucle, añadiendo a la cadena $codigo la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
            $codigo .= substr($cadena,$pos,1);
        }
        return $codigo;
    }
}