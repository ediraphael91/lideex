<?php

namespace App\Services;

use App\Interfaces\CursoRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Exception;

class CursoService
{
    protected $cursoRepository;

    /**
     * Inyectamos el repositorio mediante el constructor.
     */
    public function __construct(CursoRepositoryInterface $cursoRepository)
    {
        $this->cursoRepository = $cursoRepository;
    }

    /**
     * Obtener todos los cursos.
     */
    public function obtenerTodos()
    {
        return $this->cursoRepository->all();
    }

    /**
     * Buscar un curso por ID.
     */
    public function obtenerPorId(string $id)
    {
        return $this->cursoRepository->find($id);
    }

    /**
     * Crear un nuevo curso.
     */
    public function crear(array $data)
    {
        try {
            return $this->cursoRepository->create($data);
        } catch (Exception $e) {
            Log::error('Error al crear el curso: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Actualizar un curso existente.
     */
    public function actualizar(string $id, array $data): bool
    {
        try {
            return $this->cursoRepository->update($id, $data);
        } catch (Exception $e) {
            Log::error('Error al actualizar el curso: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Eliminar un curso (borrado lógico si tienes SoftDeletes).
     */
    public function eliminar(string $id): bool
    {
        try {
            return $this->cursoRepository->delete($id);
        } catch (Exception $e) {
            Log::error('Error al eliminar el curso: ' . $e->getMessage());
            return false;
        }
    }
}
