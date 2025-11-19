<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('artwork_corrections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artwork_id')->constrained('artworks')->cascadeOnDelete();
            $table->tinyInteger('correccion_count')->unsigned();
            $table->text('comentarios')->nullable();
            $table->string('img_anterior_path', 500)->nullable();
            $table->string('img_nueva_path', 500)->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['artwork_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('artwork_corrections');
    }
};