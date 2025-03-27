<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Classes\Correo;

class VideotutorialController extends Controller
{
    private $route='videotutorial';
    public function __construct()
    {
        view()->share('title', 'Videotutorial');
        view()->share('current_route', $this->route);       
    } 

    public function index(){
        return view('frontend.videotutorial.index');
    }  

   
      

}
