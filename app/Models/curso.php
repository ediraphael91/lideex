<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The database table used by the model.
     */
    protected $table = 'cursos';

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'id';

    /**
     * The data type of the auto-incrementing ID.
     */
    protected $keyType = 'int';

    /**
     * Indicates if the model's ID is auto-incrementing.
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = true;

    /**
     * The storage format of the model's date columns.
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'nivel',
        'duracion',
        'fecha_inicio',
        'fecha_fin',
        'precio',
        'activo',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'activo' => 'boolean',
        'duracion' => 'integer',
        'precio' => 'decimal:2',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    /**
     * The attributes that should be mutated to dates.
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'fecha_inicio',
        'fecha_fin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'deleted_at',
    ];

    /**
     * The attributes that should be visible in arrays.
     */
    protected $visible = [
        'id',
        'nombre',
        'descripcion',
        'nivel',
        'duracion',
        'fecha_inicio',
        'fecha_fin',
        'precio',
        'activo',
        'created_at',
        'updated_at',
    ];

    /**
     * The accessors to append to the model's array form.
     */
    protected $appends = [];

    /**
     * Scope a query to only include active courses.
     */
    public function scopeActive($query)
    {
        return $query->where('activo', true);
    }

    /**
     * Scope a query to only include inactive courses.
     */
    public function scopeInactive($query)
    {
        return $query->where('activo', false);
    }

    /**
     * Mutator para el nombre en mayúsculas.
     */
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = mb_strtoupper($value);
    }

    /**
     * Validation rules for the model.
     */
    public static function rules(): array
    {
        return [
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'nivel' => 'nullable|string|max:50',
            'duracion' => 'nullable|integer',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'precio' => 'float',
            'activo' => 'nullable|boolean',
        ];
    }
}
