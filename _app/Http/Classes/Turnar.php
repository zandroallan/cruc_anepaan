<?php
namespace App\Http\Classes;
use DB;
use \App\Http\Models\Mantenimiento\RoleUser;
class Turnar{
    private $id_r_area_legal;
    private $id_r_area_tecnica;
    private $id_r_area_financiera;

    public function __construct()
    {
        $this->id_r_area_legal= 0;
        $this->id_r_area_tecnica= 0;
        $this->id_r_area_financiera= 0;  
    }

    public function getResponsableAreaLegal(){
        return $this->id_r_area_legal;
    }

    public function getResponsableAreaTecnica(){
        return $this->id_r_area_tecnica;
    }

    public function getResponsableAreaFinanciera(){
        return $this->id_r_area_financiera;
    }

    //Errores Crear cuenta
    public function asignar_responsables(){    
        $status= true;
        try {
            DB::beginTransaction(); 
            $this->id_r_area_legal= RoleUser::obtener_responsable_legal()->user_id;
            $this->id_r_area_tecnica=  RoleUser::obtener_responsable_tecnica()->user_id;
            $this->id_r_area_financiera=  RoleUser::obtener_responsable_financiera()->user_id;
            DB::commit();
        }
        catch (\Exception $e) {
            $status= false;
            DB::rollback();                       
        }
        return $status;
    } 

}
?>
