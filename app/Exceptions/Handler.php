<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {


        });
    }

    public function render($request, Throwable $e)
    {
        if($e instanceOf ModelNotFoundException) {
            return response()->json([
                'status' => false,
                'errors' => [
                    [
                        'code' => 404,
                        'message' => 'No se encuentra el recurso solicitado.'
                    ]
                ]
            ], 404);
        }
        else{
            if($e instanceOf AuthenticationException) {
                return response()->json([
                    'status' => false,
                    'errors' => [
                        [
                            'code' => 401,
                            'message' => 'Credenciales inválidas',
                        ]
                    ]
                ], 401);
            }
        }

        /*return response()->json([
            'status' => false,
            'message' => 'Desconocido',
            'error' => $e
        ], 500);*/

        return parent::render($request, $e);
    }


}
