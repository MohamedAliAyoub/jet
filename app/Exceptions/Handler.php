<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function(Throwable $e, $request) {

            if($e instanceof NotAuthorizedException) {
                return $this->handleNotAuthorizedException($request, $e);
            }
            else if($e instanceof AccessDeniedHttpException) {
                return $this->handleNotAuthorizedException($request, $e);
            }
            else if($e instanceof InvalidSignatureException) {
                return throw ValidationException::withMessages([
                    'message' => __('auth.error_in_signature')
                ]);
            }

        });
    }

    /**
     * When inalid abilities or permissions detected.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Throwable $e
     * @return mixed
     */
    public function handleNotAuthorizedException($request, Throwable $e)
    {
        if($this->shouldReturnJson($request, $e)) {
            // ...
        }
        else {
            toastr()->error(__('auth.not_authorized'));

            return back();
        }
    }

    /**
     * Overwrite this method to Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->shouldReturnJson($request, $exception)
                    ? response()->json(['message' => $exception->getMessage()], 401)
                    : redirect()->guest($exception->redirectTo() ?? route('user.login.page'));
    }
}
