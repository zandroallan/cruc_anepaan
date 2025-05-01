<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\Frontend\LoginRequest;
use Illuminate\Support\Facades\Crypt;
use App\Http\Models\Backend\T_Registro;
use App\User;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;
    private $registrosBloqueados=array();

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'nickname';
    }    

    /*
    public function authenticate(Request $request)
    {
        $this->validate($request,['nickname'=>'required', 'password'=>'required']);
        $credentials= $request->only('nickname', 'password');
        if (Auth::attempt($credentials+['active' => 1])) {
            // Authentication passed...

            return redirect()->intended('dashboards');
        }
        return redirect('login')
                ->withInput($request->only('nickname'))
                ->withErrors(['error'=>'Los datos proporcionados son incorrectos!']);        
    }
    */
    
    public function login(LoginRequest $request)
    {
		$vflUsuario = User::where('nickname', '=', $request->input('nickname'))->first();
        if(isset($vflUsuario)){

            $registro_bloqueado=false;
            if ( count($this->registrosBloqueados) > 0 ) {
                foreach ($this->registrosBloqueados as $key => $value) {
                    $_MDL_Registro=T_Registro::find($vflUsuario->id_registro);
                    if ( $value == $_MDL_Registro->rfc )  $registro_bloqueado=true;
                }
            }

            if ( $registro_bloqueado ) {
                $encryptedId = Crypt::encryptString($vflUsuario->id_registro);
                return redirect()->route('registro.bloqueado', ['id_registro' => $encryptedId]);
            }
            else {
                if ( 
                    ($vflUsuario->id_registro != null) || 
                    ($vflUsuario->id_registro != '')
                ) {

                    $this->validate($request,['nickname'=>'required', 'password'=>'required']);
                    $credentials= $request->only('nickname', 'password');
                    //$request['id_registro']=null;

                    if (Auth::attempt($credentials+['active' => 1])) {
                        if(Auth::User()->hasRole(['usuario'])){                 
                            return redirect()->route('mis-tramites.index'); 
                        }
                    }

                }
            }
        }
        return redirect('login')
            ->withInput($request->only('nickname'))
            ->withErrors(['error'=>'Los datos proporcionados son incorrectos!']); 
        /*
        $this->validate($request,['nickname'=>'required', 'password'=>'required']);
        $credentials= $request->only('nickname', 'password');

        if (Auth::attempt($credentials+['active' => 1])) {     

            if(Auth::User()->hasRole(['usuario'])){                 
                return redirect()->route('mis-tramites.index'); 
            }

        }
        return redirect('login')
                ->withInput($request->only('nickname'))
                ->withErrors(['error'=>'Los datos proporcionados son incorrectos!']); 
		*/
    }
}
