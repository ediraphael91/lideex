<?php

namespace App\Repositories;

use App\Models\Curso;
use App\Interfaces\CursoRepositoryInterface;

class EloquentCursoRepository implements CursoRepositoryInterface
{
    protected $model;
    public function __construct(Curso $curso)
    {
        $this->model = $curso;
    }
    public function all(): iterable
    {
        return $this->model->all();
    }
    public function find(string $id): ?Curso
    {
        return $this->model->find($id);
    }
    public function create(array $data): ?Curso
    {
        return $this->model->create($data);
    }
    public function update(string $id, array $data): bool
    {
        $curso = $this->model->find($id);
        if (!$curso) {
            return false;
        }
        return $curso->update($data);
    }
    public function delete(string $id): bool
    {
        $curso = $this->model->find($id);
        if (!$curso) {
            return false;
        }
        return $curso->delete();
    }
}
