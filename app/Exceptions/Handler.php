<?php

namespace App\Exceptions;

use Exception;
use App\Traits\ApiResponser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Psy\Exception\ErrorException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{

    use ApiResponser;

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
    public function render($request, Exception $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            return redirect()->back()->withInput($request->input());
        }

        if ($exception instanceof ModelNotFoundException) {

            if($this->isFrontend($request)) {
                return back();
            }

            $model = strtolower(class_basename($exception->getModel())); // Instance without namespace

            return $this->errorResponse("No instance of {$model} with specified id", 404);
        }

        if ($exception instanceof NotFoundHttpException) {
            if ($request->is('api/*')) {
                return $this->errorResponse("Specified URL not found", 404);
            }

            return response()->view('errors.404');
        }

        if ($exception instanceof MethodNotAllowedHttpException) {

            if($this->isFrontend($request)) {
                return back();
            }

            return $this->errorResponse("The request method is not valid", 405);
        }

        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        if($this->isFrontend($request)) {
            return response()->view('errors.500');
        }

        return $this->errorResponse("Unexpected failure. Try later", 500);

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

        return redirect()->guest(route('login'));
    }

    private function isFrontend($request)
    {
        dd($request->expectsJson());
        return $request->acceptsHtml() && collect($request->route()->middleware())->contains('web');
    }
}

//        if($this->isFrontend($request)) {
//            return redirect()->guest('login');
//        }
//
//        return $this->errorResponse("Unauthenticated", 401);