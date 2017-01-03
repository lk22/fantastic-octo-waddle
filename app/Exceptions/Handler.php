<?php

namespace Notifier\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {

        // showing 500 page on production
        if (
            !$this->isHttpException($e) &&
            !$e instanceof ModelNotFoundException &&
            !$e instanceof ValidationException &&
            !$e instanceof AuthorizationException &&
            !$e instanceof HttpResponseException &&
            !$e instanceof TokenMismatchException &&
            !config('app.debug')
        ) {
            $e = new \Symfony\Component\HttpKernel\Exception\HttpException(500);
            return view('errors.500');
        }

        // 404 page on handled exceptions
        if(
           $e instanceof NotFoundHttpException ||
           $e instanceof ModelNotFoundException
        )
        {
            if($request->ajax() || $request->wantsJson())
            {
                return response()->json([
                    'message' => 'ressource not found'
                ], 404);
            }

            return view('errors.404');
        }

        if(
           $e instanceof AuthorizationException ||
           $e instanceof AuthenticationException ||
           $e instanceof MethodNotAllowedHttpException
        )
        {
            if($request->ajax || $request->wantsJson())
            {
                return response()->json([
                    'message' => 'Something went wrong with your request.'
                ], 500);
            }
            return view('errors.500');
        }

        return parent::render($request, $e);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
