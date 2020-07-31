<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\App;
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
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if( $exception instanceOf AuthenticationException) {

            return response()->json([
                'msg' => 'Unauthenticated. It\'s necessary to be authenticated to access this endpoint'
            ], 401);

        }

        if (App::environment() === 'local') {
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'msg' => $exception->errors()
                ], 422);

            } else if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'error' => str_replace('App\\Models\\', '', $exception->getModel()) . ' not found!'],
                    404);

            } else if ($exception instanceof QueryException) {
                if ($exception->errorInfo[1] === 1062) {
                    return response()->json([
                        'error' => str_replace('App\\Models\\', '', $exception->getModel()) .
                            ' already exists and can\'t be duplicate!'
                    ], 422);
                }
            }

            return response()->json([
                'error' => [
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'code' => $exception->getCode(),
                    'stacktrace' => $exception->getTraceAsString()
                ]
            ], 500);
        }

        return response()->json([
            'error' => 'An error occurred. Check the logs for more information.'
        ], 500);


        return parent::render($request, $exception);
    }
}
