<?php
namespace App\Http\Classes;

use App\Http\Models\Backend\T_Pagos;
use App\Http\Models\Backend\T_Contacto;
use App\Http\Models\Backend\T_Tramite_Rep_Tecnico;
use App\Http\Models\Backend\T_Tramite_Dato_Legal;
use App\Http\Models\Backend\T_Tramite_Acta_Instrumento;
use App\Http\Models\Backend\T_Tramite_Rep_Legal;
use Auth;

class Herramientas 
{
	public static function setFolioPago($folio_pago)
	{
		$array= [];
		$array['folio_pago']= $folio_pago;
		$datos=T_Pagos::busca_formatos($array)->first();
	    $valor="";
		if(isset($datos))
			$valor=1;
		else
			$valor=0;

		return $valor;
	}

	public static function setContacto($id_registro_temp)
	{
		$array= [];
		$array['id_registro_temp']= $id_registro_temp;
		$datos=T_Contacto::busca_contacto($array)->first();
	    $valor="";
		if(isset($datos))
			$valor=1;
		else
			$valor=0;

		return $valor;
	}

	public static function setRepTecnico( $idRegistroTmp ) 
	{
		$filtros=[];
		$filtros['id_registro_tmp']=$idRegistroTmp;
		$respuesta=T_Tramite_Rep_Tecnico::getRepTecnicoTMP($filtros)->get();
	    
	    $statusDatos=0;
		if(count($respuesta) > 0) 
			$statusDatos=1;

		return $statusDatos;
	}

	public static function setRepTecnicoContratista( $idRegistroTmp ) 
	{
		$filtros=[];
		$filtros['id_registro_tmp']=$idRegistroTmp;
		$respuesta=T_Tramite_Rep_Tecnico::getRepTecnicoTMP_Contratista($filtros)->get();
	    
	    $statusDatos=0;
		if(count($respuesta) > 0) 
			$statusDatos=1;

		return $statusDatos;
	}

	

	public static function setDatoLegal( $idRegistroTmp ) 
	{
		$filtros=[];
		$filtros['id_registro_tmp']=$idRegistroTmp;
		$queryToDataBase=T_Tramite_Dato_Legal::general($filtros)->get();
	    
	    $statusDatos=0;
		if(count($queryToDataBase) > 0) $statusDatos=1;
		return $statusDatos;
	}

	public static function setActaInstrumento( $idRegistroTmp ) 
	{
		$filtros=[];
		$filtros['id_registro_tmp']=$idRegistroTmp;
		$queryToDataBase=T_Tramite_Acta_Instrumento::general($filtros)->get();
	    
	    $statusDatos=0;
		if(count($queryToDataBase) > 0) $statusDatos=1;
		return $statusDatos;
	}

	public static function setRepLegal( $idRegistroTmp ) 
	{
		$filtros=[];
		$filtros['id_registro_tmp']=$idRegistroTmp;
		$queryToDataBase=T_Tramite_Rep_Legal::general($filtros)->get();
	    
	    $statusDatos=0;
		if(count($queryToDataBase) > 0) $statusDatos=1;
		return $statusDatos;
	}
}
?>
