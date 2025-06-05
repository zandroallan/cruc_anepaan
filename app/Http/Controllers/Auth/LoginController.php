<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\Frontend\LoginRequest;
use Illuminate\Support\Facades\Crypt;
use App\Http\Models\Backend\T_Registro;
use App\Http\Models\Backend\T_Registro_Bloqueado;
use App\User;
use Auth;
use DB;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;
    private $registrosBloqueados=array(
        'GOAS9112043D0',
        'CIC170720219',
        'CPI2002147A5',
        'OEMR760207RB4',
        'CMG100223KP6',
        'ECE130312I22',
        'CUVV8103178F1',
        'IOA230614U52',
        'CMC160512BD9',
        'GTB190620HC5',
        'DUA070711QU3',
        'COS180302P32',
        'GOAJ810624TQ6',
        'ECR960325617',
        'ACE131021563',
        'VII220607RK9',
        'CCL121023D90',
        'GLC231205DRA',
        'NAMA630116AI6',
        'ICC131214S10',
        'ACO1209247R1',
        'TIN020503Q94',
        'VUC070502KW5',
        'CAP130130NC2',
        'NIN140318TB4',
        'CURF811008FG6',
        'SSC2007071W5',
        'OAEA830319G43',
        'CIS1306282U6',
        'GVE180119R73',
        'DCV151022VL5',
        'TUX1807182DA',
        'FGC100424TK9'
    );

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

    public function verificar_rfc_bloqueado(Request $vrequest)
    {
        $vstatus=201;
        $vfiltro=array();
        $vrespuesta=[
            'codigo'=> 0,
            'icono'=> 'warning',
            'mensaje'=> 'Le informamos que hasta el momento no se encuentra bloqueado la empresa que intenta registrar.'
        ];

        $validator=Validator::make($vrequest->all(), [
            'rfc' => 'required'
        ]);

        if ( $validator->fails() ) {
            return response()->json(['codigo'=>0, 'icono'=>'warning', 'mensaje'=> $validator->errors()->toJson()], 201);
        }
        try {

            $registro_bloqueado = 0;
            // $rfc_buscar = strtoupper(trim($vrequest->rfc)); // normalizamos el valor
            // if (!empty($this->registrosBloqueados)) {
            //     foreach ($this->registrosBloqueados as $valor) {
            //         if (strtoupper(trim($valor)) === $rfc_buscar) {
            //             $vrespuesta['error'] = $valor;
            //             $registro_bloqueado = true;
            //             break; // corta el loop si ya encontró coincidencia
            //         }
            //     }
            // }

            $rfc = strtoupper(trim($vrequest->rfc));
            $bloqueados = array_map('strtoupper', array_map('trim', $this->registrosBloqueados));

            if (in_array($rfc, $bloqueados)) {
                $vrespuesta['error'] = $rfc;
                $registro_bloqueado = 1;
            }

            $vrespuesta['codigo']=1;
            $vrespuesta['icono']='success';
            $vrespuesta['mensaje']='la peticio ha sido exitosamente hecha.';
            $vrespuesta['bloqueado']=$registro_bloqueado;
        }
        catch( Exception $vexception ) {
            DB::rollback();
            $vstatus=500;
            $vrespuesta=[
                'codigo'=> -1,
                'icono'=> 'error',
                'mensaje'=> $vexception->getMessage()
            ];
        }
        return response()->json($vrespuesta, $vstatus);
    }
    
    public function login(LoginRequest $request)
    {
		$vflUsuario = User::where('nickname', '=', $request->input('nickname'))->first();
        if ( isset($vflUsuario) ) {

            $registro_bloqueado=false;
            if ( count($this->registrosBloqueados) > 0 ) {
                foreach ($this->registrosBloqueados as $key => $value) {
                    $_MDL_Registro=T_Registro::find($vflUsuario->id_registro);
                    if ( $value == strtoupper($_MDL_Registro->rfc) )  {
                        $registro_bloqueado=true;
                        
                $fecha=date('d/m/Y');
                $hora=date('H:i:s');
                $_mensaje ='';
                $_mensaje.=' Intento de acceso: La empresa '. $_MDL_Registro->razon_social_o_nombre;
                $_mensaje.=' intentó ingresar al sistema el '. $fecha .' a las '. $hora .' pero se encuentra actualmente inhabilitada';
                $_mensaje.=' El acceso fue denegado y se registró el evento para seguimiento.';

                $_MDL_Registro_Bloqueado=new T_Registro_Bloqueado;
                $_MDL_Registro_Bloqueado->fill(
                    [
                        'id_registro'   => $vflUsuario->id_registro,
                        'descripcion'   => $_mensaje,
                        'fecha'         => date('Y-m-d'),
                        'hora'          => $hora
                    ]
                )->save();
                        
                        
                        break;
                    }
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
