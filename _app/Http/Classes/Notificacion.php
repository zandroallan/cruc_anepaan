<?php
namespace App\Http\Classes;
use DB;
class Notificacion{

    private $id_usuario;
    private $id_tramite;
    private $descripcion;
    private $visto;

    public function __construct($id_usuario=null, $id_tramite=null, $descripcion="", $visto=0)
    {
        $this->id_usuario    = $id_usuario;
        $this->id_tramite = $id_tramite;
        $this->descripcion  = $descripcion;  
        $this->visto  = $visto;      
    }

    public function setIdUsuario($value){
        $this->id_usuario= $value;
    }

    public function setIdTramite($value){
        $this->id_tramite= $value;
    }  
    
    public function setDescripcion($value){
        $this->descripcion= $value;
    }    

    public function getIdUsuario(){
        return $this->id_usuario;
    }

    public function getIdTramite(){
        return $this->id_tramite;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getVisto(){
        return $this->visto;
    } 

    //Errores Crear cuenta
    public function nuevaNotificacion($destino, $tipo=null){    
        $status= true;
        try {
            DB::beginTransaction(); 
            ($destino==1) ? $notificacion= new \App\Http\Models\Catalogos\N_Area : $notificacion= new \App\Http\Models\Catalogos\N_Usuario;
            $post['id_usuario']= $this->id_usuario;
            $post['id_tramite']= $this->id_tramite;
            $post['descripcion']= $this->descripcion;
            $post['visto']= $this->visto;
            $notificacion->fill($post)->save();
            DB::commit();
        }catch (\Exception $e) {
            $status= false;
            DB::rollback();                       
        }
        return $status;
    } 

    public function turnarAreasNotificacion($array){    
        $status= true;
        try {
            DB::beginTransaction(); 
            foreach($array as $value) {
                $notificacion= new \App\Http\Models\Catalogos\N_Area;
                $post['id_usuario']= $value;
                $post['id_tramite']= $this->id_tramite;
                $post['descripcion']= $this->descripcion;
                $post['visto']= $this->visto;
                $notificacion->fill($post)->save();
            }            
            DB::commit();
        }catch (\Exception $e) {
            $status= false;
            DB::rollback();                       
        }
        return $status;
    }    

}
?>
