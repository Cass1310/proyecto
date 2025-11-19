<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['identidad_corporativa', 'community_manager']);
            $table->date('fecha_ini');
            $table->date('fecha_fin');
            $table->decimal('costo', 12, 2);
            $table->foreignId('cliente_user_id')->constrained('users')->restrictOnDelete();
            $table->enum('estado', ['activo', 'inactivo', 'culminado', 'cancelado'])->default('activo');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['cliente_user_id']);
            $table->index(['estado']);
            $table->index(['fecha_fin']);
            $table->index(['tipo', 'estado']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};