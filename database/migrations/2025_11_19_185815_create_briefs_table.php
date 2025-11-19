<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('briefs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->unique()->constrained('services')->cascadeOnDelete();
            $table->enum('tipo', ['logo', 'marca', 'cm']);
            $table->string('document_path', 500)->nullable();
            $table->dateTime('fecha_recibida');
            $table->json('contenido_json')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('briefs');
    }
};