<?php

use App\Exceptions\UserNotAuthenticatedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        $this->renderable(function (ValidationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Erro de validação',
                    'errors' => $e->errors()
                ], 422);
            }
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Rota não encontrada'
                ], 404);
            }
        });
        $this->renderable(function (UserNotAuthenticatedException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'timestamp' => $e->getTimestamp(),
                ], $e->getStatus());
            }
        });
    }
}
