<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);              // Nombre del curso
            $table->text('descripcion')->nullable();   // Descripción del curso
            $table->string('nivel', 50)->nullable();   // Nivel: básico, intermedio, avanzado
            $table->integer('duracion')->nullable();   // Duración en horas
            $table->date('fecha_inicio')->nullable();  // Fecha de inicio
            $table->date('fecha_fin')->nullable();     // Fecha de fin
            $table->decimal('precio', 8, 2)->default(0); // Precio del curso
            $table->boolean('activo')->default(true); // Si el curso está activo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
