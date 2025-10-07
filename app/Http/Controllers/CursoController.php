<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoRequest;
use App\Services\CursoService;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use App\Helpers\ApiResponseStandar;

class CursoController extends Controller
{
    protected $cursoService;

    public function __construct(CursoService $cursoService)
    {
        $this->cursoService = $cursoService;
    }

    public function index(): JsonResponse
    {
        $cursos = $this->cursoService->obtenerTodos();
        return response()->json($cursos);
    }

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

    public function update(CursoRequest $request, string $id): JsonResponse
    {
        $curso = $this->cursoService->actualizar($id, $request->validated());
        return response()->json($curso);
    }

    public function destroy(string $id): JsonResponse
    {
        $this->cursoService->eliminar($id);
        return response()->json(['message' => 'Curso eliminado']);
    }
}
