<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->constrained('services')->cascadeOnDelete();
            $table->string('tarea_tipo', 100);
            $table->foreignId('assigned_to')->constrained('users')->restrictOnDelete();
            $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->enum('estado', ['pendiente', 'en_proceso', 'completado', 'cancelado'])->default('pendiente');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['assigned_to']);
            $table->index(['servicio_id']);
            $table->index(['fecha_fin']);
            $table->index(['estado', 'fecha_fin']);
            $table->index(['assigned_by', 'estado', 'fecha_fin']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('assignments');
    }
};