<?php

//Json Response
use Illuminate\Http\JsonResponse;

if (!function_exists('jsonResponseFormat')) {
    function jsonResponseFormat(mixed $payload = null, string $message = null, int $code = 200): JsonResponse
    {
        if (!$message) {
            $message = __('Request Successful.');
        }
        return response()->json([
            'message' => $message,
            'payload' => $payload,
        ], $code);
    }
}
