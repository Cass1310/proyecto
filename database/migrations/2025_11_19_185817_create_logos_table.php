<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('logos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->constrained('services')->cascadeOnDelete();
            $table->foreignId('autor_id')->constrained('users')->restrictOnDelete();
            $table->enum('tipo', ['propuestas', 'version1', 'version2'])->default('propuestas');
            $table->string('img_path', 500);
            $table->enum('estado', ['pendiente', 'enviado', 'rechazado', 'en_revision', 'corregido', 'entregado'])->default('pendiente');
            $table->enum('version', ['vertical', 'horizontal', 'una_tinta', 'negativo_una_tinta', 'negativo_color'])->nullable();
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('manual_id')->nullable();
            $table->tinyInteger('correcciones_count')->unsigned()->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['servicio_id']);
            $table->index(['autor_id']);
            $table->index(['estado', 'servicio_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('logos');
    }
};