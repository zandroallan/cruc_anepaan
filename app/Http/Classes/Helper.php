<?php
namespace App\Http\Classes;

class Helper{

    private $status_b;
    private $status_code;
    private $status_msg;

    public function __construct()
    {
        $this->status_b    = false;
        $this->status_code = 201;
        $this->status_msg  = '';        
    }

    public function getStatusB(){
        return $this->status_b;
    }

    public function getStatusCode(){
        return $this->status_code;
    }

    public function getStatusMsg(){
        return $this->status_msg;
    } 

    //Errores Caratula
    public function registroNuevo($post){        
        if(\App\Http\Models\Backend\T_Registro::general(['id'=>$post['id'], 'rfc'=>$post['rfc']])->count()>0){
            $this->status_b    = true;
            $this->status_code = 409;
            $this->status_msg  = 'Ya existe un registro con el R.F.C <b>"'.$post['rfc'].'"</b>. <br>Por favor verifique la información.';
        }
    }

    //Errores Caratula
    public function beneficiarioNew($post){        
        if(\App\Http\Models\Beneficiario::search(['id'=>$post['id'],'nombre'=>$post['nombre']])->count()>0){
            $this->status_b    = true;
            $this->status_code = 409;
            $this->status_msg  = 'Ya existe una beneficiario de nombre <br><b>"'.$post['nombre'].'</b>" <br>Porfavor verifique la información.';
        }
        if(\App\Http\Models\Beneficiario::search(['id'=>$post['id'],'folio_etiqueta'=>$post['folio_etiqueta']])->count()>0){
            $this->status_b    = true;
            $this->status_code = 409;
            $this->status_msg  = 'El folio <b>"'.$post['folio_etiqueta'].'"</b> ya ha sido asignado a otro beneficiario." <br>Porfavor verifique la información.';
        }        
    }
    
    //Función obtener fecha vencimiento
    public function fechaLimieSolventacion($fechaActual="2020-09-26", $diasEntrega=5){
        //$diasEntrega+=1;
	//$getDiaAcuse= date("D", $fechaInicio);
        $fechaFinal= $fechaActual;
        $inhabiles= array_values(\App\Http\Models\Catalogos\C_Inhabiles::lists());
        //print_r(json_encode($inhabiles)."<br>");
        $fechaInicio= strtotime($fechaActual);
	$getDiaAcuse= date("D", $fechaInicio);
        $fechaLimite= strtotime($fechaActual."+ ".$diasEntrega." days");
	$vuelta=1;
        for($i= $fechaInicio; $i<=$fechaLimite; $i+=86400){
            $getDia= date("D", $i);
            if($getDia=="Sat" || $getDia=="Sun"){
                //$diaActual= date("Y-m-d", $i);
		if($vuelta<=1){
			
		}else{
			//if(($getDiaAcuse!="Sat" || $getDiaAcuse!="Sun"))
                	$diasEntrega+=1; 
		}
            }else{
                $diaActual= date("Y-m-d", $i);
                if(in_array($diaActual, $inhabiles)) {
                    $diasEntrega+=1;
                }
            }
	    $vuelta++;
	    $fechaLimite= strtotime($fechaActual."+ ".($diasEntrega)." days");
        }

        return date("Y-m-d", $fechaLimite);
    }         
         
}
?>
