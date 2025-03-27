<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class NotificacionesForzadas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id_registro= Auth::User()->id_registro;
        $notificaciones_forzadas= count(\App\Http\Models\Catalogos\N_Usuario::general(['id_registro'=> $id_registro, 'id_tipo_notificacion'=>2, 'acepto_condiciones'=>null])->get());

        if($notificaciones_forzadas>0) {
            return redirect()->route('notificaciones.observaciones'); 
        }else {
            return $next($request);
        }

        
    }
}
