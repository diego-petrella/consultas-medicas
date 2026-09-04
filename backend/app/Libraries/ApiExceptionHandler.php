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
        }

        echo json_encode(['error' => $message]);

        exit($exitCode);
    }
}
