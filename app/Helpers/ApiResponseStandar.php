<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponseStandar
{
    /**
     * Respuesta exitosa con datos.
     */
    public static function success($data, string $message = 'Operación exitosa', int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Respuesta de creación exitosa.
     */
    public static function created($data, string $message = 'Curso creado correctamente'): JsonResponse
    {
        return self::success($data, $message, 201);
    }

    /**
     * Respuesta de error genérico.
     */
    public static function error(string $message = 'Error interno del servidor', int $code = 500): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => null,
        ], $code);
    }

    /**
     * Respuesta cuando no se encuentra el recurso.
     */
    public static function notFound(string $message = 'Curso no encontrado'): JsonResponse
    {
        return self::error($message, 404);
    }

    /**
     * Respuesta de validación fallida.
     */
    public static function validationError(array $errors, string $message = 'Errores de validación'): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], 422);
    }
}
