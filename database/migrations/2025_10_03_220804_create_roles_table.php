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
    Schema::create('rols', function (Blueprint $table) {
        $table->id();
        $table->string('nombre', 50)->unique();   // Nombre del rol, único
        $table->string('descripcion')->nullable(); // Descripción del rol
        $table->boolean('activo')->default(true); // Si el rol está activo
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rols');
    }
};
