<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Lideex API Documentation",
 *     description="Documentación de la API REST de Lideex",
 *     @OA\Contact(
 *         email="admin@lideex.com"
 *     )
 * )
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Servidor de desarrollo local"
 * )
 * @OA\Server(
 *     url="https://api.lideex.com",
 *     description="Servidor de producción"
 * )
 */
abstract class Controller
{
    //
}
