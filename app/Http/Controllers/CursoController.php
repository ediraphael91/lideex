<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoRequest;
use App\Services\CursoService;
use Illuminate\Http\JsonResponse;
use App\Helpers\ApiResponseStandar;

/**
 * @OA\Tag(
 *     name="Cursos",
 *     description="API Endpoints para gestión de cursos"
 * )
 */
class CursoController extends Controller
{
    protected $cursoService;

    public function __construct(CursoService $cursoService)
    {
        $this->cursoService = $cursoService;
    }

    /**
     * @OA\Get(
     *     path="/api/cursos",
     *     tags={"Cursos"},
     *     summary="Obtener todos los cursos",
     *     description="Retorna una lista de todos los cursos disponibles",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de cursos obtenida exitosamente",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="nombre", type="string", example="DESARROLLO WEB CON LARAVEL"),
     *                 @OA\Property(property="descripcion", type="string", example="Curso completo de Laravel"),
     *                 @OA\Property(property="nivel", type="string", example="Intermedio"),
     *                 @OA\Property(property="duracion", type="integer", example=40),
     *                 @OA\Property(property="fecha_inicio", type="string", format="date", example="2025-11-01"),
     *                 @OA\Property(property="fecha_fin", type="string", format="date", example="2025-12-15"),
     *                 @OA\Property(property="precio", type="number", format="float", example=299.99),
     *                 @OA\Property(property="activo", type="boolean", example=true),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $cursos = $this->cursoService->obtenerTodos();
        return response()->json($cursos);
    }

    /**
     * @OA\Post(
     *     path="/api/cursos",
     *     tags={"Cursos"},
     *     summary="Crear un nuevo curso",
     *     description="Crea un nuevo curso con los datos proporcionados",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre"},
     *             @OA\Property(property="nombre", type="string", maxLength=150, example="Desarrollo Web con Laravel"),
     *             @OA\Property(property="descripcion", type="string", example="Curso completo de desarrollo web utilizando Laravel"),
     *             @OA\Property(property="nivel", type="string", maxLength=50, example="Intermedio"),
     *             @OA\Property(property="duracion", type="integer", minimum=1, example=40, description="Duración en horas"),
     *             @OA\Property(property="fecha_inicio", type="string", format="date", example="2025-11-01"),
     *             @OA\Property(property="fecha_fin", type="string", format="date", example="2025-12-15"),
     *             @OA\Property(property="precio", type="number", format="float", minimum=0, example=299.99),
     *             @OA\Property(property="activo", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Curso creado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Curso creado exitosamente."),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="nombre", type="string", example="DESARROLLO WEB CON LARAVEL"),
     *                 @OA\Property(property="descripcion", type="string", example="Curso completo de desarrollo web utilizando Laravel"),
     *                 @OA\Property(property="nivel", type="string", example="Intermedio"),
     *                 @OA\Property(property="duracion", type="integer", example=40),
     *                 @OA\Property(property="fecha_inicio", type="string", format="date", example="2025-11-01"),
     *                 @OA\Property(property="fecha_fin", type="string", format="date", example="2025-12-15"),
     *                 @OA\Property(property="precio", type="number", format="float", example=299.99),
     *                 @OA\Property(property="activo", type="boolean", example=true),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Error al crear el curso."),
     *             @OA\Property(property="error_code", type="string", example="DATABASE_ERROR")
     *         )
     *     )
     * )
     */
    public function store(CursoRequest $request): JsonResponse
    {
        try{
            $curso = $this->cursoService->crear($request->validated());
            return ApiResponseStandar::created(
                $curso,
                'Curso creado exitosamente.'
            );
        }catch (\Exception $e){
            return ApiResponseStandar::error(
                'Error al crear el curso.',
                'DATABASE_ERROR',
                [config('app.debug') ? $e->getMessage() : 'Error interno del servidor.'],
                500
            );
        }

    }

    /**
     * @OA\Put(
     *     path="/api/cursos/{id}",
     *     tags={"Cursos"},
     *     summary="Actualizar un curso existente",
     *     description="Actualiza los datos de un curso específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del curso a actualizar",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre"},
     *             @OA\Property(property="nombre", type="string", maxLength=150, example="Desarrollo Web con Laravel"),
     *             @OA\Property(property="descripcion", type="string", example="Curso completo de desarrollo web utilizando Laravel"),
     *             @OA\Property(property="nivel", type="string", maxLength=50, example="Avanzado"),
     *             @OA\Property(property="duracion", type="integer", minimum=1, example=50),
     *             @OA\Property(property="fecha_inicio", type="string", format="date", example="2025-11-01"),
     *             @OA\Property(property="fecha_fin", type="string", format="date", example="2025-12-31"),
     *             @OA\Property(property="precio", type="number", format="float", minimum=0, example=349.99),
     *             @OA\Property(property="activo", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Curso actualizado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nombre", type="string", example="DESARROLLO WEB CON LARAVEL"),
     *             @OA\Property(property="descripcion", type="string"),
     *             @OA\Property(property="nivel", type="string"),
     *             @OA\Property(property="duracion", type="integer"),
     *             @OA\Property(property="fecha_inicio", type="string", format="date"),
     *             @OA\Property(property="fecha_fin", type="string", format="date"),
     *             @OA\Property(property="precio", type="number", format="float"),
     *             @OA\Property(property="activo", type="boolean"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Curso no encontrado"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación"
     *     )
     * )
     */
    public function update(CursoRequest $request, string $id): JsonResponse
    {
        $curso = $this->cursoService->actualizar($id, $request->validated());
        return response()->json($curso);
    }

    /**
     * @OA\Delete(
     *     path="/api/cursos/{id}",
     *     tags={"Cursos"},
     *     summary="Eliminar un curso",
     *     description="Elimina un curso específico (soft delete)",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del curso a eliminar",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Curso eliminado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Curso eliminado")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Curso no encontrado"
     *     )
     * )
     */
    public function destroy(string $id): JsonResponse
    {
        $this->cursoService->eliminar($id);
        return response()->json(['message' => 'Curso eliminado']);
    }
}
