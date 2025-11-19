<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('publication_calendars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->constrained('services')->cascadeOnDelete();
            $table->foreignId('creador_id')->constrained('users')->restrictOnDelete();
            $table->date('fecha_ini');
            $table->date('fecha_fin');
            $table->enum('estado', ['pendiente', 'enviado', 'rechazado', 'en_revision', 'corregido', 'entregado'])->default('pendiente');
            $table->tinyInteger('correcciones_count')->unsigned()->default(0);
            $table->foreignId('ultimo_autor_correccion')->nullable()->constrained('users')->nullOnDelete();
            $table->string('document_path', 500)->nullable();
            $table->date('fecha_entrega_real')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['servicio_id']);
            $table->index(['creador_id']);
            $table->index(['estado']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('publication_calendars');
    }
};