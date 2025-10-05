<?php
namespace App\Interfaces;
use App\Models\Curso;

interface CursoRepositoryInterface
{

    /**
     * Obtener todos los cursos.
     */
    public function all(): iterable;

    /**
     * Buscar un curso por ID.
     */
    public function find(string $id): ?Curso;
    /**
     * Crear un nuevo curso.
     *
     * @param array $data
     * @return Curso|null
     */
    public function create(array $data): ?Curso;
    /**
     * Update a curso
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool;

    /**
     * Delete a curso by ID
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;
}
