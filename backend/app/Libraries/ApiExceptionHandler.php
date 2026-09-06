<?php

namespace App\Libraries;

use CodeIgniter\Debug\BaseExceptionHandler;
use CodeIgniter\Debug\ExceptionHandlerInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Throwable;

final class ApiExceptionHandler extends BaseExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(
        Throwable $exception,
        RequestInterface $request,
        ResponseInterface $response,
        int $statusCode,
        int $exitCode,
    ): void {
        $code = $exception->getCode();

        $httpCode = ($code >= 400 && $code < 600) ? $code : 500;
        $message  = $httpCode < 500 ? $exception->getMessage() : 'Internal server error';

        if (! headers_sent()) {
            header(
                sprintf('HTTP/%s %s %s', $request->getProtocolVersion(), $httpCode, $response->getReasonPhrase()),
                true,
                $httpCode
            );
            header('Content-Type: application/json; charset=UTF-8');
            $this->sendCorsHeaders($request);
        }

        echo json_encode(['error' => $message]);

        exit($exitCode);
    }

    /**
     * El pipeline normal de filtros de CodeIgniter (incluido el filtro 'cors')
     * no llega a correr porque este handler corta la ejecucion con exit().
     * Sin esto, cualquier error del backend queda sin headers CORS y el
     * navegador lo bloquea como "Failed to fetch" aunque el servidor
     * haya respondido correctamente.
     */
    private function sendCorsHeaders(RequestInterface $request): void
    {
        $origin = $request->getHeaderLine('Origin');
        $cors   = config('Cors')->default;

        if ($origin === '' || ! in_array($origin, $cors['allowedOrigins'], true)) {
            return;
        }

        header('Access-Control-Allow-Origin: ' . $origin);

        if ($cors['supportsCredentials']) {
            header('Access-Control-Allow-Credentials: true');
        }
    }
}
