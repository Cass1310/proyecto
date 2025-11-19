<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('artworks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calendar_id')->constrained('publication_calendars')->cascadeOnDelete();
            $table->foreignId('autor_id')->constrained('users')->restrictOnDelete();
            $table->date('fecha_pub')->nullable();
            $table->string('titulo', 255);
            $table->text('cuerpo')->nullable();
            $table->text('copy')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('img_path', 500)->nullable();
            $table->enum('tipo', ['color', 'venta'])->default('color');
            $table->enum('estado', ['pendiente', 'enviado', 'rechazado', 'aprobado'])->default('pendiente');
            $table->tinyInteger('correcciones_count')->unsigned()->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['calendar_id']);
            $table->index(['autor_id']);
            $table->index(['calendar_id', 'estado']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('artworks');
    }
};