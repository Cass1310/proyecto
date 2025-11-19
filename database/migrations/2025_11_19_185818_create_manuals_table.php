<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('manuals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->constrained('services')->cascadeOnDelete();
            $table->foreignId('logo_id')->nullable()->constrained('logos')->nullOnDelete();
            $table->string('manual_path', 500);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['servicio_id']);
            $table->index(['logo_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('manuals');
    }
};