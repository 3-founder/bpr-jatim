<?php

namespace App\Exceptions\Api;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;

class ValidationException extends Exception
{
    private MessageBag $errors;

    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    public function render()
    {
        return response()->json([
            'status' => 422,
            'message' => 'Validation error',
            'data' => $this->errors,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
