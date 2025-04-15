<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Catalogos\C_Descargas;


class DescargasController extends Controller
{
    private $route='descargas-f';
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('title', 'Descargas');
        view()->share('current_route', $this->route);       
    } 
   
    public function resultados(){            
        $resultados = C_Descargas::lists()->get();
        return $resultados;
    }   

    public function index(){
      return view('backend.descargas.index');
    }
    
    public function descargar ($id_documento){
        $datos = C_Descargas::find($id_documento);
        
        $path= public_path().'/descargas/';
        $file= $path.$datos->nombre.'.'.$datos->tipo;
        return response()->download($file);
    }    
}
