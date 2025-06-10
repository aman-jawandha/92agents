<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException'
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
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
            //
        });
    }
    
    public function render($request, Throwable $exception)
    {
        if ($request->route() && in_array('api', $request->route()->middleware())) {
            $statusCode = $this->isHttpException($exception) ? $exception->getStatusCode() : 500;


            $errors = method_exists($exception, 'errors') ? $exception->errors() : []; // Safer way to check for errors


            return response()->json([
                "status" => false, // Use lowercase boolean
                "message" => $exception->getMessage(),
                "code" => $statusCode, // Use the correct status code here
                "data" => [],
                "misc" => [],
                "errors" => $errors,
            ], $statusCode);
        }

        return parent::render($request, $exception);
    }
}
