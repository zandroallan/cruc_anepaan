<?php
   
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Validator;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\PersonalAccessToken;
   
class LoginSanctumController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    // public function register(Request $request): JsonResponse
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);
   
    //     if($validator->fails()){
    //         return $this->sendError('Validation Error.', $validator->errors());       
    //     }
   
    //     $input = $request->all();
    //     $input['password'] = bcrypt($input['password']);
    //     $user = User::create($input);
    //     $success['token'] =  $user->createToken('AppConstancias')->plainTextToken;
    //     $success['name'] =  $user->name;
   
    //     return $this->sendResponse($success, 'User register successfully.');
    // }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */


    public function login(Request $request): JsonResponse
    {        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            
            //Esta linea elimina los tokens por si se olvidaron cerrar su sesion
            $user->tokens()->delete();

            $success['token'] =  $user->createToken('TokenAppCrucAnepaan')->plainTextToken; 
            $success['name'] =  $user->name;
            $success['id'] =  $user->id;
   
            return $this->sendResponse($success, 'Usuario autenticado correctamente.', "C002");
        } 
        else{ 
            return $this->sendError('Unauthorized.', ['error'=>'El usuario no se ha autenticado'], 404, "C001");
        } 
    }

    public function logout(Request $request): JsonResponse
    {
        $user = \auth('sanctum')->user();

        if(!empty($user->tokens))
        {
            foreach ($user->tokens as $token) {
                $token->delete(); 
            }
            return $this->sendResponse('', 'Sesion cerrada satisfactoriamente.', 'C004'); 
        }
        else
        {           
            return $this->sendError('Unauthorized.', ['error'=>'No existe ningun token.'], 404, "C003");        
        } 
    }
}