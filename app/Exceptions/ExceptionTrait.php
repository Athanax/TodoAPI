<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

/**
 * this is a new trait to handle exception
 */
trait ExceptionTrait
{
    public function apiExeption($request, $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'errors' => 'Product model not found'
            ], Response::HTTP_NOT_FOUND);
        }
        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'errors' => 'Incorrect route'
            ], Response::HTTP_NOT_FOUND);
        }

        return parent::render($request, $e);
    }
}
