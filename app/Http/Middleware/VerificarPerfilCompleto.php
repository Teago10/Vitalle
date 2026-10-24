<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarPerfilCompleto
{
    public function handle(Request $request, Closure $next): Response
    {
        $usuario = $request->user();

        // Usuários não autenticados são tratados
        // pelo middleware de autenticação.
        if (!$usuario) {
            return $next($request);
        }

        // Administradores não precisam completar
        // um perfil de cuidador ou responsável.
        if ($usuario->tipo_usuario === 'admin') {
            return $next($request);
        }

        // Verifica se o cuidador possui perfil.
        if ($usuario->tipo_usuario === 'cuidador') {

            if (!$usuario->cuidador()->exists()) {
                return redirect()->route('perfil.completar');
            }

        }

        // Verifica se o responsável possui perfil.
        if ($usuario->tipo_usuario === 'responsavel') {

            if (!$usuario->responsavel()->exists()) {
                return redirect()->route('perfil.completar');
            }

        }

        return $next($request);
    }
}
