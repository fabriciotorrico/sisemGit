<?php

namespace App\Http\Middleware;

use Closure;

class TipoDeUsuarioMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $tipo_de_usuario_permitido)
    {
      if (auth()->user()->id_tipo_usuario != $tipo_de_usuario_permitido) {
        return redirect('/403');
      }
        return $next($request);
    }
}
