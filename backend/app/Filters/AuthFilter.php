<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $usuario = session()->get('usuario');

        if ($usuario === null) {
            return service('response')->setStatusCode(401)->setJSON([
                'error' => 'No autenticado',
            ]);
        }

        if (! empty($arguments) && (int) $usuario['role_id'] !== (int) $arguments[0]) {
            return service('response')->setStatusCode(403)->setJSON([
                'error' => 'No tiene permisos para realizar esta accion',
            ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No hace falta nada despues de la respuesta
    }
}
