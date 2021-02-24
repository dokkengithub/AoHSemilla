<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
            }else{
                if($e instanceOf ValidationException) {
                    return response()->json([
                            'status'    =>  false,
                            'message' => 'La petición no supera la validación de datos.',
                            'errors'    =>  $e->errors(),
                        ],
                        400  //HTTP 400 Bad request
                        //422  //HTTP 422 Unprocessable Entity
                    );
                }else{
                    if($e instanceOf AuthorizationException) {
                        return response()->json([
                                'status'    =>  false,
                                'message' => 'No tiene permisos para realizar la acción.',
                                'errors'    =>  $e,
                            ],
                            403  //HTTP 403 Forbidden
                        );
                    }else{
                        if($e instanceOf HttpException) {
                            return response()->json([
                                    'status'    =>  false,
                                    'message' => 'Página no encontrada.',
                                    'errors'    =>  $e,
                                ],
                                404  //HTTP 404 Not found
                            );
                        }
                    }
                }
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
