<?php

namespace App\Classes;

use Illuminate\Support\Facades\Lang;

/**
 * used to get and handle response format.
 * @author Mahmoud Mohamed <mahmoud-mhamed@github.com>
 */
class Response
{
    public static function error($errors, $code = 500, $message = null)
    {
        $message=$message??Lang::get('message.error_response_message');
        return response()->json([
            "message" => $message,
            'errors' => $errors
        ], $code);
    }

    public static function success($response=[], $code = 200, $message = null)
    {
        $message=$message??Lang::get('message.success_response_message');
        return response()->json([
            "message" => $message,
            'response' => $response
        ], $code);
    }

    public static function success2($response=[], $code = 200, $message = null)
    {
        $message=$message??Lang::get('message.success_response_message');
        return response()->json([
            "message" => $message,
            ...$response
        ], $code);
    }

    public static function cant_access($errors=[], $code = 403, $message = null)
    {
        $message=$message??Lang::get('message.cant_access');
        return response()->json([
            "message" => $message,
//            'errors' => $errors
        ], $code);
    }

    public static function validation_error($errors=[], $code = 422, $message = null)
    {
        $message=$message??Lang::get('message.cant_access');
        return response()->json([
            "message" => $message,
            'errors' => $errors
        ], $code);
    }
}
