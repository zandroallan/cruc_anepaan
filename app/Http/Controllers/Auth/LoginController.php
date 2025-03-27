<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\Frontend\LoginRequest;
use App\User;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'nickname';
    }    

    /**public function authenticate(Request $request)
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
    }*/
    
    public function login(LoginRequest $request)
    {
		$vflUsuario = User::where('nickname', '=', $request->input('nickname'))->first();
        if(isset($vflUsuario)){
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
